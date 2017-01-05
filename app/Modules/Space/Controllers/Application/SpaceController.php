<?php namespace App\Modules\Space\Controllers\Application;

use App\Base\Controllers\ApplicationController;
use App\Modules\Space\Models\Space;
use App\Setting;
use Input;
use DB;
class SpaceController extends ApplicationController {

	public function index()
	{	
		$settings = include base_path('./resources/settings.php');
		$params = Input::get();
		if(array_key_exists('space_equipment', Input::get())){
			unset($params['space_equipment']);
			unset($params['page']);
			$sq = explode(",", Input::get("space_equipment"));
			$spaces = Space::Where(function ($query) use($sq) {
			            foreach($sq as $item){
			               	if ($item != '') {
			               		$query->orwhere('space_equipment', 'like',  '%' . $item .'%');
			               	}
			            } 
			            if (Input::get('space_type') != '') {
							if (Input::get('expression') == 'or') {
								$query->orwhere('space_type', Input::get('space_type'));	
							} elseif (Input::get('expression') == 'and') {
								$query->where('space_type', Input::get('space_type'));	
							}
						}     
			        })->paginate(10);	

		}
		else {
			unset($params['page']);
			$spaces = Space::Where($params)->paginate(10);
		}
		return view('Space::application.all', ['spaces' => $spaces->appends(Input::except('page')), 'space_type' => $settings['space_type'], 'space_equipment' => $settings['space_equipment']]);
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
