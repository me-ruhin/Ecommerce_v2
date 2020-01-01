<?php
Auth::routes();

//--Auth
Route::group(['namespace' => 'Auth', 'prefix' => 'member'], function ($router) {
    $router->get('/login.html', 'LoginController@showLoginForm')
        ->name('login');
    $router->post('/login.html', 'LoginController@login')
        ->name('postLogin');
    $router->get('/register.html', 'LoginController@showLoginForm')
        ->name('register');
    $router->post('/register.html', 'RegisterController@register')
        ->name('postRegister');
    $router->post('/logout', 'LoginController@logout')
        ->name('logout');
    $router->post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')
        ->name('password.email');
    $router->post('/password/reset', 'ResetPasswordController@reset');
    $router->get('/password/reset/{token}', 'ResetPasswordController@showResetForm')
        ->name('password.reset');
    $router->get('/forgot.html', 'ForgotPasswordController@showLinkRequestForm')
        ->name('forgot');
});
//End Auth