<?php namespace App\Modules\Apply\Controllers\Application;

use App\Base\Controllers\ApplicationController;
use App\Modules\Apply\Models\Apply;

class ApplyController extends ApplicationController {

  public function index(Apply $apply)
  {
      return view('Apply::application.index', compact('apply'));
  }
}
