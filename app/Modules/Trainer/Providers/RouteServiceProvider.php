<?php namespace App\Modules\Trainer\Providers;

use Illuminate\Routing\Router;
use App\Modules\Trainer\Models\Trainer;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{

    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Modules\Trainer\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function boot(Router $router)
    {
        parent::boot($router);

        $router->model('Trainer', 'App\Modules\Trainer\Models\Trainer');
        $router->bind('Trainer_slug', function ($slug) {
            return Trainer::findBySlugOrFail($slug);
        });
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function ($router) {
            require app_path('Modules/Trainer/routes.php');
        });
    }
}
