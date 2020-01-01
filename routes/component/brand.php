<?php
$prefixBrand = sc_config('PREFIX_BRAND')??'brand';

Route::group(['prefix' => $prefixBrand], function ($router) use($suffix) {
    $router->get('/', 'ShopFront@getBrands')->name('brands');
    $router->get('/{alias}'.$suffix, 'ShopFront@productToBrand')
        ->name('brand');
});