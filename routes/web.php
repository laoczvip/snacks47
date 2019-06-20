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

// 后台首页
Route::get('admin','Admin\IndexController@index');
/*************************李锦龙***********************************/


// 用户管理
Route::resource('admin/users','Admin\UserController');

// 软删除
Route::get('admin/softdeletion','Admin\UserController@softdeletion');
































/******************************************************************/



/*************************莫薛贵***********************************/


Route::resource('admin/goods','Admin\GoodsController');






































/******************************************************************/



/*************************谢肇韬***********************************/








































/******************************************************************/

/*************************梁伟杰***********************************/
// 轮播图修改状态 
Route::get('admin/banners/changeStatus','Admin\BannersController@changeStatus');
// 轮播图删除
Route::get('admin/banners/delete','Admin\BannersController@delete');
// 轮播图软删除
Route::get('admin/banners/soft','Admin\BannersController@soft');
// 轮播图软删除
Route::get('admin/banners/huifu/{id}','Admin\BannersController@huifu');
// 轮播图永久删除
Route::get('admin/banners/delete_data/{id}','Admin\BannersController@delete_data');
// 轮播图管理
Route::resource('admin/banners','Admin\BannersController');

// 头条删除
Route::get('admin/headlines/delete','Admin\HeadlinesController@delete');
// 头条软删除
Route::get('admin/headlines/soft','Admin\HeadlinesController@soft');
// 头条软删除
Route::get('admin/headlines/huifu/{id}','Admin\HeadlinesController@huifu');
// 头条永久删除
Route::get('admin/headlines/delete_data/{id}','Admin\HeadlinesController@delete_data');
// 头条管理
Route::resource('admin/headlines','Admin\HeadlinesController');








































/******************************************************************/