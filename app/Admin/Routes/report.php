<?php
$router->group(['prefix' => 'report'], function ($router) {
    $router->get('/product', 'ReportController@product')->name('admin_report.product');
});
