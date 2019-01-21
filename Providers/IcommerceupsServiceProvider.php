<?php

namespace Modules\Icommerceups\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Icommerceups\Events\Handlers\RegisterIcommerceupsSidebar;

class IcommerceupsServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
        $this->app['events']->listen(BuildingSidebar::class, RegisterIcommerceupsSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('icommerceups', array_dot(trans('icommerceups::icommerceups')));
            // append translations

        });
    }

    public function boot()
    {
        $this->publishConfig('icommerceups', 'permissions');
        $this->publishConfig('icommerceups', 'config');

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Icommerceups\Repositories\IcommerceupsRepository',
            function () {
                $repository = new \Modules\Icommerceups\Repositories\Eloquent\EloquentIcommerceupsRepository(new \Modules\Icommerceups\Entities\Icommerceups());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Icommerceups\Repositories\Cache\CacheIcommerceupsDecorator($repository);
            }
        );
// add bindings

    }
}
