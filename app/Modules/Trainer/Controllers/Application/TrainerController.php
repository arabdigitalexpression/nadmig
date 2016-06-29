<?php namespace App\Modules\Trainer\Controllers\Application;

use App\Base\Controllers\ApplicationController;
use App\Modules\Trainer\Models\Trainer;

class TrainerController extends ApplicationController {

  public function index(Trainer $trainer)
  {
      return view('Trainer::application.index', compact('trainer'));
  }
}
