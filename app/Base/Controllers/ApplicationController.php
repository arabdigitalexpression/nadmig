<?php

namespace App\Base\Controllers;

use FormBuilder;
use App\Language;
use Laracasts\Flash\Flash;
use App\Base\Services\ImageService;
use App\Http\Controllers\Controller;
use App\Base\Controllers\LogController;
abstract class ApplicationController extends Controller
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
        $this->formPath = $this->getFormPath();
        $this->language = session('current_lang');
    }

    /**
     * Get select list for languages
     *
     * @return mixed
     */
    protected function getSelectList()
    {
        return Language::pluck('title', 'id')->all();
    }
    /**
     * Get form
     *
     * @param null $object
     * @return \BladeView|bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getForm($object = null, $routeData = null, $extra = null)
    {
        if ($object) {
            $url =  $this->urlRoutePath("update", $object, $routeData);
            $method = 'PATCH';
            $path = $this->viewPath("edit");
        } else {
            $url =  $this->urlRoutePath("store", $object, $routeData);
            $method = 'POST';
            $path = $this->viewPath("create");
        }
        $form = $this->createForm($url, $method, $object, $extra);

        return view($path, compact('form', 'object', 'extra'));
    }

    /**
     * Create form
     *
     * @param $url
     * @param $method
     * @param $model
     * @return \Kris\LaravelFormBuilder\Form
     */
    protected function createForm($url, $method, $model, $extra = null)
    {
        // if($path == null) {
        //     $path = $this->formPath;
        // }
        if ($model) {
            return FormBuilder::create($this->formPath, [
                'method' => $method,
                'url' => $url,
                'model' => $model
            ], [ $extra ]);
        }else{
            return FormBuilder::create($this->formPath, [
                'method' => $method,
                'url' => $url,
            ], [ $extra ]);
        }
    }

    /**
     * Create, flash success or error then redirect
     *
     * @param $class
     * @param $request
     * @param bool|false $imageColumn
     * @param string $path
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createFlashRedirect($class, $request, $imageColumn = false, $path = "index")
    {

        $model = $class::create($this->getData($request, $imageColumn));
        $model->id ? Flash::success(trans('application.create.success')) : Flash::error(trans('application.create.fail'));
        LogController::Log($model, 'created');
        return $this->redirectRoutePath($path, null, $model);
    }

    /**
     * Save, flash success or error then redirect
     *
     * @param $model
     * @param $request
     * @param bool|false $imageColumn
     * @param string $path
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function saveFlashRedirect($model, $request, $imageColumn = false, $path = "index")
    {
        $model->fill($this->getData($request, $imageColumn));
        $model->save() ? Flash::success(trans('application.update.success')) : Flash::error(trans('application.update.fail'));
        LogController::Log($model, 'updated');
        return $this->redirectRoutePath($path, null, $model);
    }

    /**
     * Get data, if image column is passed, upload it
     *
     * @param $request
     * @param $imageColumn
     * @return mixed
     */
    public function getDataP($request, $imageColumn){
        return $this->getData($request, $imageColumn);
    }
    private function getData($request, $imageColumn)
    {
        $data = $request->all();
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $data[$key] = json_encode($value);
                $request->replace($data);
            }
        }
        return $imageColumn === false ? $request->all() : ImageService::uploadImage($request, $imageColumn);
    }
     /**
     * Get data, if image column is passed, upload it
     *
     * @param $request
     * @param $imageColumn
     * @return mixed
     */
    public function to_json($data){
        foreach ($data as $key => $value) {
          if (is_array($value)) {
              $data[$key] = json_encode($value);
          }
        }
        return $data;
    }
    /**
     * Delete and flash success or fail then redirect to path
     *
     * @param $model
     * @param string $path
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroyFlashRedirect($model, $path = "index")
    {
        $model->delete() ?
            Flash::success(trans('application.delete.success')) :
            Flash::error(trans('application.delete.fail'));
        return $this->redirectRoutePath($path);
    }

    /**
     * Returns redirect url path, if error is passed, show it
     *
     * @param string $path
     * @param null $error
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function redirectRoutePath($path = "index", $error = null, $model = null)
    {
        if ($error) {
            Flash::error(trans($error));
        }
        return redirect($this->urlRoutePath($path, $model));
    }

    /**
     * Returns full url
     *
     * @param string $path
     * @param bool|false $model
     * @return string
     */
    protected function urlRoutePath($path = "index", $model = false, $routeData = false)
    {
        if ($model) {
            if($routeData){
                $routeData = array_merge($routeData, array(snake_case($this->model) .'_slug' => $model->slug));
            }else{
                $routeData = array(snake_case($this->model) .'_slug' => $model->slug);
            }
            return route($this->routePath($path), $routeData);
        } else {
            if($routeData){
                return route($this->routePath($path), $routeData);
            }else{
                return route($this->routePath($path));
            }
            
        }
    }

    /**
     * Returns route path as string
     *
     * @param string $path
     * @return string
     */
    public function routePath($path = "index")
    {
        return 'application.' . snake_case($this->model) . '.' . $path;
    }

    /**
     * Returns view path for the admin
     *
     * @param string $path
     * @param bool|false $object
     * @return \BladeView|bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function viewPath($path = "index", $object = false)
    {
        $path = $this->model . '::application.' . $path;
        if ($object !== false) {
            return view($path, compact('object'));
        } else {
            return $path;
        }
    }

    /**
     * Returns view path for the admin
     *
     * @param string $path
     * @param bool|false $object
     * @return \BladeView|bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function viewPathWithArrayObject($path = "index", $object = [])
    {
        $path = 'application.' . str_plural(snake_case($this->model))  . '.' . $path;
        if ($object !== false) {
            return view($path, compact('object'));
        } else {
            return $path;
        }
    }
    /**
     * Get model name, if isset the model parameter, then get it, if not then get the class name, strip "Controller" out
     *
     * @return string
     */
    protected function getModel()
    {
        return empty($this->model) ?
            explode('Controller', substr(strrchr(get_class($this), '\\'), 1))[0]  :
            $this->model;
    }

    /**
     * Returns fully class name for form
     *
     * @return string
     */
    protected function getFormPath()
    {
        $model =  title_case(str_plural($this->model));
        return 'App\Modules\\'.$this->model.'\Forms\Application\\' . $model . 'Form';
    }
    /**
     * Returns if the value existe in array or not
     *
     * @return bool
     */
    public function in_array_field($value, $key, $array) {
        foreach ($array as $item){
            if (isset($item[$key]) && $item[$key] == $value)
                return true;
        }
        return false;
    } 
    /**
     * Returns if a string is json or not
     *
     * @return bool
     */
    protected function isJson($string) {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
    /**
     * send email
     *
     * @return bool
     */
    protected function sendEmail(){
        
    }
    protected function sortBy($field, &$array, $direction = 'asc')
    {
        usort($array, create_function('$a, $b', '
            $a = $a["' . $field . '"];
            $b = $b["' . $field . '"];

            if ($a == $b)
            {
                return 0;
            }

            return ($a ' . ($direction == 'desc' ? '>' : '<') .' $b) ? -1 : 1;
        '));

        return true;
    }
}
