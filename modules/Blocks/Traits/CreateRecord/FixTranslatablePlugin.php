<?php

namespace Modules\Blocks\Traits\CreateRecord;

trait FixTranslatablePlugin
{
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $form = clone $this->form;

        $form->dehydrateState($data);
        $form->mutateDehydratedState($data);

        return parent::mutateFormDataBeforeCreate(data_get($data, 'data', []));
    }
}
