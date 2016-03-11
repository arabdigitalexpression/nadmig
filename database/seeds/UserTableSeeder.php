<?php

use Illuminate\Database\Seeder;
use App\Modules\User\Models\User as User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the user database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        User::create(['name' => 'Admin', 'email' => 'admin@admin.com', 'password' => '123456']);
    }
}
