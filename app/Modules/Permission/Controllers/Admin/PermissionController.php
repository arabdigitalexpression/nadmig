<?php namespace App\Modules\Permission\Controllers\Admin;

use App\Modules\Permission\Models\Permission;
use App\Modules\Permission\Requests\Admin\PermissionRequest;
use App\Modules\Permission\Base\Controllers\ModuleController;
use App\Modules\Permission\Controllers\Api\DataTables\PermissionDataTable;

class PermissionController extends ModuleController {

  public function index(PermissionDataTable $dataTable)
  {
      return $dataTable->render($this->viewPath());
  }

  public function store(PermissionRequest $request)
  {
      return $this->createFlashRedirect(Permission::class, $request);
  }

  public function show(Permission $permission)
  {
      return $this->viewPath("show", $permission);
  }

  public function edit(Permission $permission)
  {
      return $this->getForm($permission);
  }

  public function update(Permission $permission, PermissionRequest $request)
  {
      return $this->saveFlashRedirect($permission, $request);
  }

  public function destroy(Permission $permission)
  {
      return $this->destroyFlashRedirect($permission);
  }

}
