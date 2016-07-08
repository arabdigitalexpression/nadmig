<?php namespace App\Modules\Trainer\Controllers\Application;

use App\Base\Controllers\ApplicationController;
use App\Modules\Trainer\Models\Trainer;
use App\Modules\Trainer\Requests\Application\TrainerRequest;
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
  public function all()
  {	
  	$trainers  = Trainer::all();

    return view('Trainer::application.list', compact('trainers'));
  }
  public function edit($trainer_slug)
  {
    
    if(Auth::check()){
      $trainer = Trainer::findBySlug($trainer_slug);
      return $this->getForm($trainer, null, $trainer);
    }
    abort(403);
  }

  public function update($trainer_slug, TrainerRequest $request)
  {
      if(Auth::check()){
          $trainer = Trainer::findBySlug($trainer_slug);
          return $this->saveFlashRedirect($trainer, $request, null);
      }
      abort(403);
  }
}
