<?php namespace App\Modules\School\Controllers\Application;

use App\Base\Controllers\ApplicationController;
use App\Modules\School\Models\School;

class SchoolController extends ApplicationController {

  public function index(School $school)
  {
      return view('School::application.index', compact('school'));
  }
}
