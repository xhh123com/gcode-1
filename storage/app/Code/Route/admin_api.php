<?php


    //product
    Route::get('product/getById', 'Api\ProductController@getById');
    Route::get('product/getListByCon', 'Api\ProductController@getListByCon');
    Route::post('product/edit', 'Api\ProductController@edit');
    Route::post('product/deleteById', 'Api\ProductController@deleteById');


