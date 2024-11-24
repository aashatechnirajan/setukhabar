<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = array(
            ['समाचार', 'समाचार'],
            ['समाज', 'समाज'],
            ['विचार', 'विचार'],
            ['राजनिती', 'राजनिती'],
            ['मनाेरंजन','मनाेरंजन'],
            ['क्राइम', 'क-राइम'],
            ['अर्थ / व्यापार', 'अर-थ-व-यापार'],
            ['विश्व', 'विश्व'],
            ['खेलकुद', 'खेलकुद'],
            ['अनौठो संसार', 'अनौठो-स-सार'],
            ['फोटो फिचर','फोटो फिचर']
        );

        foreach ($categories as $category) {
            Category::create([
                'title'=>$category[0],
                'slug'=>$category[1]
            ]);
        }
    }
}
