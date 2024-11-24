<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'create_users',
            'view_users',
            'update_users',
            'delete_users',
            'create_roles', 
            'view_roles',
            'update_roles',
            'delete_roles',
            'create_permissions',
            'view_permissions',
            'update_permissions',
            'delete_permissions',
            'view_history',
            'permanent_delete_users',
            'restore_users',
            'view_deleted_users',
            'create_ads',
            'view_ads',
            'update_ads',
            'delete_ads',
            'create_categories',
            'view_categories',
            'update_categories',
            'delete_categories',
            'create_sections',
            'view_sections',
            'update_sections',
            'delete_sections',
            'create_displays',
            'view_displays',
            'update_displays',
            'delete_displays',
            'create_videos',
            'view_videos',
            'update_videos',
            'delete_videos',
            'create_posts',
            'view_posts',
            'update_posts',
            'delete_posts',
            'view_site_settings',
            'update_site_settings'



        ];
        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission
            ]);
        }
    }
}
