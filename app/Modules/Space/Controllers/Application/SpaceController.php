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
      	// $space->organization->reservations()->where("status", "accepted")->take(6)->get();
		$space['organization'] = $space->organization;
  //     	foreach ($space->organization->reservations->where("status", "accepted")->take(6)->get() as $key => $reservation) {
		// 	$reservation['sessions'] = $reservation->sessions()->where("space_id", $space->id)->get()->toArray();
		// }
		return view('Space::application.index', compact('space'));
	}
}
