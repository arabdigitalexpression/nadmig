<?php namespace App\Modules\Apply\Base\Controllers;

use App\Base\Controllers\AdminController;

abstract class ModuleController extends AdminController
{
    /**
     * Model name
     *
     * @var string
     */
    protected $model = "";

    /**
     * Form class path
     *
     * @var string
     */
    protected $formPath = "";

    /**
     * Current language
     *
     * @var mixed
     */
    protected $language;

    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        $this->model = $this->getModel();
        $this->formPath = $this->getFormModulePath();
        $this->language = session('current_lang');
    }

    public function viewPath($path = "index", $object = false)
    {
        $path = $this->model . '::dashboard.' . $path;
        if ($object !== false) {
            return view($path, compact('object'));
        } else {
            return $path;
        }
    }

    /**
     * Returns fully class name for form
     *
     * @return string
     */
    protected function getFormModulePath()
    {
        $model =  title_case(str_plural($this->model));
        return 'App\Modules\Apply\Forms\Admin\\' . $model . 'Form';
    }
}
