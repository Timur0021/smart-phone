<?php

namespace Modules\SiteSettings\Action;

use Filament\Actions\Concerns\CanCustomizeProcess;
use Filament\Support\Facades\FilamentIcon;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\TrashedFilter;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use Modules\Requests\Mail\NewSubscribeEmailMail;
use Modules\Requests\Models\SubscribeEmail;
use Modules\SiteSettings\Mail\NewsLetterMail;
use Modules\SiteSettings\Models\Setting;

class SendLetterAction extends BulkAction
{
    use CanCustomizeProcess;

    public static function getDefaultName(): ?string
    {
        return 'send';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label('Send letters');

        $this->modalHeading(fn (): string => 'Send selected');

        $this->modalSubmitActionLabel('Send');

        $this->successNotificationTitle('Sent');

        $this->color('success');

        $this->icon(FilamentIcon::resolve('forms::components.repeater.actions.move-up') ?? 'heroicon-m-arrow-up');

        $this->requiresConfirmation();

        $this->modalIcon(FilamentIcon::resolve('forms::components.repeater.actions.move-up') ?? 'heroicon-m-arrow-up');

        $this->action(function (): void {
            $this->process(function (Collection $records) {
                $emails = SubscribeEmail::query()->get();
                $records->each(function (Model $record) use ($emails) {
                    foreach ($emails as $email) {
                        Mail::to($email->email)->queue(new NewsLetterMail($record));
                    }
                });
            });

            $this->success();
        });

        $this->deselectRecordsAfterCompletion();

        $this->hidden(function (HasTable $livewire): bool {
            $trashedFilterState = $livewire->getTableFilterState(TrashedFilter::class) ?? [];

            if (! array_key_exists('value', $trashedFilterState)) {
                return false;
            }

            if ($trashedFilterState['value']) {
                return false;
            }

            return filled($trashedFilterState['value']);
        });
    }
}
