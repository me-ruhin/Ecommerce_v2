<?php
$router->group(['prefix' => 'vendor'], function ($router) {
    $router->get('/', 'ShopVendorController@index')->name('admin_vendor.index');
    $router->get('create', 'ShopVendorController@create')->name('admin_vendor.create');
    $router->post('/create', 'ShopVendorController@postCreate')->name('admin_vendor.create');
    $router->get('/edit/{id}', 'ShopVendorController@edit')->name('admin_vendor.edit');
    $router->post('/edit/{id}', 'ShopVendorController@postEdit')->name('admin_vendor.edit');
    $router->post('/delete', 'ShopVendorController@deleteList')->name('admin_vendor.delete');
});
