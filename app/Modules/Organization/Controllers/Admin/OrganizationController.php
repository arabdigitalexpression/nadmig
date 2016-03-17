<?php namespace App\Modules\Organization\Controllers\Admin;

use App\Modules\Organization\Models\Organization;
use App\Modules\Organization\Requests\Admin\OrganizationRequest;
use App\Modules\Organization\Base\Controllers\ModuleController;
use App\Modules\Organization\Controllers\Api\DataTables\OrganizationDataTable;

class OrganizationController extends ModuleController {

  public function index(OrganizationDataTable $dataTable)
  {
      return $dataTable->render($this->viewPath());
  }

  public function store(OrganizationRequest $request)
  {
      return $this->createFlashRedirect(Organization::class, $request);
  }

  public function show(Organization $organization)
  {
      return $this->viewPath("show", $organization);
  }

  public function edit(Organization $organization)
  {
      return $this->getForm($organization);
  }

  public function update(Organization $organization, OrganizationRequest $request)
  {
      return $this->saveFlashRedirect($organization, $request);
  }

  public function destroy(Organization $organization)
  {
      return $this->destroyFlashRedirect($organization);
  }

}
