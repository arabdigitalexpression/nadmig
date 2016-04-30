<?php namespace App\Modules\Session\Controllers\Application;

use App\Base\Controllers\ApplicationController;
use App\Modules\Session\Models\Session;

class SessionController extends ApplicationController {

  public function index(Session $session)
  {
      return view('Session::application.index', compact('session'));
  }
}
