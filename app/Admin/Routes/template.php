<?php
$router->group(['prefix' => 'template'], function ($router) {
    $router->get('/', 'ShopTemplateController@index')->name('admin_template.index');
    $router->post('changeTemplate', 'ShopTemplateController@changeTemplate')->name('admin_template.changeTemplate');
});
