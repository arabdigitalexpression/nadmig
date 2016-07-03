<?php namespace App\Modules\Report\Controllers\Api\DataTables;

use App\Modules\Report\Models\Report;
use App\Modules\Report\Base\Controllers\ModuleDataTableController;

class ReportDataTable extends ModuleDataTableController {

  protected $columns = ['title'];

  protected $common_columns = ['created_at', 'updated_at'];

  public function query()
  {
      $report = Report::whereLanguageId(session('current_lang')->id);
      return $this->applyScopes($report);
  }

}
