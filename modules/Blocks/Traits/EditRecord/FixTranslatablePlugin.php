<?php

namespace Modules\Blocks\Traits\EditRecord;

use Filament\Forms\Components\BaseFileUpload;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Concerns\CanGenerateUuids;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\Section;
use Illuminate\Support\Str;

trait FixTranslatablePlugin
{
    use CanGenerateUuids;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $originalData = $data;

        $this->checkIfComponentsHasFileUpload($this->form->getComponents(), $data);

        if (empty($this->getBuilderName())) {
            $originalData = $data;
        } else {
            if (array_key_exists($this->getBuilderName(), $data)) {
                data_set($originalData, $this->getBuilderName(), $data[$this->getBuilderName()]);
            } else {
                data_set($originalData, $this->getBuilderName(), $data);
            }
        }

        return $originalData;
    }

    protected function checkIfComponentsHasFileUpload(array $components, array &$data): void
    {
        foreach ($components as $component) {
            if ($component instanceof BaseFileUpload) {
                $statePath = $component->getStatePath(false);

                $this->addUuidKeysForImageArrays($statePath, $data);

                continue;
            }

            if ($component->hasChildComponentContainer()) {
                if ($component instanceof Field && $component->getName() === $this->getBuilderName()) {
                    $data = data_get($data, $this->getBuilderName()) ?: [[]];
                }

                if ($component instanceof Builder) {
                    $childComponents = collect($component->getChildComponents())
                        ->filter(function (Block $block) use ($data) {
                            $pass = false;

                            foreach ($data as $item) {
                                if (data_get($item, 'type') === $block->getName()) {
                                    $pass = true;
                                }
                            }

                            return $pass;
                        })
                        ->toArray();
                }

                $this->checkIfComponentsHasFileUpload(
                    components: ($childComponents ?? []) ?: $component->getChildComponents(),
                    data: $data,
                );
            }
        }
    }

    protected function addUuidKeysForImageArrays(string $needle, array &$data): void
    {
        foreach ($data as $key => &$item) {
            if ($needle === $key) {

                if (is_string($item)) {
                    $item = [((string)Str::uuid()) => $item];

                    return;
                }

                if (is_array($item)) {
                    $files = [];

                    foreach ($item as $file) {

                        if (is_string($file)) {
                            $files[] = [((string)Str::uuid()) => $file];
                        }
                    }

                    if (!empty($files)) {
                        $item = $files[0] ?? null;
                    }

                    return;
                }
            }

            if (is_array($item) && !empty($item)) {
                $this->addUuidKeysForImageArrays($needle, $item);
            }
        }
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $form = clone $this->form;

        $form->dehydrateState($data);
        $form->mutateDehydratedState($data);

        $data = data_get($data, 'data', []);

        foreach ($data as $key => &$item) {
            if ($key === $this->getBuilderName()) {
                if (is_array($item)) {
                    $item = array_reduce($item, function ($carry, $i) {
                        if (empty($i)) return $carry;

                        $carry[] = $i;

                        return $carry;
                    }, []);
                }
            }
        }
        return parent::mutateFormDataBeforeSave($data);
    }

    public function getBuilderName(): ?string
    {
        return null;
    }
}
