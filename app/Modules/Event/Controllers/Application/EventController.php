<?php namespace App\Modules\Event\Controllers\Application;

use Laracasts\Flash\Flash;
use App\Base\Controllers\ApplicationController;
use App\Modules\Event\Models\Event;
use App\Modules\Apply\Models\Apply;
use App\Base\Controllers\LogController;
use Auth;
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
  	$events = Event::where('status', 'accepted')->get();
  	foreach ($events as $event) {
        $event->reservation;
        foreach ($event->reservation->sessions->toArray() as $key_1 => $sessions) {
            $sessions['start_timestamp'] = strtotime($sessions['start_date']);
        }
        $sessions = $event->reservation->sessions->toArray();
        $this->sortBy("start_date",$sessions);
        $event->reservation['start_session'] = $sessions[0];
    }
    return view('Event::application.all', compact('events'));
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
