<?php

use Illuminate\Database\Seeder;

class PageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->insert([
        	'language_id' => 1,
            'title' => 'ندمج',
            'slug' => 'ندمج',
            'content' => 'وصف المنصة',
            'description' => 'وصف'
        ]);
    }
}
