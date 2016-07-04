<?php namespace App\Modules\Report\Controllers\Api\DataTables;

use App\Modules\Report\Models\SpaceManager2Report;
use App\Modules\Report\Base\Controllers\ModuleDataTableController;
use Auth;
class SpaceManager2ReportDataTable extends ModuleDataTableController {

  protected $columns = ['user_id'];

  protected $common_columns = ['created_at', 'updated_at'];
  protected $options = ['show'];

  public function query()
  {
      $report = SpaceManager2Report::Query();
      return $this->applyScopes($report);
  }

}
