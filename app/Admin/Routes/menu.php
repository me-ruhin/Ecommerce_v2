<?php
$router->group(['prefix' => 'menu'], function ($router) {
    $router->get('/', 'MenuController@index')->name('admin_menu.index');
    $router->post('/create', 'MenuController@postCreate')->name('admin_menu.create');
    $router->get('/edit/{id}', 'MenuController@edit')->name('admin_menu.edit');
    $router->post('/edit/{id}', 'MenuController@postEdit')->name('admin_menu.edit');
    $router->post('/delete', 'MenuController@deleteList')->name('admin_menu.delete');
    $router->post('/update_sort', 'MenuController@updateSort')->name('admin_menu.update_sort');
});
