<?php

namespace Database\Seeders;

use App\Models\Link;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LinksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Link::create([
            'id' => 1,
            'facebook' => null,
            'twitter' => null,
            'instagram' => null,
            'linkedin' => null,
            'tiktok' => null,
            'snapchat' => null,
            'email' => null,
            'number' => null,
            'whatsapp' => null,
            'app_store' => null,
            'google_play' => null,
            'logo' => null,
            'address' => null,
        ]);
    }
}
