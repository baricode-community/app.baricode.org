<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\MultiSelect;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Spatie\Permission\Models\Role;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('username')
                    ->required(),
                Textarea::make('bio')
                    ->columnSpanFull(),
                TextInput::make('phone_number')
                    ->tel(),
                DateTimePicker::make('email_verified_at'),
                MultiSelect::make('roles')
                    ->relationship('roles', 'name')
                    ->options(Role::all()->pluck('name', 'id'))
                    ->label('Roles'),
                TextInput::make('password')
                    ->password()
                    ->dehydrateStateUsing(fn ($state) => filled($state) ? $state : null)
                    ->dehydrated(fn ($state) => filled($state))
                    ->label('Password (isi jika ingin mengubah)'),
            ]);
    }
}
