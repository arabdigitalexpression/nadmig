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
  public function show(Session $session)
  {
      return redirect()->route('session.page', ['session_slug' => $session->slug]);
  }

}
