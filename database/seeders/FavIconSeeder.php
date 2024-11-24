<?php

namespace Database\Seeders;

use App\Models\Favicon;
use Illuminate\Database\Seeder;

class FavIconSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Favicon::create([
            'favicon_thirtyTwo' => 'faviconThirtyTwo.png',
            'favicon_sixteen' => 'favIconSixteen.png',
            'apple_touch_icon' => 'appleTouchIcon.png',
            'file' => 'site.webmanifest',

        ]);
    }
}
