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
                Section::make('Зміна пароля')
                    ->aside()
                    ->description('Оновіть свій пароль')
                    ->schema([
                        Password::make('password')
                            ->label('Новий пароль')
                            ->required()
                            ->password()
                            ->rule('min:8')
                            ->dehydrated()
                            ->validationMessages([
                                'same' => 'Паролі не співпадають.',
                            ])
                            ->same('password_confirmation'),
                        Password::make('password_confirmation')
                            ->label('Підтвердження пароля')
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
