<?php namespace App\Modules\Organization\Controllers\Api\DataTables;

use App\Modules\Organization\Models\Organization;
use App\Modules\Organization\Base\Controllers\ModuleDataTableController;

class OrganizationDataTable extends ModuleDataTableController {

  protected $columns = ['title'];

  protected $common_columns = ['created_at', 'updated_at'];

  public function query()
  {
      $organization = Organization::whereLanguageId(session('current_lang')->id);
      return $this->applyScopes($organization);
  }

}
