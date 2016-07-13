<?php namespace App\Modules\Report\Controllers\Api\DataTables;

use App\Modules\Report\Models\Report8;
use App\Modules\Report\Base\Controllers\ModuleDataTableController;
use Auth;
class Report8DataTable extends ModuleDataTableController {

  protected $columns = ['what_happens', 'notes', 'does_it_achive_the_goal', 'trainer_explaination_intraction', 'trainer_answers', 'trainer_intraction', 'workshop_overall'];
  protected $pluck_columns = ['user_id' => ['user', 'name'], 'organization_id' => ['organization' , 'name']];
  protected $common_columns = [];
  protected $options = [];
  protected $ops = false;
  public function query()
  {
      $report = Report8::Query();
      return $this->applyScopes($report);
  }

}
