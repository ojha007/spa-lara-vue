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
    $router->put('/user/{id}', 'UserController@update');

    $router->get('/product', 'ProductController@index');
    $router->get('/product/count', 'ProductController@productCount');
    $router->get('/product/{id}', 'ProductController@show');
    $router->delete('/product/{id}', 'ProductController@delete');

    $router->get('/brands', 'ProductController@brands');
    $router->get('/meta_keys', 'ProductController@meta_keys');

    $router->delete('/blog/{slug}', 'BlogController@delete');
    $router->get('/blogs', 'BlogController@index');
    $router->get('/blog/count', 'BlogController@blogCount');
    $router->put('/blog/{id}', 'BlogController@update');

    $router->group(['prefix' => 'blog'], function ($blog) {
        $blog->post('/', 'BlogController@store');
    });


});

