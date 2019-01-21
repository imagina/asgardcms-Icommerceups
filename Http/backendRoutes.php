<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/icommerceups'], function (Router $router) {
    $router->bind('configups', function ($id) {
        return app('Modules\IcommerceUps\Repositories\ConfigupsRepository')->find($id);
    });
    $router->get('configups', [
        'as' => 'admin.icommerceups.configups.index',
        'uses' => 'ConfigupsController@index',
        'middleware' => 'can:icommerceups.configups.index'
    ]);
    $router->get('configups/create', [
        'as' => 'admin.icommerceups.configups.create',
        'uses' => 'ConfigupsController@create',
        'middleware' => 'can:icommerceups.configups.create'
    ]);
    $router->post('configups', [
        'as' => 'admin.icommerceups.configups.store',
        'uses' => 'ConfigupsController@store',
        'middleware' => 'can:icommerceups.configups.create'
    ]);
    $router->get('configups/{configups}/edit', [
        'as' => 'admin.icommerceups.configups.edit',
        'uses' => 'ConfigupsController@edit',
        'middleware' => 'can:icommerceups.configups.edit'
    ]);
    $router->put('configups', [
        'as' => 'admin.icommerceups.configups.update',
        'uses' => 'ConfigupsController@update',
        'middleware' => 'can:icommerceups.configups.edit'
    ]);
    $router->delete('configups/{configups}', [
        'as' => 'admin.icommerceups.configups.destroy',
        'uses' => 'ConfigupsController@destroy',
        'middleware' => 'can:icommerceups.configups.destroy'
    ]);
// append

});
