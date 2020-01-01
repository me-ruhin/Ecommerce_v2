<?php
$router->group(['prefix' => 'extension'], function ($router) {
    $router->get('/{extensionGroup}', 'ExtensionsController@index')
        ->name('admin_extension');
    $router->post('/install', 'ExtensionsController@install')
        ->name('admin_extension.install');
    $router->post('/uninstall', 'ExtensionsController@uninstall')
        ->name('admin_extension.uninstall');
    $router->post('/enable', 'ExtensionsController@enable')
        ->name('admin_extension.enable');
    $router->post('/disable', 'ExtensionsController@disable')
        ->name('admin_extension.disable');
    $router->match(['put', 'post'], '/process/{group}/{key}', 'ExtensionsController@process')
        ->name('admin_extension.process');
});
