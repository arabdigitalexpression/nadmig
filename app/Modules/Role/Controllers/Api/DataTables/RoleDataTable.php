<?php namespace App\Modules\Role\Controllers\Api\DataTables;


use App\Role;
use App\Modules\User\Base\Controllers\ModuleDataTableController;

class RoleDataTable extends ModuleDataTableController {

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
        $roles = Role::query();
        return $this->applyScopes($roles);
    }

}
