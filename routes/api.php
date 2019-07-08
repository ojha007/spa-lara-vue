<?php

use Illuminate\Http\Request;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1', 'namespace' => 'Api'], function ($router) {

    $router->get('/user', 'UserController@index');
    $router->post('/user', 'UserController@store');
    $router->delete('/user/{id}', 'UserController@delete');
    $router->get('/user/role', 'RoleController@index');

    $router->get('/product', 'ProductController@index');
    $router->get('/product/count', 'ProductController@productCount');
    $router->get('/product/{id}', 'ProductController@show');
    $router->get('/brands', 'ProductController@brands');
    $router->get('/meta_keys', 'ProductController@meta_keys');

    $router->delete('/blog/{slug}', 'BlogController@delete');
    $router->get('/blogs', 'BlogController@index');
    $router->get('/blog/count', 'BlogController@blogCount');

    $router->group(['prefix' => 'blog'], function ($blog) {
        $blog->post('/', 'BlogController@store');
    });


});

Route::group([
    'middleware' => 'jwt.auth',
    'prefix' => 'v1',
    'namespace' => 'Api'

], function ($router) {
    $router->post('/register', 'AuthenticationController@register');
    $router->post('/login', 'AuthenticationController@login');
    $router->post('/logout', 'AuthenticationController@logout');
});
