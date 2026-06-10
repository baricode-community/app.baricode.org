<?php

namespace App\Filament\Pages;

use App\Settings\PlatformSettings;
use BackedEnum;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Pages\SettingsPage;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class ManagePlatformSettings extends SettingsPage
{
    protected static BackedEnum|string|null $navigationIcon = Heroicon::OutlinedCog6Tooth;
    protected static ?string $navigationLabel = 'Platform Settings';
    protected static ?string $title = 'Platform Settings';
    protected static UnitEnum|string|null $navigationGroup = 'Utilities';
    protected static ?int $navigationSort = 99;

    protected static string $settings = PlatformSettings::class;

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Identitas Platform')
                    ->icon(Heroicon::OutlinedBuildingOffice)
                    ->columns(2)
                    ->components([
                        TextInput::make('platform_name')
                            ->label('Nama Platform')
                            ->required()
                            ->columnSpanFull(),
                        Textarea::make('platform_description')
                            ->label('Deskripsi Platform')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),

                Section::make('Kontak')
                    ->icon(Heroicon::OutlinedChatBubbleLeftEllipsis)
                    ->columns(2)
                    ->components([
                        TextInput::make('whatsapp_number')
                            ->label('Nomor WhatsApp')
                            ->placeholder('628xxxxxxxxxx')
                            ->tel(),
                        TextInput::make('contact_email')
                            ->label('Email Kontak')
                            ->email(),
                        TextInput::make('whatsapp_group_url')
                            ->label('Link Grup WhatsApp')
                            ->url()
                            ->columnSpanFull(),
                        TextInput::make('telegram_channel')
                            ->label('Link Channel/Grup Telegram')
                            ->url()
                            ->columnSpanFull(),
                    ]),

                Section::make('Sosial Media')
                    ->icon(Heroicon::OutlinedGlobeAlt)
                    ->columns(2)
                    ->components([
                        TextInput::make('youtube_url')
                            ->label('YouTube')
                            ->url(),
                        TextInput::make('github_url')
                            ->label('GitHub')
                            ->url(),
                        TextInput::make('tiktok_url')
                            ->label('TikTok')
                            ->url(),
                        TextInput::make('discord_url')
                            ->label('Discord')
                            ->url(),
                    ]),
            ]);
    }
}
