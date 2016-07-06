<?php namespace App\Modules\School\Controllers\Admin;

use App\Modules\School\Models\School;
use App\Modules\School\Requests\Admin\SchoolRequest;
use App\Modules\School\Base\Controllers\ModuleController;
use App\Modules\School\Controllers\Api\DataTables\SchoolDataTable;

class SchoolController extends ModuleController {

  public function index(SchoolDataTable $dataTable)
  {
      return $dataTable->render($this->viewPath());
  }

  public function store(SchoolRequest $request)
  {
      return $this->createFlashRedirect(School::class, $request);
  }

  public function show(School $school)
  {
      return $this->viewPath("show", $school);
  }

  public function edit(School $school)
  {
      return $this->getForm($school);
  }

  public function update(School $school, SchoolRequest $request)
  {
    // if($request['kids']){
    //   $school->kids()->sync($request['kids']);    
    // }
    return $this->saveFlashRedirect($school, $request);
  }

  public function destroy(School $school)
  {
      return $this->destroyFlashRedirect($school);
  }

}
