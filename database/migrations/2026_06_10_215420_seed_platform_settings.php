<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $rows = [
            ['platform_name', 'Baricode Community'],
            ['platform_description', 'Platform komunitas IT Indonesia untuk belajar, berbagi, dan berkolaborasi.'],
            ['whatsapp_number', null],
            ['whatsapp_group_url', null],
            ['telegram_channel', null],
            ['contact_email', null],
            ['youtube_url', null],
            ['github_url', null],
            ['tiktok_url', null],
            ['discord_url', null]
        ];

        foreach ($rows as [$name, $value]) {
            DB::table('settings')->insert([
                'group' => 'platform',
                'name' => $name,
                'locked' => false,
                'payload' => json_encode($value),
            ]);
        }
    }

    public function down(): void
    {
        DB::table('settings')->where('group', 'platform')->delete();
    }
};
