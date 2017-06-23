<?php namespace App\Modules\Program\Controllers\Api\DataTables;

use App\Modules\Program\Models\Program;
use App\Modules\Program\Base\Controllers\ModuleDataTableController;
use Auth;
class ProgramDataTable extends ModuleDataTableController {

  protected $columns = ['name', 'description'];

  protected $common_columns = ['created_at', 'updated_at'];

  protected $image_columns = ['artwork'];
  protected $options = ['show', 'edit', 'delete'];
  public function query()
  {
      if(Auth::user()->hasRole('admin')){
      	$program = Program::Query();
      }elseif(Auth::user()->hasRole('organization_manager')){
      	$program = Program::Query()->where('user_id', Auth::user()->id);
      }
      return $this->applyScopes($program);
  }

}
