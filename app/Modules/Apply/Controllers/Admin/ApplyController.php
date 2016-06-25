<?php namespace App\Modules\Apply\Controllers\Admin;

use App\Modules\Apply\Models\Apply;
use App\Modules\Apply\Requests\Admin\ApplyRequest;
use App\Modules\Apply\Base\Controllers\ModuleController;
use App\Modules\Apply\Controllers\Api\DataTables\ApplyDataTable;

class ApplyController extends ModuleController {

  public function index(ApplyDataTable $dataTable)
  {

    return $dataTable->render($this->viewPath());
  }

}
