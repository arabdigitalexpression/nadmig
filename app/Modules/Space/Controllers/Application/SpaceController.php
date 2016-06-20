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
		$space['reservations'] = $space->organization->reservations()->where("status", "accepted")->take(4)->get();
		foreach ($space['reservations'] as $reservation) {
			$reservation['sessions'] = $reservation->sessions;
		}
		$space['organization'] = $space->organization;
		foreach ($space->toArray() as $key => $value) {
            if ($this->isJson($value)) {
              $space[$key] = json_decode($value);
            }     
        } 
		return view('Space::application.index', compact('space'));
	}
}
