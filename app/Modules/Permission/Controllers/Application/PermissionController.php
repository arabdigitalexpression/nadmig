<?php namespace App\Modules\Permission\Controllers\Application;

use App\Base\Controllers\ApplicationController;
use App\Modules\Permission\Models\Permission;

class PermissionController extends ApplicationController {

  public function index(Permission $permission)
  {
      return view('Permission::application.index', compact('permission'));
  }
}
