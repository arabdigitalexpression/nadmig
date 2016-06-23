<?php namespace App\Modules\Space\Controllers\Api\DataTables;

use App\Modules\Space\Models\Space;
use App\Modules\Space\Base\Controllers\ModuleDataTableController;
use Auth;
use DB;
class SpaceDataTable extends ModuleDataTableController {

  protected $columns = ['name'];
  protected $pluck_columns = ['organization_id' => ['organization', 'name']];
  protected $common_columns = ['created_at', 'updated_at'];
  protected $image_columns = ['logo'];
  protected $options = ['show', 'edit'];
  public function query()
  {
      
      if (Auth::user()->hasRole('admin')) {
      	$space = Space::query();
      }else if(Auth::user()->hasRole('organization_manager')){
      	$space = $space = Space::query()->where('organization_id', Auth::user()->manageOrganization['id']);
      }
      else if(Auth::user()->hasRole('space_manager')){
        $space = $space = Space::query()->where('manager_id', Auth::user()->id);
      }
      return $this->applyScopes($space);
  }

}