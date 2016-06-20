<?php

use Illuminate\Database\Seeder;
use App\Modules\Permission\Models\Permission;
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->delete();
        Permission::create(['name' => 'create-orgnization', 'display_name' => 'إنشاء منظمة', 'description' => 'يمكنك انشاء منظمة']);
        Permission::create(['name' => 'edit-orgnization', 'display_name' => 'تعديل منظة', 'description' => 'تعديل منظة']);
        Permission::create(['name' => 'edit-my-orgnization', 'display_name' => 'تعديل المنظمتى', 'description' => 'يمكن لمدير حساب المنظمة تعديل البيانات بها']);
        Permission::create(['name' => 'create-space', 'display_name' => 'إنشاء مساحة', 'description' => 'يمكنه إنشاء مساحة']);
        Permission::create(['name' => 'edit-space', 'display_name' => 'تعديل المساحة', 'description' => 'تعديل المساحة']);
        Permission::create(['name' => 'create-my-space', 'display_name' => 'إنشاء مساحة للمنظمة', 'description' => 'يمكن لمدير المساحة إنشاء مساحته']);
        Permission::create(['name' => 'edit-my-space', 'display_name' => 'تعديل المساحتى', 'description' => 'يمكن لمدير المساحة تعديل مساحته فى نطاق المتفق عليه']);
        Permission::create(['name' => 'create-reservation', 'display_name' => 'إنشاء طلب حجز', 'description' => 'يمكنه إنشاء طلب حجز']);
        Permission::create(['name' => 'edit-reservation', 'display_name' => 'تعديل طلب حجز', 'description' => 'يمكنه تعديل طلب حجز']);
        DB::table('permission_role')->insert([
        	'permission_id' => 1, 
        	'role_id'		=> 1
        ],
        [
            'permission_id' => 2, 
            'role_id'       => 1
        ],
        [
            'permission_id' => 4, 
            'role_id'       => 1
        ],
        [
            'permission_id' => 5, 
            'role_id'       => 1
        ]
        );
    }
}
