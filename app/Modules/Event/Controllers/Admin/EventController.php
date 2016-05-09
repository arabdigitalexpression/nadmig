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

  public function store(EventRequest $request)
  {
      return $this->createFlashRedirect(Event::class, $request);
  }

  public function show(Event $event)
  {
      return $this->viewPath("show", $event);
  }

  public function edit(Event $event)
  {
      return $this->getForm($event);
  }

  public function update(Event $event, EventRequest $request)
  {
      return $this->saveFlashRedirect($event, $request);
  }

  public function destroy(Event $event)
  {
      return $this->destroyFlashRedirect($event);
  }

}
