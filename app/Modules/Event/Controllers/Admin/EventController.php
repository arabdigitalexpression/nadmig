<?php namespace App\Modules\Event\Controllers\Admin;

use App\Modules\Event\Models\Event;
use App\Modules\Event\Requests\Admin\EventRequest;
use App\Modules\Event\Base\Controllers\ModuleController;
use App\Modules\Event\Controllers\Api\DataTables\EventDataTable;

class EventController extends ModuleController {

  public function index(EventDataTable $dataTable)
  {
      return $dataTable->render($this->viewPath());
  }
  public function show(Event $event)
  {
      return redirect()->route('event.page', ['event_slug' => $event->slug]);
  }
}
