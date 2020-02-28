<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');
    // === 用户管理权限 ==
    // 用户管理
    $router -> resource('users', UserController::class);
    // 用户动态
    $router -> get('users/statuses/{user_id}', 'UserController@statuses') -> name('user_statuses');
    // 用户关注
    $router -> get('users/focus/{user_id}', 'UserController@focus');
    // 用户粉碎
    $router -> get('users/fans/{user_id}', 'UserController@fans');
    // === 动态管理权限 ===
    $router -> resource('statuses', StatusController::class);
});
