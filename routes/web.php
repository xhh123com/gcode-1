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

//登录
Route::get('/', 'Admin\LoginController@login');        //登录
Route::get('/admin/login', 'Admin\LoginController@login');        //登录
Route::post('/admin/login', 'Admin\LoginController@loginPost');   //post登录请求
Route::get('/admin/logout', 'Admin\LoginController@logout');  //注销

Route::get('captcha/code/{tmp}', 'CodeController@captcha');  //验证码


Route::group(['prefix' => 'admin', 'middleware' => ['BeforeRequest', 'CheckAdminLogin']], function () {

    //首页
    Route::get('/', 'Admin\IndexController@index');       //首页
    Route::get('/index', 'Admin\IndexController@index');  //首页

    Route::get('/authorization/index', 'Admin\AuthorizationController@index');      //授权信息

    //管理员管理
    Route::any('/admin/index', 'Admin\AdminController@index');  //管理员管理首页
    Route::get('/admin/setStatus/{id}', 'Admin\AdminController@setStatus');  //设置管理员状态
    Route::get('/admin/edit', 'Admin\AdminController@edit');  //新建或编辑管理员
    Route::post('/admin/edit', 'Admin\AdminController@editPost');  //新建或编辑管理员
    Route::get('/admin/editPassword', 'Admin\AdminController@editPassword');  //修改个人密码get
    Route::post('/admin/editPassword', 'Admin\AdminController@editPasswordPost');  //修改个人密码post
    Route::get('/admin/editMyself', 'Admin\AdminController@editMyself');  //修改个人信息get
    Route::post('/admin/editMyself', 'Admin\AdminController@editMyselfPost');  //修改个人信息post
    Route::get('/admin/resetPassword/{id}', 'Admin\AdminController@resetPassword');  //设置adminLogin的密码


});

