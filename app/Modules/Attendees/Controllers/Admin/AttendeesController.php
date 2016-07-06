<?php namespace App\Modules\Attendees\Controllers\Admin;

use App\Modules\Attendees\Models\Attendees;
use App\Modules\Attendees\Requests\Admin\AttendeesRequest;
use App\Modules\Attendees\Base\Controllers\ModuleController;
use App\Modules\Attendees\Controllers\Api\DataTables\AttendeesDataTable;

class AttendeesController extends ModuleController {

  public function index(AttendeesDataTable $dataTable)
  {
      return $dataTable->render($this->viewPath());
  }

  public function store(AttendeesRequest $request)
  {
      return $this->createFlashRedirect(Attendees::class, $request);
  }

  public function show(Attendees $attendees)
  {
      return $this->viewPath("show", $attendees);
  }

  public function edit(Attendees $attendees)
  {
      return $this->getForm($attendees);
  }

  public function update(Attendees $attendees, AttendeesRequest $request)
  {
      return $this->saveFlashRedirect($attendees, $request);
  }

  public function destroy(Attendees $attendees)
  {
      return $this->destroyFlashRedirect($attendees);
  }

}
