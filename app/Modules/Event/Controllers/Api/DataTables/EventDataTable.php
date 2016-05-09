<?php namespace App\Modules\Event\Controllers\Api\DataTables;

use App\Modules\Event\Models\Event;
use App\Modules\Event\Base\Controllers\ModuleDataTableController;

class EventDataTable extends ModuleDataTableController {

  protected $columns = ['title'];

  protected $common_columns = ['created_at', 'updated_at'];

  public function query()
  {
      $event = Event::whereLanguageId(session('current_lang')->id);
      return $this->applyScopes($event);
  }

}
