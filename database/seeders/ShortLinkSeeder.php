<?php

namespace Database\Seeders;

use App\Models\ShortLink;
use Illuminate\Database\Seeder;

class ShortLinkSeeder extends Seeder
{
    public function run(): void
    {
        ShortLink::factory()->active()->create([
            'title' => 'Telegram Baricode',
            'description' => 'Channel Telegram komunitas Baricode untuk update terbaru.',
            'real_url' => 'https://t.me/baricode_org',
            'slug' => 'tg',
        ]);

        ShortLink::factory()->active()->create([
            'title' => 'TikTok Baricode',
            'description' => 'Konten coding seru dan meme developer di TikTok Baricode.',
            'real_url' => 'https://www.tiktok.com/@baricode_org',
            'slug' => 'tiktok',
        ]);

        ShortLink::factory(8)->create();
    }
}
