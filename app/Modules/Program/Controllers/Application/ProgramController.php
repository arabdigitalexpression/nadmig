<?php namespace App\Modules\Program\Controllers\Application;

use App\Base\Controllers\ApplicationController;
use App\Modules\Program\Models\Program;

class ProgramController extends ApplicationController {

  public function index(Program $program)
  {
      return view('Program::application.index', compact('program'));
  }
  public function list()
  {
  	$programs = Program::orderBy('id', 'desc')->take(10)->get();
  	foreach ($programs as $program) {
  		foreach ($program->events as $event) {
  			$event->reservation->sessions;
  		};
  	}
  	dd($programs->toArray());
  }
}
