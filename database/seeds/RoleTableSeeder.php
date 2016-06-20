<?php

use Illuminate\Database\Seeder;
use App\Modules\Role\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();
        Role::create(['name' => 'admin', 'display_name' => 'مدير النظام', 'description' => 'مدير الكلى للنظام']);
        Role::create(['name' => 'organization_manager', 'display_name' => 'مدير المنظّمة', 'description' => 'مدير الكلى للنظام']);
        Role::create(['name' => 'space_manager', 'display_name' => 'مدير المساحة', 'description' => 'مدير الكلى للنظام']);
        Role::create(['name' => 'user', 'display_name' => 'مستخدم', 'description' => 'مدير الكلى للنظام']);
        DB::table('role_user')->insert([
        	'user_id' => 1, 
        	'role_id'=> 1
        ]);
    }
}
