<?php
/**
 * Route front
 */
Route::group(
    [
        'prefix'    => 'extension/discount',
        'namespace' => 'App\Plugins\Extensions\Total\Discount\Controllers',
    ],
    function () {
        Route::post('/discount_process', 'DiscountController@useDiscount')
            ->name('discount.process');
        Route::post('/discount_remove', 'DiscountController@removeDiscount')
            ->name('discount.remove');
    }
);

/**
 * Route admin
 */
Route::group(
    [
        'prefix' => SC_ADMIN_PREFIX.'/shop_discount',
        'middleware' => SC_ADMIN_MIDDLEWARE,
        'namespace' => 'App\Plugins\Extensions\Total\Discount\Admin',
    ], 
    function () {
        Route::get('/', 'DiscountAdminController@index')
        ->name('admin_discount.index');
        Route::get('create', 'DiscountAdminController@create')
            ->name('admin_discount.create');
        Route::post('/create', 'DiscountAdminController@postCreate')
            ->name('admin_discount.create');
        Route::get('/edit/{id}', 'DiscountAdminController@edit')
            ->name('admin_discount.edit');
        Route::post('/edit/{id}', 'DiscountAdminController@postEdit')
            ->name('admin_discount.edit');
        Route::post('/delete', 'DiscountAdminController@deleteList')
            ->name('admin_discount.delete');
    }
);
