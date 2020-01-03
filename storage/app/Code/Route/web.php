<?php


    //ad
    Route::any('/ad/index', 'Admin\AdController@index');  //ad首页
    Route::get('/ad/edit', 'Admin\AdController@edit');  //编辑ad
    Route::post('/ad/edit', 'Admin\AdController@editPost');  //编辑ad
    Route::get('/ad/setStatus/{id}', 'Admin\AdController@setStatus');  //设置ad状态
    Route::post('/ad/deleteById/{id}', 'Admin\AdController@deleteById');  //删除ad
    Route::get('/ad/info', 'Admin\AdController@info');  //详细信息ad


    //admin
    Route::any('/admin/index', 'Admin\AdminController@index');  //admin首页
    Route::get('/admin/edit', 'Admin\AdminController@edit');  //编辑admin
    Route::post('/admin/edit', 'Admin\AdminController@editPost');  //编辑admin
    Route::get('/admin/setStatus/{id}', 'Admin\AdminController@setStatus');  //设置admin状态
    Route::post('/admin/deleteById/{id}', 'Admin\AdminController@deleteById');  //删除admin
    Route::get('/admin/info', 'Admin\AdminController@info');  //详细信息admin


    //adminLogin
    Route::any('/adminLogin/index', 'Admin\AdminLoginController@index');  //adminLogin首页
    Route::get('/adminLogin/edit', 'Admin\AdminLoginController@edit');  //编辑adminLogin
    Route::post('/adminLogin/edit', 'Admin\AdminLoginController@editPost');  //编辑adminLogin
    Route::get('/adminLogin/setStatus/{id}', 'Admin\AdminLoginController@setStatus');  //设置adminLogin状态
    Route::post('/adminLogin/deleteById/{id}', 'Admin\AdminLoginController@deleteById');  //删除adminLogin
    Route::get('/adminLogin/info', 'Admin\AdminLoginController@info');  //详细信息adminLogin


    //bank
    Route::any('/bank/index', 'Admin\BankController@index');  //bank首页
    Route::get('/bank/edit', 'Admin\BankController@edit');  //编辑bank
    Route::post('/bank/edit', 'Admin\BankController@editPost');  //编辑bank
    Route::get('/bank/setStatus/{id}', 'Admin\BankController@setStatus');  //设置bank状态
    Route::post('/bank/deleteById/{id}', 'Admin\BankController@deleteById');  //删除bank
    Route::get('/bank/info', 'Admin\BankController@info');  //详细信息bank


    //city
    Route::any('/city/index', 'Admin\CityController@index');  //city首页
    Route::get('/city/edit', 'Admin\CityController@edit');  //编辑city
    Route::post('/city/edit', 'Admin\CityController@editPost');  //编辑city
    Route::get('/city/setStatus/{id}', 'Admin\CityController@setStatus');  //设置city状态
    Route::post('/city/deleteById/{id}', 'Admin\CityController@deleteById');  //删除city
    Route::get('/city/info', 'Admin\CityController@info');  //详细信息city


    //collect
    Route::any('/collect/index', 'Admin\CollectController@index');  //collect首页
    Route::get('/collect/edit', 'Admin\CollectController@edit');  //编辑collect
    Route::post('/collect/edit', 'Admin\CollectController@editPost');  //编辑collect
    Route::get('/collect/setStatus/{id}', 'Admin\CollectController@setStatus');  //设置collect状态
    Route::post('/collect/deleteById/{id}', 'Admin\CollectController@deleteById');  //删除collect
    Route::get('/collect/info', 'Admin\CollectController@info');  //详细信息collect


    //comment
    Route::any('/comment/index', 'Admin\CommentController@index');  //comment首页
    Route::get('/comment/edit', 'Admin\CommentController@edit');  //编辑comment
    Route::post('/comment/edit', 'Admin\CommentController@editPost');  //编辑comment
    Route::get('/comment/setStatus/{id}', 'Admin\CommentController@setStatus');  //设置comment状态
    Route::post('/comment/deleteById/{id}', 'Admin\CommentController@deleteById');  //删除comment
    Route::get('/comment/info', 'Admin\CommentController@info');  //详细信息comment


    //company
    Route::any('/company/index', 'Admin\CompanyController@index');  //company首页
    Route::get('/company/edit', 'Admin\CompanyController@edit');  //编辑company
    Route::post('/company/edit', 'Admin\CompanyController@editPost');  //编辑company
    Route::get('/company/setStatus/{id}', 'Admin\CompanyController@setStatus');  //设置company状态
    Route::post('/company/deleteById/{id}', 'Admin\CompanyController@deleteById');  //删除company
    Route::get('/company/info', 'Admin\CompanyController@info');  //详细信息company


    //coupon
    Route::any('/coupon/index', 'Admin\CouponController@index');  //coupon首页
    Route::get('/coupon/edit', 'Admin\CouponController@edit');  //编辑coupon
    Route::post('/coupon/edit', 'Admin\CouponController@editPost');  //编辑coupon
    Route::get('/coupon/setStatus/{id}', 'Admin\CouponController@setStatus');  //设置coupon状态
    Route::post('/coupon/deleteById/{id}', 'Admin\CouponController@deleteById');  //删除coupon
    Route::get('/coupon/info', 'Admin\CouponController@info');  //详细信息coupon


    //dailyCheckOrder
    Route::any('/dailyCheckOrder/index', 'Admin\DailyCheckOrderController@index');  //dailyCheckOrder首页
    Route::get('/dailyCheckOrder/edit', 'Admin\DailyCheckOrderController@edit');  //编辑dailyCheckOrder
    Route::post('/dailyCheckOrder/edit', 'Admin\DailyCheckOrderController@editPost');  //编辑dailyCheckOrder
    Route::get('/dailyCheckOrder/setStatus/{id}', 'Admin\DailyCheckOrderController@setStatus');  //设置dailyCheckOrder状态
    Route::post('/dailyCheckOrder/deleteById/{id}', 'Admin\DailyCheckOrderController@deleteById');  //删除dailyCheckOrder
    Route::get('/dailyCheckOrder/info', 'Admin\DailyCheckOrderController@info');  //详细信息dailyCheckOrder


    //order
    Route::any('/order/index', 'Admin\OrderController@index');  //order首页
    Route::get('/order/edit', 'Admin\OrderController@edit');  //编辑order
    Route::post('/order/edit', 'Admin\OrderController@editPost');  //编辑order
    Route::get('/order/setStatus/{id}', 'Admin\OrderController@setStatus');  //设置order状态
    Route::post('/order/deleteById/{id}', 'Admin\OrderController@deleteById');  //删除order
    Route::get('/order/info', 'Admin\OrderController@info');  //详细信息order


    //product
    Route::any('/product/index', 'Admin\ProductController@index');  //product首页
    Route::get('/product/edit', 'Admin\ProductController@edit');  //编辑product
    Route::post('/product/edit', 'Admin\ProductController@editPost');  //编辑product
    Route::get('/product/setStatus/{id}', 'Admin\ProductController@setStatus');  //设置product状态
    Route::post('/product/deleteById/{id}', 'Admin\ProductController@deleteById');  //删除product
    Route::get('/product/info', 'Admin\ProductController@info');  //详细信息product


    //productLevel1Type
    Route::any('/productLevel1Type/index', 'Admin\ProductLevel1TypeController@index');  //productLevel1Type首页
    Route::get('/productLevel1Type/edit', 'Admin\ProductLevel1TypeController@edit');  //编辑productLevel1Type
    Route::post('/productLevel1Type/edit', 'Admin\ProductLevel1TypeController@editPost');  //编辑productLevel1Type
    Route::get('/productLevel1Type/setStatus/{id}', 'Admin\ProductLevel1TypeController@setStatus');  //设置productLevel1Type状态
    Route::post('/productLevel1Type/deleteById/{id}', 'Admin\ProductLevel1TypeController@deleteById');  //删除productLevel1Type
    Route::get('/productLevel1Type/info', 'Admin\ProductLevel1TypeController@info');  //详细信息productLevel1Type


    //productLevel2Type
    Route::any('/productLevel2Type/index', 'Admin\ProductLevel2TypeController@index');  //productLevel2Type首页
    Route::get('/productLevel2Type/edit', 'Admin\ProductLevel2TypeController@edit');  //编辑productLevel2Type
    Route::post('/productLevel2Type/edit', 'Admin\ProductLevel2TypeController@editPost');  //编辑productLevel2Type
    Route::get('/productLevel2Type/setStatus/{id}', 'Admin\ProductLevel2TypeController@setStatus');  //设置productLevel2Type状态
    Route::post('/productLevel2Type/deleteById/{id}', 'Admin\ProductLevel2TypeController@deleteById');  //删除productLevel2Type
    Route::get('/productLevel2Type/info', 'Admin\ProductLevel2TypeController@info');  //详细信息productLevel2Type


    //ruleTw
    Route::any('/ruleTw/index', 'Admin\RuleTwController@index');  //ruleTw首页
    Route::get('/ruleTw/edit', 'Admin\RuleTwController@edit');  //编辑ruleTw
    Route::post('/ruleTw/edit', 'Admin\RuleTwController@editPost');  //编辑ruleTw
    Route::get('/ruleTw/setStatus/{id}', 'Admin\RuleTwController@setStatus');  //设置ruleTw状态
    Route::post('/ruleTw/deleteById/{id}', 'Admin\RuleTwController@deleteById');  //删除ruleTw
    Route::get('/ruleTw/info', 'Admin\RuleTwController@info');  //详细信息ruleTw


    //scoreRecord
    Route::any('/scoreRecord/index', 'Admin\ScoreRecordController@index');  //scoreRecord首页
    Route::get('/scoreRecord/edit', 'Admin\ScoreRecordController@edit');  //编辑scoreRecord
    Route::post('/scoreRecord/edit', 'Admin\ScoreRecordController@editPost');  //编辑scoreRecord
    Route::get('/scoreRecord/setStatus/{id}', 'Admin\ScoreRecordController@setStatus');  //设置scoreRecord状态
    Route::post('/scoreRecord/deleteById/{id}', 'Admin\ScoreRecordController@deleteById');  //删除scoreRecord
    Route::get('/scoreRecord/info', 'Admin\ScoreRecordController@info');  //详细信息scoreRecord


    //scoreRule
    Route::any('/scoreRule/index', 'Admin\ScoreRuleController@index');  //scoreRule首页
    Route::get('/scoreRule/edit', 'Admin\ScoreRuleController@edit');  //编辑scoreRule
    Route::post('/scoreRule/edit', 'Admin\ScoreRuleController@editPost');  //编辑scoreRule
    Route::get('/scoreRule/setStatus/{id}', 'Admin\ScoreRuleController@setStatus');  //设置scoreRule状态
    Route::post('/scoreRule/deleteById/{id}', 'Admin\ScoreRuleController@deleteById');  //删除scoreRule
    Route::get('/scoreRule/info', 'Admin\ScoreRuleController@info');  //详细信息scoreRule


    //shopClerk
    Route::any('/shopClerk/index', 'Admin\ShopClerkController@index');  //shopClerk首页
    Route::get('/shopClerk/edit', 'Admin\ShopClerkController@edit');  //编辑shopClerk
    Route::post('/shopClerk/edit', 'Admin\ShopClerkController@editPost');  //编辑shopClerk
    Route::get('/shopClerk/setStatus/{id}', 'Admin\ShopClerkController@setStatus');  //设置shopClerk状态
    Route::post('/shopClerk/deleteById/{id}', 'Admin\ShopClerkController@deleteById');  //删除shopClerk
    Route::get('/shopClerk/info', 'Admin\ShopClerkController@info');  //详细信息shopClerk


    //shopClerkLogin
    Route::any('/shopClerkLogin/index', 'Admin\ShopClerkLoginController@index');  //shopClerkLogin首页
    Route::get('/shopClerkLogin/edit', 'Admin\ShopClerkLoginController@edit');  //编辑shopClerkLogin
    Route::post('/shopClerkLogin/edit', 'Admin\ShopClerkLoginController@editPost');  //编辑shopClerkLogin
    Route::get('/shopClerkLogin/setStatus/{id}', 'Admin\ShopClerkLoginController@setStatus');  //设置shopClerkLogin状态
    Route::post('/shopClerkLogin/deleteById/{id}', 'Admin\ShopClerkLoginController@deleteById');  //删除shopClerkLogin
    Route::get('/shopClerkLogin/info', 'Admin\ShopClerkLoginController@info');  //详细信息shopClerkLogin


    //shopContract
    Route::any('/shopContract/index', 'Admin\ShopContractController@index');  //shopContract首页
    Route::get('/shopContract/edit', 'Admin\ShopContractController@edit');  //编辑shopContract
    Route::post('/shopContract/edit', 'Admin\ShopContractController@editPost');  //编辑shopContract
    Route::get('/shopContract/setStatus/{id}', 'Admin\ShopContractController@setStatus');  //设置shopContract状态
    Route::post('/shopContract/deleteById/{id}', 'Admin\ShopContractController@deleteById');  //删除shopContract
    Route::get('/shopContract/info', 'Admin\ShopContractController@info');  //详细信息shopContract


    //shop
    Route::any('/shop/index', 'Admin\ShopController@index');  //shop首页
    Route::get('/shop/edit', 'Admin\ShopController@edit');  //编辑shop
    Route::post('/shop/edit', 'Admin\ShopController@editPost');  //编辑shop
    Route::get('/shop/setStatus/{id}', 'Admin\ShopController@setStatus');  //设置shop状态
    Route::post('/shop/deleteById/{id}', 'Admin\ShopController@deleteById');  //删除shop
    Route::get('/shop/info', 'Admin\ShopController@info');  //详细信息shop


    //shopSettlement
    Route::any('/shopSettlement/index', 'Admin\ShopSettlementController@index');  //shopSettlement首页
    Route::get('/shopSettlement/edit', 'Admin\ShopSettlementController@edit');  //编辑shopSettlement
    Route::post('/shopSettlement/edit', 'Admin\ShopSettlementController@editPost');  //编辑shopSettlement
    Route::get('/shopSettlement/setStatus/{id}', 'Admin\ShopSettlementController@setStatus');  //设置shopSettlement状态
    Route::post('/shopSettlement/deleteById/{id}', 'Admin\ShopSettlementController@deleteById');  //删除shopSettlement
    Route::get('/shopSettlement/info', 'Admin\ShopSettlementController@info');  //详细信息shopSettlement


    //shopStore
    Route::any('/shopStore/index', 'Admin\ShopStoreController@index');  //shopStore首页
    Route::get('/shopStore/edit', 'Admin\ShopStoreController@edit');  //编辑shopStore
    Route::post('/shopStore/edit', 'Admin\ShopStoreController@editPost');  //编辑shopStore
    Route::get('/shopStore/setStatus/{id}', 'Admin\ShopStoreController@setStatus');  //设置shopStore状态
    Route::post('/shopStore/deleteById/{id}', 'Admin\ShopStoreController@deleteById');  //删除shopStore
    Route::get('/shopStore/info', 'Admin\ShopStoreController@info');  //详细信息shopStore


    //subProduct
    Route::any('/subProduct/index', 'Admin\SubProductController@index');  //subProduct首页
    Route::get('/subProduct/edit', 'Admin\SubProductController@edit');  //编辑subProduct
    Route::post('/subProduct/edit', 'Admin\SubProductController@editPost');  //编辑subProduct
    Route::get('/subProduct/setStatus/{id}', 'Admin\SubProductController@setStatus');  //设置subProduct状态
    Route::post('/subProduct/deleteById/{id}', 'Admin\SubProductController@deleteById');  //删除subProduct
    Route::get('/subProduct/info', 'Admin\SubProductController@info');  //详细信息subProduct


    //userCoupon
    Route::any('/userCoupon/index', 'Admin\UserCouponController@index');  //userCoupon首页
    Route::get('/userCoupon/edit', 'Admin\UserCouponController@edit');  //编辑userCoupon
    Route::post('/userCoupon/edit', 'Admin\UserCouponController@editPost');  //编辑userCoupon
    Route::get('/userCoupon/setStatus/{id}', 'Admin\UserCouponController@setStatus');  //设置userCoupon状态
    Route::post('/userCoupon/deleteById/{id}', 'Admin\UserCouponController@deleteById');  //删除userCoupon
    Route::get('/userCoupon/info', 'Admin\UserCouponController@info');  //详细信息userCoupon


    //user
    Route::any('/user/index', 'Admin\UserController@index');  //user首页
    Route::get('/user/edit', 'Admin\UserController@edit');  //编辑user
    Route::post('/user/edit', 'Admin\UserController@editPost');  //编辑user
    Route::get('/user/setStatus/{id}', 'Admin\UserController@setStatus');  //设置user状态
    Route::post('/user/deleteById/{id}', 'Admin\UserController@deleteById');  //删除user
    Route::get('/user/info', 'Admin\UserController@info');  //详细信息user


    //userLogin
    Route::any('/userLogin/index', 'Admin\UserLoginController@index');  //userLogin首页
    Route::get('/userLogin/edit', 'Admin\UserLoginController@edit');  //编辑userLogin
    Route::post('/userLogin/edit', 'Admin\UserLoginController@editPost');  //编辑userLogin
    Route::get('/userLogin/setStatus/{id}', 'Admin\UserLoginController@setStatus');  //设置userLogin状态
    Route::post('/userLogin/deleteById/{id}', 'Admin\UserLoginController@deleteById');  //删除userLogin
    Route::get('/userLogin/info', 'Admin\UserLoginController@info');  //详细信息userLogin


    //userShopClerkApply
    Route::any('/userShopClerkApply/index', 'Admin\UserShopClerkApplyController@index');  //userShopClerkApply首页
    Route::get('/userShopClerkApply/edit', 'Admin\UserShopClerkApplyController@edit');  //编辑userShopClerkApply
    Route::post('/userShopClerkApply/edit', 'Admin\UserShopClerkApplyController@editPost');  //编辑userShopClerkApply
    Route::get('/userShopClerkApply/setStatus/{id}', 'Admin\UserShopClerkApplyController@setStatus');  //设置userShopClerkApply状态
    Route::post('/userShopClerkApply/deleteById/{id}', 'Admin\UserShopClerkApplyController@deleteById');  //删除userShopClerkApply
    Route::get('/userShopClerkApply/info', 'Admin\UserShopClerkApplyController@info');  //详细信息userShopClerkApply


    //vericode
    Route::any('/vericode/index', 'Admin\VericodeController@index');  //vericode首页
    Route::get('/vericode/edit', 'Admin\VericodeController@edit');  //编辑vericode
    Route::post('/vericode/edit', 'Admin\VericodeController@editPost');  //编辑vericode
    Route::get('/vericode/setStatus/{id}', 'Admin\VericodeController@setStatus');  //设置vericode状态
    Route::post('/vericode/deleteById/{id}', 'Admin\VericodeController@deleteById');  //删除vericode
    Route::get('/vericode/info', 'Admin\VericodeController@info');  //详细信息vericode


    //vericodeVerifyRecord
    Route::any('/vericodeVerifyRecord/index', 'Admin\VericodeVerifyRecordController@index');  //vericodeVerifyRecord首页
    Route::get('/vericodeVerifyRecord/edit', 'Admin\VericodeVerifyRecordController@edit');  //编辑vericodeVerifyRecord
    Route::post('/vericodeVerifyRecord/edit', 'Admin\VericodeVerifyRecordController@editPost');  //编辑vericodeVerifyRecord
    Route::get('/vericodeVerifyRecord/setStatus/{id}', 'Admin\VericodeVerifyRecordController@setStatus');  //设置vericodeVerifyRecord状态
    Route::post('/vericodeVerifyRecord/deleteById/{id}', 'Admin\VericodeVerifyRecordController@deleteById');  //删除vericodeVerifyRecord
    Route::get('/vericodeVerifyRecord/info', 'Admin\VericodeVerifyRecordController@info');  //详细信息vericodeVerifyRecord


    //vertify
    Route::any('/vertify/index', 'Admin\VertifyController@index');  //vertify首页
    Route::get('/vertify/edit', 'Admin\VertifyController@edit');  //编辑vertify
    Route::post('/vertify/edit', 'Admin\VertifyController@editPost');  //编辑vertify
    Route::get('/vertify/setStatus/{id}', 'Admin\VertifyController@setStatus');  //设置vertify状态
    Route::post('/vertify/deleteById/{id}', 'Admin\VertifyController@deleteById');  //删除vertify
    Route::get('/vertify/info', 'Admin\VertifyController@info');  //详细信息vertify


    //xcxFormId
    Route::any('/xcxFormId/index', 'Admin\XcxFormIdController@index');  //xcxFormId首页
    Route::get('/xcxFormId/edit', 'Admin\XcxFormIdController@edit');  //编辑xcxFormId
    Route::post('/xcxFormId/edit', 'Admin\XcxFormIdController@editPost');  //编辑xcxFormId
    Route::get('/xcxFormId/setStatus/{id}', 'Admin\XcxFormIdController@setStatus');  //设置xcxFormId状态
    Route::post('/xcxFormId/deleteById/{id}', 'Admin\XcxFormIdController@deleteById');  //删除xcxFormId
    Route::get('/xcxFormId/info', 'Admin\XcxFormIdController@info');  //详细信息xcxFormId


    //zan
    Route::any('/zan/index', 'Admin\ZanController@index');  //zan首页
    Route::get('/zan/edit', 'Admin\ZanController@edit');  //编辑zan
    Route::post('/zan/edit', 'Admin\ZanController@editPost');  //编辑zan
    Route::get('/zan/setStatus/{id}', 'Admin\ZanController@setStatus');  //设置zan状态
    Route::post('/zan/deleteById/{id}', 'Admin\ZanController@deleteById');  //删除zan
    Route::get('/zan/info', 'Admin\ZanController@info');  //详细信息zan


