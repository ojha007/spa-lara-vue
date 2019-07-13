<?php
Route::group(['prefix'=>'/','namespace'=>'Api'],function ($router){
    $router->get('login','AuthenticationController@showLoginForm')->name('showLoginForm');
    $router->post('logout','AuthenticationController@logout')->name('logout');
    $router->get('register','AuthenticationController@showRegisterForm')->name('showRegisterForm');
    $router->post('register','AuthenticationController@register')->name('register');
    $router->post('login','AuthenticationController@login')->name('login');
});

Route::get('{any}', function () {
    return view('welcome');
})->where('any', '[\/\w\.-]*');




