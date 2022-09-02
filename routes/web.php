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
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Item controller
Route::resource('items', 'App\Http\Controllers\Warehouse\ItemController');

// Item Category controller
Route::resource('item-categories', 'App\Http\Controllers\Warehouse\ItemCategoryController');

// Item Search controller
Route::get('/item-search-view', 'App\Http\Controllers\Warehouse\ItemController@searchView')->name('item-search-view');
Route::get('/item-search', 'App\Http\Controllers\Warehouse\ItemController@search')->name('item-search');

