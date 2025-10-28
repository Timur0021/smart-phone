<?php

namespace Modules\Blocks\Observers;

use Illuminate\Support\Facades\Storage;
use Modules\Blocks\Models\Block;

class BlockObserver
{
    public function created(Block $block): void
    {
        $template = $block->template;
        if ($template) {
            $block->name = $template->name;
            $block->content = $template->content;
            $block->type = $template->type;
            $block->save();
        }
    }

    public function updated(Block $model): void
    {
        $originalContent = $model->getOriginal('content') ?? [];
        $newContent = $model->content ?? [];

        $deletedFiles = $this->findDeletedFiles($originalContent, $newContent);

        foreach ($deletedFiles as $filePath) {
            Storage::disk('public')->delete($filePath);
        }
    }

    public function deleted(Block $pageBlock): void
    {
        $content = $pageBlock->content ?? [];
        $this->deleteAllFiles($content);
    }

    private function findDeletedFiles(array $originalContent, array $newContent): array
    {
        $originalFiles = $this->extractFilesFromContent($originalContent);
        $newFiles = $this->extractFilesFromContent($newContent);

        return array_diff($originalFiles, $newFiles);
    }

    private function extractFilesFromContent(array $content): array
    {
        $files = [];

        foreach ($content as $block) {
            if (!is_array($block) || !isset($block['type'], $block['data']) || !is_array($block['data'])) {
                continue;
            }

            if (in_array($block['type'], Block::TEMPLATE_WITH_IMAGE)) {
                foreach ($block['data'] as $key => $value) {
                    if (is_array($value)) {
                        foreach ($value as $item) {
                            if (is_array($item)) {
                                foreach ($item as $subKey => $subValue) {
                                    if (in_array($subKey, Block::IMAGE_FIELDS) && !empty($subValue)) {
                                        $files[] = $subValue;
                                    }
                                }
                            }
                        }
                    } elseif (in_array($key, Block::IMAGE_FIELDS) && !empty($value)) {
                        $files[] = $value;
                    }
                }
            }

            if ($this->blockExists($block)) {
                $files = array_merge($files, $this->extractFilesFromContent($this->getBlock($block)));
            }
        }

        return $files;
    }

    protected function blockExists(array $block): bool
    {
        foreach ($block['data'] as $key => $field) {
            if (is_array($field) && !empty($field) && !in_array($key, Block::TRANSLATABLE_FIELDS)) {
                return true;
            }
        }
        return false;
    }

    protected function getBlock(array $block): array
    {
        foreach ($block['data'] as $key => $field) {
            if (is_array($field) && !empty($field) && !in_array($key, Block::TRANSLATABLE_FIELDS)) {
                return $field;
            }
        }
        return [];
    }

    protected function deleteAllFiles(array $content): void
    {
        $files = $this->extractFilesFromContent($content);
        foreach ($files as $filePath) {
            Storage::disk('public')->delete($filePath);
        }
    }

    public function restored(Block $pageBlock): void {}
    public function forceDeleted(Block $pageBlock): void {}
}
