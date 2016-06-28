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
        User::create(['name' => 'Admin', 'email' => 'm.mahrous@arabdigitalexpression.org', 'password' => '123456','birthday' => '14-2-1994', 'governorate' => 'giza', 'confirmed' => 1]);
    }
}
