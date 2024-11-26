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
            ['राजनिती', 'राजनिती'],
            ['शिक्षा', 'शिक्षा'],
            ['स्वास्थ्य', 'स्वास्थ्य'],
            ['उद्यम', 'उद्यम'],
            ['स्थानिय', 'स्थानिय'],
            ['वन तथा वातावरण', 'वन-तथा-वातावरण'],
            ['अर्थ', 'अर-थ'],
            ['विश्व', 'विश्व'],
            ['खेलकुद', 'खेलकुद'],
            ['विचार', 'विचार'],
            ['मनाेरंजन','मनाेरंजन'],
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



