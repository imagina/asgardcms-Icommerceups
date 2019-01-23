<?php

use Illuminate\Routing\Router;

$router->group(['prefix' => 'icommerceups'], function (Router $router) {
    
    $router->get('/', [
        'as' => 'icommerceups.api.ups.init',
        'uses' => 'IcommerceUpsApiController@init',
    ]);

   

});