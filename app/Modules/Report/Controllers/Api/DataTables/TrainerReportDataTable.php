<?php namespace App\Modules\Report\Controllers\Api\DataTables;

use App\Modules\Report\Models\TrainerReport;
use App\Modules\Report\Base\Controllers\ModuleDataTableController;

class TrainerReportDataTable extends ModuleDataTableController {

  protected $columns = ['user_id'];

  protected $common_columns = ['created_at', 'updated_at'];
  protected $options = ['show'];
  public function query()
  {
      $report = TrainerReport::Query();
      return $this->applyScopes($report);
  }

}
