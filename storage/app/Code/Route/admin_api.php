<?php


    //ad
    Route::get('ad/getById', 'Api\AdController@getById');
    Route::get('ad/getListByCon', 'Api\AdController@getListByCon');
    Route::post('ad/edit', 'Api\AdController@edit');
    Route::post('ad/deleteById', 'Api\AdController@deleteById');


    //admin
    Route::get('admin/getById', 'Api\AdminController@getById');
    Route::get('admin/getListByCon', 'Api\AdminController@getListByCon');
    Route::post('admin/edit', 'Api\AdminController@edit');
    Route::post('admin/deleteById', 'Api\AdminController@deleteById');


    //adminLogin
    Route::get('adminLogin/getById', 'Api\AdminLoginController@getById');
    Route::get('adminLogin/getListByCon', 'Api\AdminLoginController@getListByCon');
    Route::post('adminLogin/edit', 'Api\AdminLoginController@edit');
    Route::post('adminLogin/deleteById', 'Api\AdminLoginController@deleteById');


    //bank
    Route::get('bank/getById', 'Api\BankController@getById');
    Route::get('bank/getListByCon', 'Api\BankController@getListByCon');
    Route::post('bank/edit', 'Api\BankController@edit');
    Route::post('bank/deleteById', 'Api\BankController@deleteById');


    //city
    Route::get('city/getById', 'Api\CityController@getById');
    Route::get('city/getListByCon', 'Api\CityController@getListByCon');
    Route::post('city/edit', 'Api\CityController@edit');
    Route::post('city/deleteById', 'Api\CityController@deleteById');


    //collect
    Route::get('collect/getById', 'Api\CollectController@getById');
    Route::get('collect/getListByCon', 'Api\CollectController@getListByCon');
    Route::post('collect/edit', 'Api\CollectController@edit');
    Route::post('collect/deleteById', 'Api\CollectController@deleteById');


    //comment
    Route::get('comment/getById', 'Api\CommentController@getById');
    Route::get('comment/getListByCon', 'Api\CommentController@getListByCon');
    Route::post('comment/edit', 'Api\CommentController@edit');
    Route::post('comment/deleteById', 'Api\CommentController@deleteById');


    //company
    Route::get('company/getById', 'Api\CompanyController@getById');
    Route::get('company/getListByCon', 'Api\CompanyController@getListByCon');
    Route::post('company/edit', 'Api\CompanyController@edit');
    Route::post('company/deleteById', 'Api\CompanyController@deleteById');


    //coupon
    Route::get('coupon/getById', 'Api\CouponController@getById');
    Route::get('coupon/getListByCon', 'Api\CouponController@getListByCon');
    Route::post('coupon/edit', 'Api\CouponController@edit');
    Route::post('coupon/deleteById', 'Api\CouponController@deleteById');


    //dailyCheckOrder
    Route::get('dailyCheckOrder/getById', 'Api\DailyCheckOrderController@getById');
    Route::get('dailyCheckOrder/getListByCon', 'Api\DailyCheckOrderController@getListByCon');
    Route::post('dailyCheckOrder/edit', 'Api\DailyCheckOrderController@edit');
    Route::post('dailyCheckOrder/deleteById', 'Api\DailyCheckOrderController@deleteById');


    //order
    Route::get('order/getById', 'Api\OrderController@getById');
    Route::get('order/getListByCon', 'Api\OrderController@getListByCon');
    Route::post('order/edit', 'Api\OrderController@edit');
    Route::post('order/deleteById', 'Api\OrderController@deleteById');


    //product
    Route::get('product/getById', 'Api\ProductController@getById');
    Route::get('product/getListByCon', 'Api\ProductController@getListByCon');
    Route::post('product/edit', 'Api\ProductController@edit');
    Route::post('product/deleteById', 'Api\ProductController@deleteById');


    //productLevel1Type
    Route::get('productLevel1Type/getById', 'Api\ProductLevel1TypeController@getById');
    Route::get('productLevel1Type/getListByCon', 'Api\ProductLevel1TypeController@getListByCon');
    Route::post('productLevel1Type/edit', 'Api\ProductLevel1TypeController@edit');
    Route::post('productLevel1Type/deleteById', 'Api\ProductLevel1TypeController@deleteById');


    //productLevel2Type
    Route::get('productLevel2Type/getById', 'Api\ProductLevel2TypeController@getById');
    Route::get('productLevel2Type/getListByCon', 'Api\ProductLevel2TypeController@getListByCon');
    Route::post('productLevel2Type/edit', 'Api\ProductLevel2TypeController@edit');
    Route::post('productLevel2Type/deleteById', 'Api\ProductLevel2TypeController@deleteById');


    //ruleTw
    Route::get('ruleTw/getById', 'Api\RuleTwController@getById');
    Route::get('ruleTw/getListByCon', 'Api\RuleTwController@getListByCon');
    Route::post('ruleTw/edit', 'Api\RuleTwController@edit');
    Route::post('ruleTw/deleteById', 'Api\RuleTwController@deleteById');


    //scoreRecord
    Route::get('scoreRecord/getById', 'Api\ScoreRecordController@getById');
    Route::get('scoreRecord/getListByCon', 'Api\ScoreRecordController@getListByCon');
    Route::post('scoreRecord/edit', 'Api\ScoreRecordController@edit');
    Route::post('scoreRecord/deleteById', 'Api\ScoreRecordController@deleteById');


    //scoreRule
    Route::get('scoreRule/getById', 'Api\ScoreRuleController@getById');
    Route::get('scoreRule/getListByCon', 'Api\ScoreRuleController@getListByCon');
    Route::post('scoreRule/edit', 'Api\ScoreRuleController@edit');
    Route::post('scoreRule/deleteById', 'Api\ScoreRuleController@deleteById');


    //shopClerk
    Route::get('shopClerk/getById', 'Api\ShopClerkController@getById');
    Route::get('shopClerk/getListByCon', 'Api\ShopClerkController@getListByCon');
    Route::post('shopClerk/edit', 'Api\ShopClerkController@edit');
    Route::post('shopClerk/deleteById', 'Api\ShopClerkController@deleteById');


    //shopClerkLogin
    Route::get('shopClerkLogin/getById', 'Api\ShopClerkLoginController@getById');
    Route::get('shopClerkLogin/getListByCon', 'Api\ShopClerkLoginController@getListByCon');
    Route::post('shopClerkLogin/edit', 'Api\ShopClerkLoginController@edit');
    Route::post('shopClerkLogin/deleteById', 'Api\ShopClerkLoginController@deleteById');


    //shopContract
    Route::get('shopContract/getById', 'Api\ShopContractController@getById');
    Route::get('shopContract/getListByCon', 'Api\ShopContractController@getListByCon');
    Route::post('shopContract/edit', 'Api\ShopContractController@edit');
    Route::post('shopContract/deleteById', 'Api\ShopContractController@deleteById');


    //shop
    Route::get('shop/getById', 'Api\ShopController@getById');
    Route::get('shop/getListByCon', 'Api\ShopController@getListByCon');
    Route::post('shop/edit', 'Api\ShopController@edit');
    Route::post('shop/deleteById', 'Api\ShopController@deleteById');


    //shopSettlement
    Route::get('shopSettlement/getById', 'Api\ShopSettlementController@getById');
    Route::get('shopSettlement/getListByCon', 'Api\ShopSettlementController@getListByCon');
    Route::post('shopSettlement/edit', 'Api\ShopSettlementController@edit');
    Route::post('shopSettlement/deleteById', 'Api\ShopSettlementController@deleteById');


    //shopStore
    Route::get('shopStore/getById', 'Api\ShopStoreController@getById');
    Route::get('shopStore/getListByCon', 'Api\ShopStoreController@getListByCon');
    Route::post('shopStore/edit', 'Api\ShopStoreController@edit');
    Route::post('shopStore/deleteById', 'Api\ShopStoreController@deleteById');


    //subProduct
    Route::get('subProduct/getById', 'Api\SubProductController@getById');
    Route::get('subProduct/getListByCon', 'Api\SubProductController@getListByCon');
    Route::post('subProduct/edit', 'Api\SubProductController@edit');
    Route::post('subProduct/deleteById', 'Api\SubProductController@deleteById');


    //userCoupon
    Route::get('userCoupon/getById', 'Api\UserCouponController@getById');
    Route::get('userCoupon/getListByCon', 'Api\UserCouponController@getListByCon');
    Route::post('userCoupon/edit', 'Api\UserCouponController@edit');
    Route::post('userCoupon/deleteById', 'Api\UserCouponController@deleteById');


    //user
    Route::get('user/getById', 'Api\UserController@getById');
    Route::get('user/getListByCon', 'Api\UserController@getListByCon');
    Route::post('user/edit', 'Api\UserController@edit');
    Route::post('user/deleteById', 'Api\UserController@deleteById');


    //userLogin
    Route::get('userLogin/getById', 'Api\UserLoginController@getById');
    Route::get('userLogin/getListByCon', 'Api\UserLoginController@getListByCon');
    Route::post('userLogin/edit', 'Api\UserLoginController@edit');
    Route::post('userLogin/deleteById', 'Api\UserLoginController@deleteById');


    //userShopClerkApply
    Route::get('userShopClerkApply/getById', 'Api\UserShopClerkApplyController@getById');
    Route::get('userShopClerkApply/getListByCon', 'Api\UserShopClerkApplyController@getListByCon');
    Route::post('userShopClerkApply/edit', 'Api\UserShopClerkApplyController@edit');
    Route::post('userShopClerkApply/deleteById', 'Api\UserShopClerkApplyController@deleteById');


    //vericode
    Route::get('vericode/getById', 'Api\VericodeController@getById');
    Route::get('vericode/getListByCon', 'Api\VericodeController@getListByCon');
    Route::post('vericode/edit', 'Api\VericodeController@edit');
    Route::post('vericode/deleteById', 'Api\VericodeController@deleteById');


    //vericodeVerifyRecord
    Route::get('vericodeVerifyRecord/getById', 'Api\VericodeVerifyRecordController@getById');
    Route::get('vericodeVerifyRecord/getListByCon', 'Api\VericodeVerifyRecordController@getListByCon');
    Route::post('vericodeVerifyRecord/edit', 'Api\VericodeVerifyRecordController@edit');
    Route::post('vericodeVerifyRecord/deleteById', 'Api\VericodeVerifyRecordController@deleteById');


    //vertify
    Route::get('vertify/getById', 'Api\VertifyController@getById');
    Route::get('vertify/getListByCon', 'Api\VertifyController@getListByCon');
    Route::post('vertify/edit', 'Api\VertifyController@edit');
    Route::post('vertify/deleteById', 'Api\VertifyController@deleteById');


    //xcxFormId
    Route::get('xcxFormId/getById', 'Api\XcxFormIdController@getById');
    Route::get('xcxFormId/getListByCon', 'Api\XcxFormIdController@getListByCon');
    Route::post('xcxFormId/edit', 'Api\XcxFormIdController@edit');
    Route::post('xcxFormId/deleteById', 'Api\XcxFormIdController@deleteById');


    //zan
    Route::get('zan/getById', 'Api\ZanController@getById');
    Route::get('zan/getListByCon', 'Api\ZanController@getListByCon');
    Route::post('zan/edit', 'Api\ZanController@edit');
    Route::post('zan/deleteById', 'Api\ZanController@deleteById');


