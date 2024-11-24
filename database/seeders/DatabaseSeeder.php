<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            FavIconSeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            DisplaySeeder::class,
            SectionSeeder::class,
            SiteSettingSeeder::class,
            Role_PermissionSeeder::class
        ]);
    }
}
