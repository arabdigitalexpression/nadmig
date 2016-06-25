<?php namespace App\Modules\Log\Controllers\Api\DataTables;

use Spatie\Activitylog\Models\Activity;
use App\Modules\Log\Base\Controllers\ModuleDataTableController;

class LogDataTable extends ModuleDataTableController {

  protected $columns = ['text'];
  protected $ops = false;
  protected $pluck_columns = ['user_id' => ['user', 'name']];
  protected $common_columns = ['created_at', 'updated_at'];
  protected $options = [];

  public function query()
  {
      $log = Activity::Query()->orderBy('id', 'DESC');
      return $this->applyScopes($log);
  }

}
