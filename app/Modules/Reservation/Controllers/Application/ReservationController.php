<?php namespace App\Modules\Reservation\Controllers\Application;

use Auth;
use Hash;
use Laracasts\Flash\Flash;
use App\Base\Controllers\ApplicationController;
use App\Modules\Reservation\Models\Reservation;
use App\Modules\Space\Models\Space;
use App\Modules\Session\Models\Session;
use App\Modules\Reservation\Requests\Application\ReservationRequest;
class ReservationController extends ApplicationController {

private $imageColumn = "artwork";

public function list(Reservation $reservation)
{
    $reservations = Auth::user()->reservations;
    return view('Reservation::application.list', compact('reservations'));
}
public function index($reservation_url_id)
{
	$reservation = Reservation::where('url_id', $reservation_url_id)->first();
    return view('Reservation::application.index', compact('reservation'));
}
public function create($space_slug){
    $url =  $this->urlRoutePath("store", null, ['space_slug' => $space_slug['slug']]);
    $method = 'POST';
    $path = $this->viewPath("create");
    $extra = $space_slug;
    $form = $this->createForm($url, $method, null, $extra);
    return view($path, compact('form', 'extra'));
}
public function store(ReservationRequest $request, $space_slug)
{	
    $sessions = $request['session'];
    $reservation = new Reservation($this->getDataP($request, $this->imageColumn));
    $space_slug->reservations()->save($reservation) ? Flash::success(trans('application.create.success')) : Flash::error(trans('application.create.fail'));
    foreach ($sessions as $session) {
        $session = new Session($this->to_json($session));
        $reservation->sessions()->save($session);
    }
    return $this->redirectRoutePath("index", null, $reservation);
}
public function edit($reservation_url_id)
{
    $reservation = Reservation::where('url_id', $reservation_url_id)->first();
    $reservation->sessions;
    foreach ($reservation->toArray() as $key => $value) {
        if (is_array($value)) {
            foreach ($value as $key_1 => $sessions) {
                foreach ($sessions as $key_2 => $session) {
                    if ($this->isJson($session)) {
                      $reservation[$key][$key_1][$key_2] = json_decode($session);
                    }     
                }  
            }
        }
        elseif ($this->isJson($value)) {
            $reservation[$key] = json_decode($value);
        }
    }
    return $this->getForm($reservation, ['reservation_url_id' => $reservation['url_id']], $reservation->space);
}
public function update($reservation_url_id, ReservationRequest $request)
{
    $sessions = $request['session'];
    $reservation = Reservation::where('url_id', $reservation_url_id)->first();
    $reservation->sessions;
    $reservation->fill($this->getDataP($request, $this->imageColumn));
    foreach ($reservation->sessions as $session) {
        if (!$this->in_array_field($session->id, 'id', $sessions)) {
            Session::findOrFail($session->id)->delete();
        }
    }
    foreach ($sessions as $session) {
        if ($session['id'] == 0) {
            $session = new Session($this->to_json($session));
            $reservation->sessions()->save($session);
        }else{
            Session::findOrFail($session['id'])->update($this->to_json($session));
        }
    }
    $reservation->push() ? Flash::success(trans('application.update.success')) : Flash::error(trans('application.update.fail'));
    return $this->redirectRoutePath("index", null, $reservation);
}
}
