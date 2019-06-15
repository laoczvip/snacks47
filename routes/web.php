<?php

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
    return view('welcome');
});

Route::get('admin','Admin\IndexController@index');
Route::get('admin/index','Admin\UserController@index');
Route::get('admin/create','Admin\UserController@create');
Route::post('admin/store','Admin\UserController@store');


/*路由分配*/
/*路由分配*/
/*路由分配*/
/*路由分配*/
/*路由分配*/
/*路由分配*/
/*路由分配*/
/*路由分配*/
/*路由分配*/
/*路由分配*/
/*路由分配*/
/*路由分配*/
/*路由分配*/
/*路由分配*/
/*路由分配*/
/*路由分配*/
/*路由分配*/


