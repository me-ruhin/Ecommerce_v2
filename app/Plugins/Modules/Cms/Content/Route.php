<?php
/**
 * Route front
 */

$suffix = sc_config('SUFFIX_URL')??'';
$prefixCmsCategory = sc_config('PREFIX_CMS_CATEGORY')??'cms';
$prefixCmsEntry = sc_config('PREFIX_CMS_ENTRY')??'entry';

Route::group(
    [
        'namespace' => 'App\Plugins\Modules\Cms\Content\Controllers',
    ], function () use($suffix, $prefixCmsCategory, $prefixCmsEntry) {
        Route::get('/'.$prefixCmsCategory.'/{alias}', 'ContentController@category')
            ->name('cms.category');
        Route::get('/'.$prefixCmsEntry.'/{alias}'.$suffix, 'ContentController@content')
            ->name('cms.content');
    });

/**
 * Route admin
 */
Route::group(
    [
        'prefix' => SC_ADMIN_PREFIX,
        'middleware' => SC_ADMIN_MIDDLEWARE,
        'namespace' => 'App\Plugins\Modules\Cms\Content\Admin',
    ], 
    function () {
        Route::group(['prefix' => 'cms_category'], function () {
            Route::get('/', 'CmsCategoryController@index')
                ->name('admin_cms_category.index');
            Route::get('create', 'CmsCategoryController@create')
                ->name('admin_cms_category.create');
            Route::post('/create', 'CmsCategoryController@postCreate')
                ->name('admin_cms_category.create');
            Route::get('/edit/{id}', 'CmsCategoryController@edit')
                ->name('admin_cms_category.edit');
            Route::post('/edit/{id}', 'CmsCategoryController@postEdit')
                ->name('admin_cms_category.edit');
            Route::post('/delete', 'CmsCategoryController@deleteList')
                ->name('admin_cms_category.delete');
        });

        Route::group(['prefix' => 'cms_content'], function () {
            Route::get('/', 'CmsContentController@index')
                ->name('admin_cms_content.index');
            Route::get('create', 'CmsContentController@create')
                ->name('admin_cms_content.create');
            Route::post('/create', 'CmsContentController@postCreate')
                ->name('admin_cms_content.create');
            Route::get('/edit/{id}', 'CmsContentController@edit')
                ->name('admin_cms_content.edit');
            Route::post('/edit/{id}', 'CmsContentController@postEdit')
                ->name('admin_cms_content.edit');
            Route::post('/delete', 'CmsContentController@deleteList')
                ->name('admin_cms_content.delete');
        });

    }
);

