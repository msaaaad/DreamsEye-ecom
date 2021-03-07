<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|

Route::get('/product',[
	'uses'		=>'Admin\ProductController@index',
	'as'		=>'product'
]);

Route::get('/category',[
	'uses'		=>'Admin\CategoryController@index',
	'as'		=>'category'
]);

Route::get('/brand',[
	'uses'		=>'Admin\BrandController@index',
	'as'		=>'brand'
]);

*/

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/{anypath}',[
	'uses'		=>'HomeController@index',
	'as'		=>'{anypath}'
])->where('path','.*');