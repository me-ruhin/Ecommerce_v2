<?php

Route::group(
    [
        'prefix'    => 'extension/payment',
        'namespace' => 'App\Plugins\Extensions\Payment\Paypal\Controllers',
    ], function () {
        Route::get('paypal', 'PaypalController@index')
            ->name('paypal.index');
        Route::get('return/{order_id}', 'PaypalController@getReturn')
            ->name('paypal.return');
    });
