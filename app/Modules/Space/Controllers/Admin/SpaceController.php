<?php namespace App\Modules\Space\Controllers\Admin;

use App\Modules\Space\Models\Space;
use App\Modules\Space\Requests\Admin\SpaceRequest;
use App\Modules\Space\Base\Controllers\ModuleController;
use App\Modules\Space\Controllers\Api\DataTables\SpaceDataTable;
use Auth;
class SpaceController extends ModuleController {
  /**
   * Image column of the model
   *
   * @var string
   */
  private $imageColumn = "logo";

  public function index(SpaceDataTable $dataTable)
  {
      return $dataTable->render($this->viewPath());
  }
  public function create()
  {
    if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('organization_manager')) {
      return $this->getForm();
    }
    return response('Unauthorized.', 401);   
  }

  public function store(SpaceRequest $request)
  {
    if (Auth::user()->hasRole('organization_manager') && Auth::user()->manageOrganization['id'] == $request['organization_id'] || Auth::user()->hasRole('admin')) {
      return $this->createFlashRedirect(Space::class, $request, $this->imageColumn);
    }
      
  }

  public function show(Space $space)
  {
    if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('organization_manager') && Auth::user()->manageOrganization['id'] || Auth::user()->hasRole('space_manager') && $space['manager_id'] == Auth::user()->id){
      return $this->viewPath("show", $space);
    }
     return response('Unauthorized.', 401); 
  }
  public function showMySpace()
  {
    $space = Auth::user()->manageSpace;
    if(Auth::user()->hasRole('space_manager')){
      return $this->viewPath("show", $space);
    }
    return response('Unauthorized.', 401);
  }

  public function edit(Space $space)
  { 
    
    // check if he is an admin
    if(Auth::user()->hasRole('admin') || (Auth::user()->hasRole('organization_manager') && Auth::user()->manageOrganization['id']) ||  (Auth::user()->hasRole('space_manager') && $space['manager_id'] == Auth::user()->id)){
      return $this->getForm($space);
    }
    return response('Unauthorized.', 401);
  }

  public function update(Space $space, SpaceRequest $request)
  {
    if(Auth::user()->hasRole('admin') || (Auth::user()->hasRole('organization_manager') && Auth::user()->manageOrganization['id']) ||  (Auth::user()->hasRole('space_manager') && $request['manager_id'] == Auth::user()->id) && $space['organization_id'] == $request['organization_id']){

      return $this->saveFlashRedirect($space, $request, $this->imageColumn);
    }
    return response('Unauthorized.', 401);
  }

  public function destroy(Space $space)
  {
    if(Auth::user()->hasRole('admin')){
      return $this->destroyFlashRedirect($space);
    }
  }
  protected function isJson($string) {
   json_decode($string);
   return (json_last_error() == JSON_ERROR_NONE);
  }
}
