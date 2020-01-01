<?php
$router->group(['prefix' => 'store_value'], function ($router) {
    $router->get('/', 'AdminStoreValueController@index')->name('admin_store_value.index');
    $router->get('create', 'AdminStoreValueController@create')->name('admin_store_value.create');
    $router->post('/create', 'AdminStoreValueController@postCreate')->name('admin_store_value.create');
    $router->post('/ ', 'AdminStoreValueController@deleteList')->name('admin_store_value.delete');
    $router->post('/update_info', 'AdminStoreValueController@updateInfo')->name('admin_store_value.update');
});
