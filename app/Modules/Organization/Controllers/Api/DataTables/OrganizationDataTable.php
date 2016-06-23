<?php namespace App\Modules\Organization\Controllers\Api\DataTables;

use App\Modules\Organization\Models\Organization;
use App\Modules\Organization\Base\Controllers\ModuleDataTableController;

class OrganizationDataTable extends ModuleDataTableController {

  protected $columns = ['name', 'excerpt'];
  protected $pluck_columns = ['manager_id' => ['manager', 'name']];
  protected $common_columns = ['created_at', 'updated_at'];
  protected $image_columns = ['logo'];
  protected $options = ['show', 'edit'];
  public function query()
  {
      $organization = Organization::Query();
      return $this->applyScopes($organization);
  }

}
