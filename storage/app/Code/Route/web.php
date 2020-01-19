<?php


    //product
    Route::any('/product/index', 'Admin\ProductController@index');  //product首页
    Route::get('/product/edit', 'Admin\ProductController@edit');  //编辑product
    Route::post('/product/edit', 'Admin\ProductController@editPost');  //编辑product
    Route::get('/product/setStatus/{id}', 'Admin\ProductController@setStatus');  //设置product状态
    Route::post('/product/deleteById/{id}', 'Admin\ProductController@deleteById');  //删除product
    Route::get('/product/info', 'Admin\ProductController@info');  //详细信息product


