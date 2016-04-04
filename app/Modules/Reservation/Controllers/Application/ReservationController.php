<?php namespace App\Modules\Reservation\Controllers\Application;

use Auth;
use Hash;
use App\Base\Controllers\ApplicationController;
use App\Modules\Reservation\Models\Reservation;
use App\Modules\Space\Models\Space;
use App\Modules\Reservation\Requests\Application\ReservationRequest;
class ReservationController extends ApplicationController {

  public function list(Reservation $reservation)
  {
      return view('Reservation::application.index', compact('reservation'));
  }
  public function index($reservation_url_id)
  {
  	$reservation = Reservation::where('url_id', $reservation_url_id)->first();
      return view('Reservation::application.index', compact('reservation'));
  }
  public function create($space_slug){
  	return $this->getForm(null, ['space_slug' => $space_slug['slug']], $space_slug);
  }
  public function store(ReservationRequest $request, $space_slug)
  {	

  	$request['space_id'] = $space_slug['id'];
  	$request['user_id'] = Auth::user()->id;
  	$request['status'] = "pending";
  	$request['url_id'] = md5(Auth::user()->id . $request['name'] . time());
    return $this->createFlashRedirect(Reservation::class, $request);
  }
  public function edit($reservation_url_id)
  {
  	$reservation = Reservation::where('url_id', $reservation_url_id)->first();
  	foreach ($reservation->toArray() as $key => $value) {
          if ($this->isJson($value)) {
              $reservation[$key] = json_decode($value);
          }
      }
  	$space = Space::findOrFail($reservation['space_id']);
      return $this->getForm($reservation, ['reservation_url_id' => $reservation['url_id']], $space);
  }
  public function update($reservation_url_id, ReservationRequest $request)
  {
  	$reservation = Reservation::where('url_id', $reservation_url_id)->first();
      return $this->saveFlashRedirect($reservation, $request);
  }
  protected function isJson($string) {
   json_decode($string);
   return (json_last_error() == JSON_ERROR_NONE);
  }
}
