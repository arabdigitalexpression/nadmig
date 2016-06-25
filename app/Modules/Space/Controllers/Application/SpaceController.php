<?php namespace App\Modules\Space\Controllers\Application;

use App\Base\Controllers\ApplicationController;
use App\Modules\Space\Models\Space;

class SpaceController extends ApplicationController {

	public function index()
	{
		$spaces = Space::all();
		return view('Space::application.all', compact('spaces'));
	}
	public function space(Space $space)
	{
		foreach ($space->toArray() as $key => $value) {
          if ($this->isJson($value)) {
            $space[$key] = json_decode($value);
          }     
      	} 
      	$space->organization->reservations = $space->organization->reservations()->where("status", "accepted")->where("event_type", "public")->take(4)->get();
      	foreach ($space->organization->reservations()->where("status", "accepted")->where("event_type", "public")->take(4)->get() as $key => $reservation) {
	      	foreach ($reservation->sessions->toArray() as $key_1 => $sessions) {
	            $sessions['start_timestamp'] = strtotime($sessions['start_date']);
	            foreach ($sessions as $key_2 => $session) {
	                if ($this->isJson($session)) {
	                  $space->organization->reservations[$key]['sessions'][$key_1][$key_2] = json_decode($session);
	                }     
	            }  
	        }
	        $sessions = $reservation->sessions->toArray();
	        $this->sortBy("start_date",$sessions);
	        $space->organization->reservations[$key]['start_session'] = $sessions[0];
        }
		return view('Space::application.index', compact('space'));
	}
}
