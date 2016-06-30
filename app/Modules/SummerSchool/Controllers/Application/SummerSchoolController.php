<?php namespace App\Modules\SummerSchool\Controllers\Application;

use App\Base\Controllers\ApplicationController;
use App\Modules\SummerSchool\Models\SummerSchool;

class SummerSchoolController extends ApplicationController {

  public function index(SummerSchool $summerSchool)
  {
      return view('SummerSchool::application.index', compact('summerSchool'));
  }
}
