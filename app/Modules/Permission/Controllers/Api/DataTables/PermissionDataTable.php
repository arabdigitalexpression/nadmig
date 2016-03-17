<?php namespace App\Modules\Permission\Controllers\Api\DataTables;

use App\Modules\Permission\Models\Permission;
use App\Modules\Permission\Base\Controllers\ModuleDataTableController;

class PermissionDataTable extends ModuleDataTableController {

   /**
     * Columns to show
     *
     * @var array
     */
    protected $columns = ['name', 'display_name'];

    protected $common_columns = ['created_at', 'updated_at'];

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $roles = Permission::query();
        return $this->applyScopes($roles);
    }

}
