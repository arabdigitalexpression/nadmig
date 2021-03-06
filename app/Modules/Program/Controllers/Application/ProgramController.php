<?php namespace App\Modules\Program\Controllers\Application;

use App\Base\Controllers\ApplicationController;
use App\Modules\Program\Models\Program;
use Input;
class ProgramController extends ApplicationController {

  public function index(Program $program)
  {
  	foreach ($program->events as $event) {
  		$event->reservation->sessions;
  		$event_sessions = $event->reservation->sessions->toArray();
  		foreach ($event_sessions as $key => $session) {
  			$event_sessions[$key]['start_timestamp'] = strtotime($session['start_date']);
  		}
          $this->sortBy("start_timestamp",$event_sessions);
          $event->reservation->sessions = $event_sessions;
  	};
    return view('Program::application.index', compact('program'));
  }
  public function programs()
  {
  	$programs = Program::orderBy('id', 'desc')->paginate(10);
  	foreach ($programs as $program) {
  		$sessions = array();
  		foreach ($program->events as $event) {
  			$event->reservation->sessions;
  			$event_sessions = $event->reservation->sessions->toArray();
  			foreach ($event_sessions as $key => $session) {
  				$event_sessions[$key]['start_timestamp'] = strtotime($session['start_date']);
  			}
  			// dd($event_sessions);
	        $this->sortBy("start_timestamp",$event_sessions);
	        array_push($sessions, $event_sessions[0]);
	        array_push($sessions, end($event_sessions));
  		};
  		$this->sortBy("start_timestamp",$sessions);
  		$program['start_session'] = array_shift($sessions);
		$program['end_session'] = array_pop($sessions);
  	}
    $programs->appends(Input::except('page'));
  	return view('Program::application.list', compact('programs'));
  }
}
