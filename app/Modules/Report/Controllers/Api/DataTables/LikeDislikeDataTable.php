<?php namespace App\Modules\Report\Controllers\Api\DataTables;

use App\Modules\Report\Models\LikeDislikeReport;
use App\Modules\Report\Base\Controllers\ModuleDataTableController;
use Auth;
class LikeDislikeDataTable extends ModuleDataTableController {

  protected $columns = ['user_id'];

  protected $common_columns = ['created_at', 'updated_at'];
  protected $options = ['show'];

  public function query()
  {
      $report = LikeDislikeReport::Query();
      return $this->applyScopes($report);
  }

}
