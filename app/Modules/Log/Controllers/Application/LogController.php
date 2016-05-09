<?php namespace App\Modules\Log\Controllers\Application;

use App\Base\Controllers\ApplicationController;
use App\Modules\Log\Models\Log;

class LogController extends ApplicationController {

  public function index(Log $log)
  {
      return view('Log::application.index', compact('log'));
  }
}
