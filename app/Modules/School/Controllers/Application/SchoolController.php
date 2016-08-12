<?php namespace App\Modules\School\Controllers\Application;

use App\Base\Controllers\ApplicationController;
use App\Modules\School\Models\School;

class SchoolController extends ApplicationController {

  public function index(School $school)
  {
  	$schools = School::orderBy('id', 'desc')->get();
  // 	foreach ($schools as $school) {
  // 		$sessions = array();
  // 		foreach ($school->program->events as $event) {
  // 			$event->reservation->sessions;
  // 			$event_sessions = $event->reservation->sessions->toArray();
  // 			foreach ($event_sessions as $key => $session) {
  // 				$event_sessions[$key]['start_timestamp'] = strtotime($session['start_date']);
  // 			}
	 //        $this->sortBy("start_timestamp",$event_sessions);
	 //        array_push($sessions, $event_sessions[0]);
	 //        array_push($sessions, end($event_sessions));
  // 		};
  // 		$this->sortBy("start_timestamp",$sessions);
  // 		$school->program['start_session'] = array_shift($sessions);
		// $school->program['end_session'] = array_pop($sessions);
  // 	}
    return view('School::application.index', compact('schools'));
  }
}
