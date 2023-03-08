<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Lang;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'Catalog'], function() {
	Route::group(['prefix' => __('routes.catalog_product')], function() {
		Route::get('/{slug}', 'ProductController@detail')->name('catalog.product.item');
	});
	Route::group(['prefix' => __('routes.catalog_product_cost')], function() {
		Route::get('/' . __('routes.variant'), 'ProductController@variant')->name('catalog.product.variant');
		Route::get('/' . __('routes.option'), 'ProductController@option')->name('catalog.product.option');
		Route::get('/' . __('routes.grouped'), 'ProductController@grouped')->name('catalog.product.grouped');
	});
});
