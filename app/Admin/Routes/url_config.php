<?php
$router->group(['prefix' => 'url_config'], function ($router) {
    $router->get('/', 'AdminUrlConfigController@index')->name('admin_url_config.index');
    $router->get('create', 'AdminUrlConfigController@create')->name('admin_url_config.create');
    $router->post('/create', 'AdminUrlConfigController@postCreate')->name('admin_url_config.create');
    $router->post('/ ', 'AdminUrlConfigController@deleteList')->name('admin_url_config.delete');
    $router->post('/update_info', 'AdminUrlConfigController@updateInfo')->name('admin_url_config.update');
});
