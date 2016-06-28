<?php

namespace App\Base\Controllers;

// use App\User;
use FormBuilder;
use App\Language;
use Laracasts\Flash\Flash;
use App\Base\Services\ImageService;
use App\Http\Controllers\Controller;
use App\Base\Controllers\LogController;
abstract class AdminController extends Controller
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
     * Show the form for creating a new category.
     *
     * @return Response
     */
    public function create()
    {
        return $this->getForm();
    }

    /**
     * Get form
     *
     * @param null $object
     * @return \BladeView|bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getForm($object = null, $extra = null)
    {
        if ($object) {
            $url =  $this->urlRoutePath("update", $object);
            $method = 'PATCH';
            $path = $this->viewPath("edit");
        } else {
            $url =  $this->urlRoutePath("store", $object);
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
    protected function createForm($url, $method, $model, $extra)
    {
        // if($path == null) {
        //     $path = $this->formPath;
        // }

        return FormBuilder::create($this->formPath, [
                'method' => $method,
                'url' => $url,
                'model' => $model
            ], [
                $extra
            ]);
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
        $model->id ? Flash::success(trans('dashboard.create.success')) : Flash::error(trans('dashboard.create.fail'));
        if(class_basename($model) == "User"){
            if($request['role']){
                $model->roles()->sync(json_decode($request['role']));     
            }
        }else if(class_basename($model) == "Role"){
            if($request['permission']){
                $model->perms()->sync($request['permission']);    
            }
        }else if(class_basename($model) == "Program"){
            if($request['events']){
                $model->events()->sync(json_decode($request['events']));    
            }
        }
        LogController::Log($model, 'created');
        return $this->redirectRoutePath($path);
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
        $model->save() ? Flash::success(trans('dashboard.update.success')) : Flash::error(trans('dashboard.update.fail'));
        LogController::Log($model, 'updated');
        return $this->redirectRoutePath($path);
    }

    /**
     * Get data, if image column is passed, upload it
     *
     * @param $request
     * @param $imageColumn
     * @return mixed
     */
    private function getData($request, $imageColumn)
    {
        $data = $request->all();
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                if($key == 'links'){
                    $data[$key] = json_encode(array_values($value));
                }else{
                    $data[$key] = json_encode($value);
                }
                $request->replace($data);
            }
        }
        return $imageColumn === false ? $request->all() : ImageService::uploadImage($request, $imageColumn);
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
            Flash::success(trans('dashboard.delete.success')) :
            Flash::error(trans('dashboard.delete.fail'));
        return $this->redirectRoutePath($path);
    }

    /**
     * Returns redirect url path, if error is passed, show it
     *
     * @param string $path
     * @param null $error
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function redirectRoutePath($path = "index", $error = null)
    {
        if ($error) {
            Flash::error(trans($error));
        }
        return redirect($this->urlRoutePath($path));
    }

    /**
     * Returns full url
     *
     * @param string $path
     * @param bool|false $model
     * @return string
     */
    protected function urlRoutePath($path = "index", $model = false)
    {
        if ($model) {
            return route($this->routePath($path), ['id' => $model->id]);
        } else {
            return route($this->routePath($path));
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
        return 'dashboard.' . snake_case($this->model) . '.' . $path;
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
        $path = 'dashboard.' . str_plural(snake_case($this->model))  . '.' . $path;
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
        $path = 'dashboard.' . str_plural(snake_case($this->model))  . '.' . $path;
        if ($object !== false) {
            return view($path, compact('object'));
        } else {
            return $path;
        }
    }

    public function addToFrontendMenu($request, $page, $menu)
    {
        $menu->language_id = $request->get('language_id');
        $menu->name = $request->get('title');
        $menu->slug = $request->get('slug');
        $menu->type = $request->segment(2);


        $page->fill($request->all());
        $page->save() ? Flash::success(trans('dashboard.update.success')) : Flash::error(trans('dashboard.update.fail'));
        $page->frontMenu()->save($menu);
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

    protected function getPageTemplate($model)
    {
        return 'App\Forms\Admin\\' . $model . 'Form';
        return 'page template';
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
        return 'App\Forms\Admin\\' . $model . 'Form';
    }
}
