<?php namespace App\Modules\Role\Controllers\Admin;

use App\Modules\Role\Models\Role;
use App\Modules\Role\Requests\Admin\RoleRequest;
use App\Modules\Role\Base\Controllers\ModuleController;
use App\Modules\Role\Controllers\Api\DataTables\RoleDataTable;

class RoleController extends ModuleController {

  public function index(RoleDataTable $dataTable)
  {
      return $dataTable->render($this->viewPath());
  }

  public function store(RoleRequest $request)
  {
      return $this->createFlashRedirect(Role::class, $request);
  }

  public function show(Role $role)
  {
      return $this->viewPath("show", $role);
  }

  public function edit(Role $role)
  {

      return $this->getForm($role);
  }

  public function update(Role $role, RoleRequest $request)
  {
    if($request['permission']){
        $role->perms()->sync($request['permission']);
    }
      return $this->saveFlashRedirect($role, $request);
  }

  public function destroy(Role $role)
  {
      return $this->destroyFlashRedirect($role);
  }

}
