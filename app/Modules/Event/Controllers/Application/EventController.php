<?php namespace App\Modules\Event\Controllers\Application;

use App\Base\Controllers\ApplicationController;
use App\Modules\Event\Models\Event;

class EventController extends ApplicationController {

  public function index(Event $event)
  {
      return view('Event::application.index', compact('event'));
  }
}
