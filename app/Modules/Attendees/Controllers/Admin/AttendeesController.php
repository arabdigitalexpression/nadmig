<?php namespace App\Modules\Attendees\Controllers\Admin;

use App\Modules\Attendees\Models\Attendees;
use App\Modules\Attendees\Requests\Admin\AttendeesRequest;
use App\Modules\Attendees\Base\Controllers\ModuleController;
use App\Modules\Attendees\Controllers\Api\DataTables\AttendeesDataTable;
use Auth;
class AttendeesController extends ModuleController {

  public function index(AttendeesDataTable $dataTable)
  {
      return $dataTable->render($this->viewPath());
  }

  public function store(AttendeesRequest $request)
  {
    if(Auth::user()->hasRole('organization_manager') && $attendees->organization_id == Auth::user()->manageOrganization->id){
      $request['organization_id'] = Auth::user()->manageOrganization->id;
    }
    return $this->createFlashRedirect(Attendees::class, $request);
  }

  public function show(Attendees $attendees)
  {
      return $this->viewPath("show", $attendees);
  }

  public function edit(Attendees $attendees)
  {
    if(Auth::user()->hasRole('organization_manager') && $attendees->organization_id == Auth::user()->manageOrganization->id || Auth::user()->hasRole('admin')){
      return $this->getForm($attendees);
    } 
    abrot(401);
  }

  public function update(Attendees $attendees, AttendeesRequest $request)
  {
    if(Auth::user()->hasRole('organization_manager') && $attendees->organization_id == Auth::user()->manageOrganization->id || Auth::user()->hasRole('admin')){
      if($request['workshop']){
          $attendees->events()->sync($request['workshop']);    
      }
        return $this->saveFlashRedirect($attendees, $request);
    }
    abrot(401);
  }

  public function destroy(Attendees $attendees)
  {
      return $this->destroyFlashRedirect($attendees);
  }

}
