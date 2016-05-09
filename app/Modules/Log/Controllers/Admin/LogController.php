<?php namespace App\Modules\Log\Controllers\Admin;

use App\Modules\Log\Models\Log;
use App\Modules\Log\Requests\Admin\LogRequest;
use App\Modules\Log\Base\Controllers\ModuleController;
use App\Modules\Log\Controllers\Api\DataTables\LogDataTable;

class LogController extends ModuleController {

  public function index(LogDataTable $dataTable)
  {
      return $dataTable->render($this->viewPath());
  }

  public function store(LogRequest $request)
  {
      return $this->createFlashRedirect(Log::class, $request);
  }

  public function show(Log $log)
  {
      return $this->viewPath("show", $log);
  }

  public function edit(Log $log)
  {
      return $this->getForm($log);
  }

  public function update(Log $log, LogRequest $request)
  {
      return $this->saveFlashRedirect($log, $request);
  }

  public function destroy(Log $log)
  {
      return $this->destroyFlashRedirect($log);
  }

}
