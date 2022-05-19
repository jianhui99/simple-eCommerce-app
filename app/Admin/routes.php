<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->get('sync-wp-products', 'WpProductController@sync_wp_products');

    $router->resources([
        'wp-products'   =>  WpProductController::class,
        'wp-product-images'   =>  WpProductImageController::class,
        'order'   =>  OrderController::class,
    ]);

});
