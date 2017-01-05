<?php

namespace App\Http\Controllers\Application;

use App\Base\Controllers\ApplicationController;
use App\Modules\Reservation\Models\Reservation;
use Input;
class HomeController extends ApplicationController
{
    /**
     * Show the application homepage to the user.
     *
     * @return Response
     */
    public function index()
    {
     	$reservations = Reservation::Where('event_type', 'public')->where('status', 'accepted')->limit(15)->get();
     	foreach ($reservations as $reservation) {
     	    $reservation['start_date'] = $reservation->sessions[0]['start_date'];
     	    $reservation['start_session'] = $reservation->sessions[0];
     	}
     	$reservations = $reservations->sortBy('start_date')->reverse();
     	// dd($reservations->toArray());
        return view('application.home.index', compact('reservations'));
    }
}
