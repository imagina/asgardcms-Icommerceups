<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/icommerceups'], function (Router $router) {
    $router->bind('icommerceups', function ($id) {
        return app('Modules\Icommerceups\Repositories\IcommerceupsRepository')->find($id);
    });
    $router->get('icommerceups', [
        'as' => 'admin.icommerceups.icommerceups.index',
        'uses' => 'IcommerceupsController@index',
        'middleware' => 'can:icommerceups.icommerceups.index'
    ]);
    $router->get('icommerceups/create', [
        'as' => 'admin.icommerceups.icommerceups.create',
        'uses' => 'IcommerceupsController@create',
        'middleware' => 'can:icommerceups.icommerceups.create'
    ]);
    $router->post('icommerceups', [
        'as' => 'admin.icommerceups.icommerceups.store',
        'uses' => 'IcommerceupsController@store',
        'middleware' => 'can:icommerceups.icommerceups.create'
    ]);
    $router->get('icommerceups/{icommerceups}/edit', [
        'as' => 'admin.icommerceups.icommerceups.edit',
        'uses' => 'IcommerceupsController@edit',
        'middleware' => 'can:icommerceups.icommerceups.edit'
    ]);
    $router->put('icommerceups/{icommerceups}', [
        'as' => 'admin.icommerceups.icommerceups.update',
        'uses' => 'IcommerceupsController@update',
        'middleware' => 'can:icommerceups.icommerceups.edit'
    ]);
    $router->delete('icommerceups/{icommerceups}', [
        'as' => 'admin.icommerceups.icommerceups.destroy',
        'uses' => 'IcommerceupsController@destroy',
        'middleware' => 'can:icommerceups.icommerceups.destroy'
    ]);
// append

});
