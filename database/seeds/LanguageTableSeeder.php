<?php

use Illuminate\Database\Seeder;
use App\Language;

class LanguageTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('languages')->delete();
        Language::create(['title' => 'Arabic', 'code' => 'ar', 'site_title' => 'ندمج', 'site_description' => 'نظام إدارة المساحات المجتمعية']);
    }
}
