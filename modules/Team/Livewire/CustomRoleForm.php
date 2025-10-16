<?php

namespace Modules\Team\Livewire;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Joaopaulolndev\FilamentEditProfile\Concerns\HasSort;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class CustomRoleForm extends Component implements HasForms
{
    use InteractsWithForms;
    use HasSort;

    public ?array $data = [];

    protected static int $sort = 20;

    public function mount(): void
    {
        $user = Auth::user();
        $this->form->fill([
            'role' => $user->getRoleNames()->first() ?? null,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Вибрати роль')
                    ->aside()
                    ->description('Виберіть роль свому користувачу')
                    ->schema([
                        Select::make('role')
                            ->label('Роль')
                            ->options(Role::query()->pluck('name', 'name')->toArray())
                            ->required(),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $user = Auth::user();
        $user->syncRoles([$data['role']]);
        $user->save();

        Notification::make()
            ->title('Роль оновлена!')
            ->success()
            ->send();
    }

    public function render(): View
    {
        return view('livewire.custom-profile-form');
    }
}
