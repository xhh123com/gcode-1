<?php


    //ad
    Route::get('ad/getById', 'Api\AdController@getById');
    Route::get('ad/getListByCon', 'Api\AdController@getListByCon');

    //admin
    Route::get('admin/getById', 'Api\AdminController@getById');
    Route::get('admin/getListByCon', 'Api\AdminController@getListByCon');

    //adminLogin
    Route::get('adminLogin/getById', 'Api\AdminLoginController@getById');
    Route::get('adminLogin/getListByCon', 'Api\AdminLoginController@getListByCon');

    //bank
    Route::get('bank/getById', 'Api\BankController@getById');
    Route::get('bank/getListByCon', 'Api\BankController@getListByCon');

    //city
    Route::get('city/getById', 'Api\CityController@getById');
    Route::get('city/getListByCon', 'Api\CityController@getListByCon');

    //collect
    Route::get('collect/getById', 'Api\CollectController@getById');
    Route::get('collect/getListByCon', 'Api\CollectController@getListByCon');

    //comment
    Route::get('comment/getById', 'Api\CommentController@getById');
    Route::get('comment/getListByCon', 'Api\CommentController@getListByCon');

    //company
    Route::get('company/getById', 'Api\CompanyController@getById');
    Route::get('company/getListByCon', 'Api\CompanyController@getListByCon');

    //coupon
    Route::get('coupon/getById', 'Api\CouponController@getById');
    Route::get('coupon/getListByCon', 'Api\CouponController@getListByCon');

    //dailyCheckOrder
    Route::get('dailyCheckOrder/getById', 'Api\DailyCheckOrderController@getById');
    Route::get('dailyCheckOrder/getListByCon', 'Api\DailyCheckOrderController@getListByCon');

    //order
    Route::get('order/getById', 'Api\OrderController@getById');
    Route::get('order/getListByCon', 'Api\OrderController@getListByCon');

    //product
    Route::get('product/getById', 'Api\ProductController@getById');
    Route::get('product/getListByCon', 'Api\ProductController@getListByCon');

    //productLevel1Type
    Route::get('productLevel1Type/getById', 'Api\ProductLevel1TypeController@getById');
    Route::get('productLevel1Type/getListByCon', 'Api\ProductLevel1TypeController@getListByCon');

    //productLevel2Type
    Route::get('productLevel2Type/getById', 'Api\ProductLevel2TypeController@getById');
    Route::get('productLevel2Type/getListByCon', 'Api\ProductLevel2TypeController@getListByCon');

    //ruleTw
    Route::get('ruleTw/getById', 'Api\RuleTwController@getById');
    Route::get('ruleTw/getListByCon', 'Api\RuleTwController@getListByCon');

    //scoreRecord
    Route::get('scoreRecord/getById', 'Api\ScoreRecordController@getById');
    Route::get('scoreRecord/getListByCon', 'Api\ScoreRecordController@getListByCon');

    //scoreRule
    Route::get('scoreRule/getById', 'Api\ScoreRuleController@getById');
    Route::get('scoreRule/getListByCon', 'Api\ScoreRuleController@getListByCon');

    //shopClerk
    Route::get('shopClerk/getById', 'Api\ShopClerkController@getById');
    Route::get('shopClerk/getListByCon', 'Api\ShopClerkController@getListByCon');

    //shopClerkLogin
    Route::get('shopClerkLogin/getById', 'Api\ShopClerkLoginController@getById');
    Route::get('shopClerkLogin/getListByCon', 'Api\ShopClerkLoginController@getListByCon');

    //shopContract
    Route::get('shopContract/getById', 'Api\ShopContractController@getById');
    Route::get('shopContract/getListByCon', 'Api\ShopContractController@getListByCon');

    //shop
    Route::get('shop/getById', 'Api\ShopController@getById');
    Route::get('shop/getListByCon', 'Api\ShopController@getListByCon');

    //shopSettlement
    Route::get('shopSettlement/getById', 'Api\ShopSettlementController@getById');
    Route::get('shopSettlement/getListByCon', 'Api\ShopSettlementController@getListByCon');

    //shopStore
    Route::get('shopStore/getById', 'Api\ShopStoreController@getById');
    Route::get('shopStore/getListByCon', 'Api\ShopStoreController@getListByCon');

    //subProduct
    Route::get('subProduct/getById', 'Api\SubProductController@getById');
    Route::get('subProduct/getListByCon', 'Api\SubProductController@getListByCon');

    //userCoupon
    Route::get('userCoupon/getById', 'Api\UserCouponController@getById');
    Route::get('userCoupon/getListByCon', 'Api\UserCouponController@getListByCon');

    //user
    Route::get('user/getById', 'Api\UserController@getById');
    Route::get('user/getListByCon', 'Api\UserController@getListByCon');

    //userLogin
    Route::get('userLogin/getById', 'Api\UserLoginController@getById');
    Route::get('userLogin/getListByCon', 'Api\UserLoginController@getListByCon');

    //userShopClerkApply
    Route::get('userShopClerkApply/getById', 'Api\UserShopClerkApplyController@getById');
    Route::get('userShopClerkApply/getListByCon', 'Api\UserShopClerkApplyController@getListByCon');

    //vericode
    Route::get('vericode/getById', 'Api\VericodeController@getById');
    Route::get('vericode/getListByCon', 'Api\VericodeController@getListByCon');

    //vericodeVerifyRecord
    Route::get('vericodeVerifyRecord/getById', 'Api\VericodeVerifyRecordController@getById');
    Route::get('vericodeVerifyRecord/getListByCon', 'Api\VericodeVerifyRecordController@getListByCon');

    //vertify
    Route::get('vertify/getById', 'Api\VertifyController@getById');
    Route::get('vertify/getListByCon', 'Api\VertifyController@getListByCon');

    //xcxFormId
    Route::get('xcxFormId/getById', 'Api\XcxFormIdController@getById');
    Route::get('xcxFormId/getListByCon', 'Api\XcxFormIdController@getListByCon');

    //zan
    Route::get('zan/getById', 'Api\ZanController@getById');
    Route::get('zan/getListByCon', 'Api\ZanController@getListByCon');

