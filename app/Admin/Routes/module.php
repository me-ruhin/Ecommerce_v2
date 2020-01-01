<?php
$router->group(['prefix' => 'module'], function ($router) {
    $router->get('/{moduleGroup}', 'ModulesController@index')->name('admin_module');
    $router->post('/install', 'ModulesController@install')->name('admin_module.install');
    $router->post('/uninstall', 'ModulesController@uninstall')->name('admin_module.uninstall');
    $router->post('/enable', 'ModulesController@enable')->name('admin_module.enable');
    $router->post('/disable', 'ModulesController@disable')->name('admin_module.disable');
    $router->match(['put', 'post'], '/process/{moduleGroup}/{module}', 'ModulesController@process')->name('admin_module.process');
});
