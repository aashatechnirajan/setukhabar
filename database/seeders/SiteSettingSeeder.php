<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SiteSetting::create([
            'title'=>'Site Name',
            'location'=>'Site Address',
            'phone'=>'132465789',
            'email'=>'default@email.com',
            'facebook'=>'https://www.facebook.com/',
            'linkedin'=>'https://www.linkedin.com/',
            'twitter'=>'https://www.twitter.com/',
            'pinterest'=>'https://www.pinterest.com/',
            'main_logo' => 'main_logo.png',
            // 'side_logo' => 'side_logo.jpg',
            // 'flag_logo' => 'nepal_flag.gif',
        ]);
    }
}
