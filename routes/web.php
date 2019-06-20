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
use App\Models\Home\Users;

Route::get('/', function () {
    return view('home.index.index' );
});

// 前台首页
Route::get('home','home\IndexController@index');
/*************************李锦龙***********************************/

Route::get('admin/login','Admin\LoginController@login');
Route::get('admin/dologin','Admin\LoginController@dologin');
Route::group(['middleware'=>'login'],function(){
    // 后台首页
    Route::get('admin','Admin\IndexController@index');
    // 后台登录页面
    // 用户管理
    Route::resource('admin/users','Admin\UserController');
    // 软删除列表
    Route::get('admin/softdeletion','Admin\UserController@softdeletion');
    // 删除用户(软删除)
    Route::get('admin/user/del/{id}','Admin\UserController@del');
    // 恢复用户
    Route::get('admin/user/huifu/{id}','Admin\UserController@huifu');
    // 永久删除用户
    Route::get('admin/user/permanent/{id}','Admin\UserController@permanent');
});



// 前台
// 登录页面
Route::get('login','home\LoginController@index');
Route::get('dologin','home\LoginController@dologin');
Route::get('out','home\LoginController@out');


// 加载注册页面
Route::get('register','Home\LoginController@register');
// 接收手机号验证码
Route::get('sendPhome','Home\LoginController@sendPhome');
Route::post('store','Home\LoginController@store');

// 邮箱注册
Route::post('inert','Home\LoginController@inert');
Route::get('changeStatus/{id}/{token}','Home\LoginController@changeStatus');

// 个人中心
Route::get('center/index','Home\PersonalController@index');

// 个人信息修改
Route::get('center/information','Home\PersonalController@information');
Route::post('center/ImplementInformation','Home\PersonalController@ImplementInformation');

// 收货地址
Route::get('center/addres','Home\PersonalController@addres');
// 添加收货地址
Route::post('center/ImplementAddres','Home\PersonalController@ImplementAddres');
// 删除收货地址
Route::get('center/DeleteAddress/{id}','Home\PersonalController@DeleteAddress');
// 修改收货地址页面
Route::get('center/UpdateAddress/{id}','Home\PersonalController@UpdateAddress');
//执行修改地址
Route::post('center/ImplementUpdateAddress','Home\PersonalController@ImplementUpdateAddress');
Route::get('center/DefaultAddress/{id}','Home\PersonalController@DefaultAddress');

// 用户修改密码
Route::get('center/password','Home\PersonalController@password');
Route::get('center/ImplementPassword','Home\PersonalController@ImplementPassword');


Route::get('center/collection','Home\PersonalController@collection');

Route::get('center/comment','Home\PersonalController@comment');

Route::get('center/order','Home\PersonalController@order');





























/******************************************************************/



/*************************莫薛贵***********************************/


Route::resource('admin/goods','Admin\GoodsController');






































/******************************************************************/



/*************************谢肇韬***********************************/








































/******************************************************************/

/*************************梁伟杰***********************************/








































/******************************************************************/