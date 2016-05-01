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

  private $imageColumn = "";

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
    unset($request['session']);
    $request['space_id'] = $space_slug['id'];
    $request['user_id'] = Auth::user()->id;
    $request['status'] = "pending";
    $request['url_id'] = md5(Auth::user()->id . $request['name'] . time());
    // dd($request->toArray());
    $model = Reservation::create($this->getDataP($request, ""));
    $model->id ? Flash::success(trans('application.create.success')) : Flash::error(trans('application.create.fail'));
    // dd($model->id);
    foreach ($sessions as $session) {
      $session['reservation_id'] = $model->id;
      foreach ($session as $key => $value) {
          if (is_array($value)) {
              $session[$key] = json_encode($value);
          }
      }
      Session::create($session)->save();
    }
    return $this->redirectRoutePath("index", null, $model);
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
