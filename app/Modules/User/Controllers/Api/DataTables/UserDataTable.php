<?php namespace App\Modules\User\Controllers\Api\DataTables;

use App\Modules\User\Models\User;
use App\Modules\User\Base\Controllers\ModuleDataTableController;

class UserDataTable extends ModuleDataTableController {

   /**
     * Columns to show
     *
     * @var array
     */
    protected $columns = ['name', 'email', 'ip_address', 'logged_in_at', 'logged_out_at'];

    /**
     * Image columns to show
     *
     * @var array
     */
    protected $image_columns = ['picture'];

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $users = User::query();
        return $this->applyScopes($users);
    }

}
