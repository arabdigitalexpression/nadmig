<?php namespace App\Modules\Event\Controllers\Application;

use Laracasts\Flash\Flash;
use App\Base\Controllers\ApplicationController;
use App\Modules\Event\Models\Event;
use App\Modules\Apply\Models\Apply;
use App\Modules\Space\Models\Space;
use App\Modules\Reservation\Models\Reservation;
use App\Base\Controllers\LogController;
use Auth;
use Input;
class EventController extends ApplicationController {

  public function index(Event $event)
  {

      $allSessions = $event->reservation->sessions()->where("status", "!=" ,"deleted")->get();
      foreach ($allSessions as $key_1 => $sessions) {
          $sessions['start_timestamp'] = strtotime($sessions['start_date']);
          $sessions->space;
      }
      $sessions = $allSessions->toArray();
      $this->sortBy("start_timestamp",$sessions);
      $event->reservation->sessions = $sessions;
      $event->reservation->organization;
      if(Auth::check()){
        $event['apply'] = $event->apply()->where('user_id', '=', Auth::user()->id)->get();
      }
      return view('Event::application.index', compact('event'));
  }
  public function all()
  {  	
    $settings = include base_path('./resources/settings.php');
    $params = Input::get();
    if(isset($params['event_tags']) && $params['event_tags'] != ''){
      $organizations = [];
      if (isset($params['governorate'])) {
        $spaces = Space::where('governorate', $params['governorate'])->get();
        $organizations = array_unique($spaces->pluck('organization_id')->toArray());
      }
      $et = explode(",", Input::get("event_tags"));
      $reservations = Reservation::where(function ($query) use($et) {
                  foreach($et as $item){
                      if ($item != '') {
                        $query->orwhere('event_tags', 'like',  '%' . $item .'%');
                      }
                  } 
                  if (Input::get('start_date') != '') {
                      if (Input::get('expression') == 'or') {
                        $query->orwhere('start_date', Input::get('start_date'));  
                      } elseif (Input::get('expression') == 'and') {
                        $query->where('start_date', Input::get('start_date'));  
                      }
                  }
            })->whereIn('organization_id', $organizations)->where('event_type', 'public')->where('status', 'accepted')->paginate(10);
    }
    else if (isset($params['governorate'])){
      unset($params['page']);
      $spaces = Space::where('governorate', $params['governorate'])->get();
      $reservations = Reservation::whereIn('organization_id', array_unique($spaces->pluck('organization_id')->toArray()))->where('event_type', 'public')->where('status', 'accepted')->paginate(10);
    } else {
      $reservations = Reservation::Where('event_type', 'public')->where('status', 'accepted')->paginate(10);
    }
    foreach ($reservations as $reservation) {
        $reservation['start_date'] = $reservation->sessions[0]['start_date'];
        $reservation['start_session'] = $reservation->sessions[0];
    }
    return view('Event::application.all', [ 'reservations' => $reservations->appends(Input::except('page')), 'event_tags' => $settings['event_tags']]);
  }
  public function apply(Event $event){
    if (Auth::check()) {
      if (!Apply::where('event_id', $event->id)->where('user_id', Auth::user()->id)->exists()) {
        $event->apply()->save(new Apply());
        Flash::success(trans('application.event.apply.success'));
      }else{
        Flash::warning(trans('application.event.apply.before'));      
      }
      return redirect()->back();
    }else{
      abort(403);
    }
    
  }
}
