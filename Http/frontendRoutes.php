<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/ups'], function (Router $router) {

    $router->get('/rates/{countryCode}/{zip}', [
        'as' => 'ups.rates',
        'uses' => 'PublicController@rates'
    ]);

});