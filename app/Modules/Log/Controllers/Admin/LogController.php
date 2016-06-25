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
}
