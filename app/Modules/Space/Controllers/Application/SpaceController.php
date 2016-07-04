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
      	$space->organization->reservations = $space->organization->reservations()->where("status", "accepted")->where("event_type", "public")->take(4)->get();
      	foreach ($space->organization->reservations()->where("status", "accepted")->where("event_type", "public")->take(4)->get() as $key => $reservation) {
	      	foreach ($reservation->sessions()->where('space_id', $space->id)->get() as $key_1 => $sessions) {
	            $sessions['start_timestamp'] = strtotime($sessions['start_date']);
	            foreach ($sessions as $key_2 => $session) {
	                if ($this->isJson($session)) {
	                  $space->organization->reservations[$key]['sessions'][$key_1][$key_2] = json_decode($session);
	                }     
	            }  
	        }
	        $sessions = $reservation->sessions()->where('space_id', $space->id)->get()->toArray();
	        if($sessions){
	        	$this->sortBy("start_date",$sessions);
	        	$space->organization->reservations[$key]['start_session'] = $sessions[0];
	        }
        }
		return view('Space::application.index', compact('space'));
	}
}
