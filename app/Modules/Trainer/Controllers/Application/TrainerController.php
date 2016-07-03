<?php namespace App\Modules\Trainer\Controllers\Application;

use App\Base\Controllers\ApplicationController;
use App\Modules\Trainer\Models\Trainer;
use Auth;
class TrainerController extends ApplicationController {

  public function index($trainer_slug)
  {
  	$trainer = Trainer::findBySlug($trainer_slug);
    return view('Trainer::application.index', compact('trainer'));
  }
  public function me()
  {
  	if (Auth::user()->trainer) {
  		$trainer = Auth::user()->trainer;
    	return view('Trainer::application.index', compact('trainer'));
  	}
  	abort(404);
  }
  public function list()
  {	
  	$trainers  = Trainer::all();
    return view('Trainer::application.list', compact('trainers'));
  }
}
