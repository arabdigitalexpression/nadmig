<?php namespace App\Modules\Trainer\Controllers\Api\DataTables;

use App\Modules\Trainer\Models\Trainer;
use App\Modules\Trainer\Base\Controllers\ModuleDataTableController;

class TrainerDataTable extends ModuleDataTableController {

  protected $columns = ['bio'];
  protected $pluck_columns = ['user_id' => ['user', 'name']];
  protected $common_columns = ['created_at', 'updated_at'];
  protected $options = ['edit'];
  public function query()
  {
      $trainer = Trainer::Query();
      return $this->applyScopes($trainer);
  }

}
