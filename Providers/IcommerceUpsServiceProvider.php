<?php

namespace Modules\IcommerceUps\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\IcommerceUps\Events\Handlers\RegisterIcommerceUpsSidebar;

class IcommerceUpsServiceProvider extends ServiceProvider
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
        $this->app['events']->listen(BuildingSidebar::class, RegisterIcommerceUpsSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('configups', array_dot(trans('icommerceups::configups')));
            // append translations

        });
    }

    public function boot()
    {
        $this->publishConfig('IcommerceUps', 'permissions');
        $this->publishConfig('IcommerceUps', 'config');
        $this->publishConfig('IcommerceUps', 'settings');
        //$this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
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
            'Modules\IcommerceUps\Repositories\ConfigupsRepository',
            function () {
                $repository = new \Modules\IcommerceUps\Repositories\Eloquent\EloquentConfigupsRepository(new \Modules\IcommerceUps\Entities\Configups());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\IcommerceUps\Repositories\Cache\CacheConfigupsDecorator($repository);
            }
        );
// add bindings

    }
}
