<?php namespace App\Modules\Space\Controllers\Application;

use App\Base\Controllers\ApplicationController;
use App\Modules\Space\Models\Space;
use App\Setting;
use Input;
use DB;
class SpaceController extends ApplicationController {

	public function index()
	{	
		$settings = unserialize(file_get_contents(base_path('./resources/settings.bin')));
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
			            	$st = explode(",", Input::get("space_type"));
							if (Input::get('expression') == 'or') {
								foreach($st as $item){
								   	if ($item != '') {
								   		$query->orwhere('space_type', 'like',  '%' . $item .'%');
								   	}
								} 
							} elseif (Input::get('expression') == 'and') {
								$st = explode(",", Input::get("space_type"));
								foreach($st as $item){
								   	if ($item != '') {
								   		$query->where('space_type', 'like',  '%' . $item .'%');
								   	}
								}
							}
						}     
			        })->paginate(12);	

		}elseif(array_key_exists('space_type', Input::get())) {
			unset($params['page']);
			$st = explode(",", Input::get("space_type"));
			$spaces = Space::Where(function ($query) use($st) {
						foreach($st as $item){
						   	if ($item != '') {
						   		$query->orwhere('space_type', 'like',  '%' . $item .'%');
						   	}
						}   
			        })->paginate(12);
		}else {
			unset($params['page']);
			$spaces = Space::Where($params)->paginate(12);
		}
		return view('Space::application.all', ['spaces' => $spaces->appends(Input::except('page')), 'space_type' => $settings['space_type'], 'space_equipment' => $settings['space_equipment']]);
	}
	public function space(Space $space)
	{
      	$reservations = $space->organization->reservations()->where("status", "accepted")->where("event_type", "public")->take(8)->get();
      	foreach ($reservations as $key => $reservation) {
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
        $space->reservations = $reservations;
		return view('Space::application.index', compact('space'));
	}
}
