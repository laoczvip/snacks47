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
use App\Models\Weds;

Route::get('/', function () {
    $weds = weds::find(1);
    return view('home.index.index',['weds'=>$weds]);

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

    // 网站配置
    Route::get('admin/configure/index','Admin\ConfigureController@index');
    // 网站状态(关闭)
    Route::get('admin/configure/off','Admin\ConfigureController@off');
    // 网站状态(开启)
    Route::get('admin/configure/kaiqi','Admin\ConfigureController@kaiqi');
    // 修改网站信息(加载页面)
    Route::get('admin/configure/edit','Admin\ConfigureController@edit');
    // 修改网站信息(执行修改)
    Route::post('admin/configure/update','Admin\ConfigureController@update');

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
// 下单页面
Route::get('payment/{id}','Home\PurchaseController@index');
// 执行购买
Route::get('add','Home\PurchaseController@ExecutePurchase');
Route::get('jia','Home\PurchaseController@jia');




























/******************************************************************/



/*************************莫薛贵***********************************/




//活动
Route::get('admin/exercise/create','Admin\ExeciseController@create');
//删除商品
Route::get('admin/goods/del','Admin\GoodsController@del');
//修改商品
Route::get('admin/goods/edit','Admin\GoodsController@edit');
Route::post('admin/goods/update','Admin\GoodsController@update');
Route::get('admin/goods/index','Admin\GoodsController@index');
//商品属性
Route::get('admin/flavour/index','Admin\FlavourController@index');
Route::get('admin/flavour/create','Admin\FlavourController@create');
Route::post('admin/flavour/store','Admin\FlavourController@store');
Route::get('admin/flavour/destroy','Admin\FlavourController@destroy');
Route::get('admin/flavour/edit','Admin\FlavourController@edit');
Route::post('admin/flavour/update','Admin\FlavourController@update');
//商品模型控制器
Route::resource('admin/goods','Admin\GoodsController');
//删除类
Route::get('admin/cates/delete','Admin\CatesController@delete');
Route::get('admin/cates/index','Admin\CatesController@index');
Route::get('admin/cates/edit','Admin\CatesController@edit');
Route::post('admin/cates/update','Admin\CatesController@update');
Route::get('admin/cates/store','Admin\CatesController@store');
//显示分类模型控制器

// 显示商品控制器
Route::resource('admin/goods','Admin\GoodsController');
// 显示分类控制器

Route::resource('admin/cates','Admin\CatesController');
// 插入类
Route::post('admin/cates/insert','Admin\CatesController@insert');




//前台单件商品操作
Route::get('home/personal/introduction','Home\PersonalController@IntroDuction');




// 删除类
Route::get('admin/cates/delete/{id}','Admin\CatesController@delete');




































/******************************************************************/



/*************************谢肇韬***********************************/
Route::group(['prefix'=>'admin'],function(){

    // 后台 友情链接 删除
    Route::get('friendly/destroy','Admin\FriendlyController@destroy');

    // 后台 友情链接 快速激活 状态
    Route::get('friendly/ChangeStatus','Admin\FriendlyController@ChangeStatus');

});

// 后台 友情链接
Route::resource('admin/friendly','Admin\FriendlyController');










































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