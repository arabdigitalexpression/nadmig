<?php namespace App\Modules\Event\Controllers\Application;

use App\Base\Controllers\ApplicationController;
use App\Modules\Event\Models\Event;

class EventController extends ApplicationController {

  public function index(Event $event)
  {
      return view('Event::application.index', compact('event'));
  }
  public function list()
  {
  	$events = Event::all();
  	foreach ($events as $event) {
        $event->reservation;
        foreach ($event->reservation->sessions->toArray() as $key_1 => $sessions) {
            $sessions['start_timestamp'] = strtotime($sessions['start_date']);
            foreach ($sessions as $key_2 => $session) {
                if ($this->isJson($session)) {
                  $event->reservation['sessions'][$key_1][$key_2] = json_decode($session);
                }     
            }  
        }
        $sessions = $event->reservation->sessions->toArray();
        $this->sortBy("start_date",$sessions);
        $event->reservation['start_session'] = $sessions[0];
    }
    return view('Event::application.all', compact('events'));
  }
}
