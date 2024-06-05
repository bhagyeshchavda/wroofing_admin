<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class SettingSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->toDateTimeString();
        DB::table('settings')->insert([
            ['name' => 'favicon', 'value' => 'public/uploads/2022/12/adminltelogo-1.png', 'settings_updated_at' => $now],
            ['name' => 'logo', 'value' => 'public/uploads/2022/12/adminltelogo-1.png', 'settings_updated_at' => $now],
            ['name' => 'website_name', 'value' => 'Tax Salesupports', 'settings_updated_at' => $now],
            ['name' => 'phone_number', 'value' => '8004258068', 'settings_updated_at' => $now],
            ['name' => 'email', 'value' => 'ann@taxsupport.info', 'settings_updated_at' => $now],
            ['name' => 'company_address', 'value' => '<p>(800) 425-8068</p><p>ann@taxsalesupport.info</p><p>Tax Sale Support llc</p><p>1394 W State Rd.</p><p>Pleasant Grove, Utah 84062</p>', 'settings_updated_at' => $now],
            ['name' => 'facebook_link', 'value' => 'https://facebook.com', 'settings_updated_at' => $now],
            ['name' => 'linkedin_link', 'value' => 'https://linkedin.com', 'settings_updated_at' => $now],
            ['name' => 'pinterest_link', 'value' => 'https://in.pinterest.com', 'settings_updated_at' => $now],
            ['name' => 'twitter_link', 'value' => 'https://twitter.com', 'settings_updated_at' => $now],
            ['name' => 'youtube_link', 'value' => 'https://youtube.com', 'settings_updated_at' => $now],
            ['name' => 'header_tagline', 'value' => '#1 source for tax Sale Training & Lists', 'settings_updated_at' => $now],
            ['name' => 'footer_copyright_text', 'value' => 'Copyright © 2022 Tax Sales Support. all right reserved', 'settings_updated_at' => $now],
            ['name' => 'footer_image', 'value' => 'public/uploads/2022/12/adminltelogo-1.png', 'settings_updated_at' => $now],
        ]);
    }

     
}

