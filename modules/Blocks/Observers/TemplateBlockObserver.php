<?php

namespace Modules\Blocks\Observers;

use Illuminate\Support\Facades\Storage;
use Modules\Blocks\Models\Block;
use Modules\Blocks\Models\TemplateBlock;

class TemplateBlockObserver
{
    /**
     * Handle the PageBlock "created" event.
     */
    public function created(TemplateBlock $block): void
    {
    }

    /**
     * Handle the PageBlock "updated" event.
     */
    public function updated(TemplateBlock $model): void
    {
        $originalContent = $model->getOriginal('content') ?? [];
        $newContent = $model->content ?? [];

        // Порівнюємо, які файли були видалені
        $deletedFiles = [];

//dd($originalContent,$newContent);
        $deletedFiles = array_merge($deletedFiles, $this->findDeletedFiles($originalContent, $newContent));

        // Видаляємо ці файли з диску
        foreach ($deletedFiles as $filePath) {
            Storage::disk('public')->delete($filePath);
        }
    }

    /**
     * Handle the PageBlock "deleted" event.
     */
    public function deleted(TemplateBlock $pageBlock): void
    {
        $content = $model->content ?? [];
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
            if (is_array($field) && !empty($field && !in_array($key, Block::TRANSLATABLE_FIELDS))) {
                return true;
            }
        }
        return false;
    }

    protected function getBlock(array $block): array
    {
        foreach ($block['data'] as $key => $field) {
            if (is_array($field) && !empty($field && !in_array($key, Block::TRANSLATABLE_FIELDS))) {
                return $field;
            }
        }
        return [];
    }

    protected function deleteAllFiles(array $content)
    {
        $files = $this->extractFilesFromContent($content);
        foreach ($files as $filePath) {
            Storage::disk('public')->delete($filePath);
        }
    }

    /**
     * Handle the PageBlock "restored" event.
     */
    public function restored(TemplateBlock $pageBlock): void
    {
        //
    }

    /**
     * Handle the PageBlock "force deleted" event.
     */
    public function forceDeleted(TemplateBlock $pageBlock): void
    {
        //
    }
}
