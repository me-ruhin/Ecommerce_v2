<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(
    [
        'middleware' => 'api',
        'namespace'  => '\App\Modules\Api',
    ],
    function ($router) {
        $router->get('/product', 'Product@index')->name('api.product');
        $router->get('/order', 'Order@index')->name('api.order');
    });
