<?php namespace App\Modules\Space\Controllers\Application;

use App\Base\Controllers\ApplicationController;
use App\Modules\Space\Models\Space;

class SpaceController extends ApplicationController {

  public function index(Space $space)
  {
      return view('Space::application.index', compact('space'));
  }
}
