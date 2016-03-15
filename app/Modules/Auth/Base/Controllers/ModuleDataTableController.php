<?php namespace App\Modules\Auth\Base\Controllers;

use App\Base\Controllers\DataTableController;

abstract class ModuleDataTableController extends DataTableController
{


    /**
     * Columns to show
     *
     * @var array
     */
    protected $columns =  [];


    /**
     * Show the action buttons, show, edit and delete
     *
     * @var bool
     */
    protected $ops = true;

    /**
     * Model name
     *
     * @var string
     */
    protected $model = "";


    /**
     * Get model name, if isset the model parameter, then get it, if not then get the class name, strip "DataTable" out
     *
     * @return string
     */
    private function getModelName()
    {
        return strtolower(
            empty($this->model) ?
            explode('DataTable', substr(strrchr(get_class($this), '\\'), 1))[0]  :
            $this->model
        );
    }

    /**
     * Translate column names
     *
     * @return array
     */
    protected function getColumns()
    {
        $model = $this->getModelName();
        $columns = [];

        $base_columns = array_merge($this->image_columns, $this->columns);
        foreach (array_merge($base_columns, array_keys($this->pluck_columns)) as $column) {
            $title = trans(studly_case($model).'::admin.fields.' . $model . '.' . $column);
            array_push($columns, ['data' => $column, 'name' => $column, 'title' => $title]);
        }
        foreach ($this->common_columns as $column) {
            $title = trans('admin.fields.' . $column);
            array_push($columns, ['data' => $column, 'name' => $column, 'title' => $title]);
        }
        if ($this->ops === true) {
            $title = trans('admin.ops.name');
            array_push($columns, [
                'data' => 'ops', 'name' => 'ops', 'title' => $title,
                'orderable' => false, 'searchable' => false
            ]);
        }
        return $columns;
    }

    /**
     * Translate DataTable parameters, such as search, showing number to number out of number entries exc.
     *
     * @return array
     */
    protected function getParameters()
    {
        return array_merge($this->parameters, ['oLanguage' => trans('admin.datatables')]);
    }
}
