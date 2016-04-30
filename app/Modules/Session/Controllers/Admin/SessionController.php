<?php namespace App\Modules\Session\Controllers\Admin;

use App\Modules\Session\Models\Session;
use App\Modules\Session\Requests\Admin\SessionRequest;
use App\Modules\Session\Base\Controllers\ModuleController;
use App\Modules\Session\Controllers\Api\DataTables\SessionDataTable;

class SessionController extends ModuleController {

  public function index(SessionDataTable $dataTable)
  {
      return $dataTable->render($this->viewPath());
  }

  public function store(SessionRequest $request)
  {
    return $this->createFlashRedirect(Session::class, $request);
  }

  public function show(Session $session)
  {
      return $this->viewPath("show", $session);
  }

  public function edit(Session $session)
  {
      return $this->getForm($session);
  }

  public function update(Session $session, SessionRequest $request)
  {
      return $this->saveFlashRedirect($session, $request);
  }

  public function destroy(Session $session)
  {
      return $this->destroyFlashRedirect($session);
  }

}
