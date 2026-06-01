<?php

namespace App\Filament\Resources\JobListingResource\Schemas;

use App\Enums\JobBoard\JobListingStatus;
use App\Enums\JobBoard\JobType;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\DateTimePicker;
use Filament\Schemas\Schema;

class JobListingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextInput::make('title')
                    ->required()
                    ->label('Judul Posisi')
                    ->maxLength(255),

                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->label('Slug')
                    ->maxLength(5),

                TextInput::make('company_name')
                    ->required()
                    ->label('Nama Perusahaan')
                    ->maxLength(255),

                TextInput::make('company_logo')
                    ->url()
                    ->nullable()
                    ->label('URL Logo Perusahaan')
                    ->maxLength(500),

                Select::make('job_type')
                    ->label('Tipe Pekerjaan')
                    ->options(collect(JobType::cases())->mapWithKeys(
                        fn (JobType $t) => [$t->value => $t->label()]
                    ))
                    ->required(),

                Select::make('status')
                    ->label('Status')
                    ->options(collect(JobListingStatus::cases())->mapWithKeys(
                        fn (JobListingStatus $s) => [$s->value => $s->label()]
                    ))
                    ->default(JobListingStatus::Pending->value)
                    ->required(),

                TextInput::make('location')
                    ->required()
                    ->label('Lokasi')
                    ->maxLength(255),

                Toggle::make('is_remote')
                    ->label('Remote')
                    ->default(false),

                TextInput::make('tech_stack')
                    ->label('Tech Stack (JSON Array)')
                    ->nullable()
                    ->columnSpanFull()
                    ->helperText('Masukkan sebagai array JSON, misal: ["Laravel","Vue.js"]'),

                Textarea::make('description')
                    ->required()
                    ->rows(5)
                    ->label('Deskripsi Pekerjaan')
                    ->columnSpanFull(),

                Textarea::make('requirements')
                    ->required()
                    ->rows(5)
                    ->label('Persyaratan')
                    ->columnSpanFull(),

                TextInput::make('salary_min')
                    ->numeric()
                    ->nullable()
                    ->label('Gaji Minimum'),

                TextInput::make('salary_max')
                    ->numeric()
                    ->nullable()
                    ->label('Gaji Maksimum'),

                TextInput::make('salary_currency')
                    ->default('IDR')
                    ->label('Mata Uang')
                    ->maxLength(10),

                DateTimePicker::make('expires_at')
                    ->nullable()
                    ->label('Kadaluarsa'),

                TextInput::make('apply_url')
                    ->url()
                    ->nullable()
                    ->label('URL Lamaran')
                    ->maxLength(500)
                    ->columnSpanFull(),

                TextInput::make('apply_email')
                    ->email()
                    ->nullable()
                    ->label('Email Lamaran')
                    ->maxLength(255)
                    ->columnSpanFull(),

                Textarea::make('rejection_note')
                    ->label('Alasan Penolakan')
                    ->nullable()
                    ->rows(3)
                    ->columnSpanFull()
                    ->visible(fn ($get) => $get('status') === JobListingStatus::Rejected->value),
            ]);
    }
}
