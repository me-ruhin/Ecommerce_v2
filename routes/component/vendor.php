<?php
$prefixVendor = sc_config('PREFIX_VENDOR')??'vendor';

Route::group(['prefix' => $prefixVendor], function ($router) use($suffix) {
    $router->get('/', 'ShopFront@getVendors')->name('vendors');
    $router->get('/{alias}'.$suffix, 'ShopFront@productToVendor')
        ->name('vendor');
});