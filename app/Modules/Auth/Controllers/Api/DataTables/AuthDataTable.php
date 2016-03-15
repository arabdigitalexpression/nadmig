<?php namespace App\Modules\Auth\Controllers\Api\DataTables;

use App\Modules\Auth\Models\Auth;
use App\Modules\Auth\Base\Controllers\ModuleDataTableController;

class AuthDataTable extends ModuleDataTableController {

  protected $columns = ['title'];

  protected $common_columns = ['created_at', 'updated_at'];

  public function query()
  {
      $auth = Auth::whereLanguageId(session('current_lang')->id);
      return $this->applyScopes($auth);
  }

}
