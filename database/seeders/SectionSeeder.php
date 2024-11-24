<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sections = array(
            ['Breaking News', 'breakingnews'],
            ['Lead News', 'leadnews'],
            ['Mukhya Samachar', 'mukhyasamachar'],
            // ['Rajniti News', 'rajnitinews'],
            // ['Romanchak News', 'romanchaknews'],
            // ['Crime News', 'crimenews'],
            // ['Sports News', 'sportsnews'],
            // ['Manoranjan News', 'manoranjannews'],
            // ['World News', 'worldnews'],
            // ['Artha Byapar News', 'arthabyaparnews'],
            // ['Information Technology News', 'informationtechnologynews'],
            // ['पढ्नै  पर्ने', 'पढ्नैपर्ने'],
            // ['Anya news', 'anyanews'],
            // ['विचार', 'विचार'],
            // ['Rochak News', 'rochaknews'],

        );
        foreach ($sections as $section) {
            Section::create([
                'title'=>$section[0],
                'slug'=>$section[1]
            ]);
        }
    }
}
