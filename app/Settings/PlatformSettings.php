<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class PlatformSettings extends Settings
{
    public string $platform_name;
    public string $platform_description;

    public ?string $whatsapp_number;
    public ?string $whatsapp_group_url;
    public ?string $telegram_channel;
    public ?string $contact_email;

    public ?string $youtube_url;
    public ?string $github_url;
    public ?string $tiktok_url;
    public ?string $discord_url;

    public static function group(): string
    {
        return 'platform';
    }
}
