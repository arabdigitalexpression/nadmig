<?php namespace App\Modules\Auth\Controllers\Admin;

use App\Modules\Auth\Models\Auth;
use App\Modules\Auth\Requests\Admin\AuthRequest;
use App\Modules\Auth\Base\Controllers\ModuleController;
use App\Modules\Auth\Controllers\Api\DataTables\AuthDataTable;

class AuthController extends ModuleController {

  public function index(AuthDataTable $dataTable)
  {
      return $dataTable->render($this->viewPath());
  }

  public function store(AuthRequest $request)
  {
      return $this->createFlashRedirect(Auth::class, $request);
  }

  public function show(Auth $auth)
  {
      return $this->viewPath("show", $auth);
  }

  public function edit(Auth $auth)
  {
      return $this->getForm($auth);
  }

  public function update(Auth $auth, AuthRequest $request)
  {
      return $this->saveFlashRedirect($auth, $request);
  }

  public function destroy(Auth $auth)
  {
      return $this->destroyFlashRedirect($auth);
  }

}
