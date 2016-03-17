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
    }
}
