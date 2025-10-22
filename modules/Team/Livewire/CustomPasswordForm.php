<?php

namespace Modules\Team\Livewire;

use Filament\Forms\Components\Section;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
use Joaopaulolndev\FilamentEditProfile\Concerns\HasSort;
use Livewire\Component;
use Rawilk\FilamentPasswordInput\Password;

class CustomPasswordForm extends Component implements HasForms
{
    use InteractsWithForms;
    use HasSort;

    public ?array $data = [];

    protected static int $sort = 30;

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('uk.change_password'))
                    ->aside()
                    ->description(__('uk.update_your_password'))
                    ->schema([
                        Password::make('password')
                            ->label(__('uk.new_password'))
                            ->required()
                            ->password()
                            ->rule('min:8')
                            ->dehydrated()
                            ->validationMessages([
                                'same' => __('uk.passwords_do_not_match'),
                            ])
                            ->same('password_confirmation'),
                        Password::make('password_confirmation')
                            ->label(__('uk.password_confirmation'))
                            ->required()
                            ->password()
                            ->dehydrated(false),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        auth()->user()->update([
            'password' => Hash::make($data['password']),
        ]);

        Notification::make()
            ->title('Пароль оновлено!')
            ->success()
            ->send();
    }

    public function render(): View
    {
        return view('livewire.custom-password-form');
    }
}
