<?php namespace App\Modules\User\Controllers\Application;

use App\Base\Controllers\ApplicationController;
use App\Modules\User\Models\User;

class UserController extends ApplicationController {

  public function index(User $user)
  {
      return view('User::application.index', compact('user'));
  }
}
