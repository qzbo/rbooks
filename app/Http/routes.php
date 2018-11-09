<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', function () {
    
    // echo phpinfo();die;


    return view('welcome');


});

//后台登录页
Route::get('admin/login','Admin\LoginController@login');
//后台登录处理页
Route::post('/admin/dologin','Admin\LoginController@dologin');
//后台验证码显示
Route::get('/code/captcha/{tmp}', 'Admin\LoginController@captcha');
// 'middleware'=>'login',
Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){


	// 后台用户管理
	Route::resource('/user','UserController');
	//检查用户名 邮箱是否存在
	Route::post('/checkuser','UserController@checkuser');
    // 管理员修改密码
    Route::get('/repass','UserController@repass');
    Route::post('/dorepass/{id}','UserController@dorepass');
    // 管理员退出登录
    Route::post('/loginout','LoginController@loginOut');
    // 管理员修改密码
    Route::get('/repass','UserController@repass');
    Route::post('/dorepass/{id}','UserController@dorepass');

//    角色路由 （管理员）
    Route::resource('/role','RoleController');
    Route::post('/role/check_role','RoleController@role_check');



    // 图书分类管理
    Route::resource('/bclassify','BclassifyController');
    // 图书列表
    Route::resource('/books','BooksController');
    //引入解析上传文件    
    Route::get('/parsing','ParsingController@index');
    // 修改VIP状态为是VIP
    Route::post('/books/vip/{id}','BooksController@vip');
    // 修改VIP状态为是VIP
    Route::post('/books/fvip/{id}','BooksController@fvip');
    // 修改推荐状态为推荐
    Route::post('/books/recommend/{id}','BooksController@recommend');
    // 修改推荐状态为不推荐
    Route::post('/books/frecommend/{id}','BooksController@frecommend');

    // 广告管理
    Route::resource('/adv','AdvController');
    // 修改广告状态为禁用
    Route::post('/adv/disable/{id}','AdvController@disable');
    // 修改广告状态为启用
    Route::post('/adv/Enable/{id}','AdvController@Enable');
    //视频广告页面调取
    Route::get('/advvid','AdvVideoController@advvidadd');
    //视频广告页面提交
    Route::post('/advvid/doadd','AdvVideoController@doadvvidadd');

    Route::get('/advvid/update/{id}','AdvVideoController@update');
    
    Route::post('/advvid/doupdate/{id}','AdvVideoController@doupdate');



});

//前台测试接口展示 
Route::get('home/index','Home\IndexController@index');

Route::any('/wechat', 'Wechat\WechatController@serve');


