<?php
$router->group(['prefix' => 'env'], function ($router) {
    $router->get('/', 'AdminEnvController@index')->name('admin_env.index');
    $router->post('/delete', 'AdminEnvController@deleteList')->name('admin_env.delete');
    $router->post('/update_info', 'AdminEnvController@updateInfo')->name('admin_env.update');
});
