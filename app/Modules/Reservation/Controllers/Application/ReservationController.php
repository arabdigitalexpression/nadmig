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
    $model = Reservation::create($this->getDataP($request, ""));
    $model->id ? Flash::success(trans('application.create.success')) : Flash::error(trans('application.create.fail'));
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
  	$space = Space::findOrFail($reservation['space_id']);
    return $this->getForm($reservation, ['reservation_url_id' => $reservation['url_id']], $space);
  }
  public function update($reservation_url_id, ReservationRequest $request)
  {
    $sessions = $request['session'];
    unset($request['session']);
    
  	$reservation = Reservation::where('url_id', $reservation_url_id)->first();
    $reservation->sessions;
    $reservation->fill($this->getDataP($request, ""));
    foreach ($sessions as $session) {
      foreach ($session as $key => $value) {
          if (is_array($value)) {
              $sessions[$key] = json_encode($value);
          }
      }
      $reservation->sessions()->associate($session);
      // Session::create($session)->save();
    }
    // dd($sessions);
    // foreach ($reservation->sessions as $index => $session) {
    //   foreach ($session as $key => $value) {
    //       if (is_array($value)) {
    //           $reservation->sessions[$index][$key] = json_encode($value);
    //       }
    //   }
    //   // $reservation->sessions[$index] = $sessions[0];
    //   // Session::findOrFail($session->id)->fill($session)->save;
    // }
    // $relations = $reservation->sessions;
    // foreach ($relations as $models) {
    //     // Make sure we pass an Array of models not just the model,
    //     // otherwise we will get an EloquentCollection back
    //     if ($models instanceof Model)
    //         $models = array($models);
    //     $models_collection = Collection::make($models);
    //     foreach ($models_collection as $model) {
    //         if ( ! $model->push()) return false;
    //     }
    // }
    
    // dd($reservation->sessions->toArray());
    $reservation->push() ? Flash::success(trans('application.update.success')) : Flash::error(trans('application.update.fail'));
    return $this->redirectRoutePath("index", null, $reservation);
  }
  protected function isJson($string) {
   json_decode($string);
   return (json_last_error() == JSON_ERROR_NONE);
  }
}
