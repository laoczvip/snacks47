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
//显示分类控制器
Route::resource('admin/cates','Admin\CatesController');
//插入类
Route::post('admin/cates/insert','Admin\CatesController@insert');
//删除类
Route::get('admin/cates/delete/{id}','Admin\CatesController@delete');



































/******************************************************************/



/*************************谢肇韬***********************************/








































/******************************************************************/

/*************************梁伟杰***********************************/








































/******************************************************************/