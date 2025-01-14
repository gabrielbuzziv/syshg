<?php

namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function boot(Router $router)
    {
        parent::boot($router);

        $router->bind('users', function ($id) {
            return \App\User::findOrFail($id);
        });

        $router->bind('roles', function ($id) {
            return \App\Role::findOrFail($id);
        });

        $router->bind('permissions', function ($id) {
            return \App\Permission::findOrFail($id);
        });

        $router->bind('empresas', function ($id) {
            return \App\Empresa::findOrFail($id);
        });

        $router->bind('orcamentos', function ($id) {
            return \App\Orcamento::findOrFail($id);
        });

        $router->bind('ordens-compra', function ($id) {
            return \App\OrdemCompra::findOrFail($id);
        });

        $router->bind('listas-de-contatos', function ($id) {
            return \App\Lista::findOrFail($id);
        });

        $router->bind('contatos', function ($id) {
            return \App\Contato::findOrFail($id);
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
        $this->mapWebRoutes($router);

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    protected function mapWebRoutes(Router $router)
    {
        $router->group([
            'namespace' => $this->namespace, 'middleware' => 'web',
        ], function ($router) {
            require app_path('Http/routes.php');
        });
    }
}
