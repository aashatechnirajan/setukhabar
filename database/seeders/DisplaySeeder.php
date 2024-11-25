<?php

namespace Database\Seeders;

use App\Models\Display;
use Illuminate\Database\Seeder;

class DisplaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $displays = [
            'After Navbar Section',
            'After Breaking News Section',
            'After Lead News Section',
            'After Main News Section',
            'Entertainment Section Left Side',
            'Economic Section Right Side',
            'Sports Section Right Side',
            'After Strange World Section',
            'Bottom Section',
            'After Main News Title',
            'After Main Posts',
            'Before World News',
            'Home Front',
            'Post Front',


        ];
        foreach ($displays as $display) {
            Display::create([
                'title'=>$display
            ]);
        }
    }
    // 'Right Fourth Section',
    // 'Left Sixth Section',
    // 'Left Eighth Section',
    // 'Below Breaking News',
    // 'Below Lead News',
    // 'Left Romanchak News',
    // 'Right Artha News',
    // 'Right Sports News',
}
