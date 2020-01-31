<?php


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


    //assessRecord
    Route::any('/assessRecord/index', 'Admin\AssessRecordController@index');  //assessRecord首页
    Route::get('/assessRecord/edit', 'Admin\AssessRecordController@edit');  //编辑assessRecord
    Route::post('/assessRecord/edit', 'Admin\AssessRecordController@editPost');  //编辑assessRecord
    Route::get('/assessRecord/setStatus/{id}', 'Admin\AssessRecordController@setStatus');  //设置assessRecord状态
    Route::post('/assessRecord/deleteById/{id}', 'Admin\AssessRecordController@deleteById');  //删除assessRecord
    Route::get('/assessRecord/info', 'Admin\AssessRecordController@info');  //详细信息assessRecord


    //city
    Route::any('/city/index', 'Admin\CityController@index');  //city首页
    Route::get('/city/edit', 'Admin\CityController@edit');  //编辑city
    Route::post('/city/edit', 'Admin\CityController@editPost');  //编辑city
    Route::get('/city/setStatus/{id}', 'Admin\CityController@setStatus');  //设置city状态
    Route::post('/city/deleteById/{id}', 'Admin\CityController@deleteById');  //删除city
    Route::get('/city/info', 'Admin\CityController@info');  //详细信息city


    //collectionDoctorVideo
    Route::any('/collectionDoctorVideo/index', 'Admin\CollectionDoctorVideoController@index');  //collectionDoctorVideo首页
    Route::get('/collectionDoctorVideo/edit', 'Admin\CollectionDoctorVideoController@edit');  //编辑collectionDoctorVideo
    Route::post('/collectionDoctorVideo/edit', 'Admin\CollectionDoctorVideoController@editPost');  //编辑collectionDoctorVideo
    Route::get('/collectionDoctorVideo/setStatus/{id}', 'Admin\CollectionDoctorVideoController@setStatus');  //设置collectionDoctorVideo状态
    Route::post('/collectionDoctorVideo/deleteById/{id}', 'Admin\CollectionDoctorVideoController@deleteById');  //删除collectionDoctorVideo
    Route::get('/collectionDoctorVideo/info', 'Admin\CollectionDoctorVideoController@info');  //详细信息collectionDoctorVideo


    //collectionDoctorVideoLabel
    Route::any('/collectionDoctorVideoLabel/index', 'Admin\CollectionDoctorVideoLabelController@index');  //collectionDoctorVideoLabel首页
    Route::get('/collectionDoctorVideoLabel/edit', 'Admin\CollectionDoctorVideoLabelController@edit');  //编辑collectionDoctorVideoLabel
    Route::post('/collectionDoctorVideoLabel/edit', 'Admin\CollectionDoctorVideoLabelController@editPost');  //编辑collectionDoctorVideoLabel
    Route::get('/collectionDoctorVideoLabel/setStatus/{id}', 'Admin\CollectionDoctorVideoLabelController@setStatus');  //设置collectionDoctorVideoLabel状态
    Route::post('/collectionDoctorVideoLabel/deleteById/{id}', 'Admin\CollectionDoctorVideoLabelController@deleteById');  //删除collectionDoctorVideoLabel
    Route::get('/collectionDoctorVideoLabel/info', 'Admin\CollectionDoctorVideoLabelController@info');  //详细信息collectionDoctorVideoLabel


    //collectionPatient
    Route::any('/collectionPatient/index', 'Admin\CollectionPatientController@index');  //collectionPatient首页
    Route::get('/collectionPatient/edit', 'Admin\CollectionPatientController@edit');  //编辑collectionPatient
    Route::post('/collectionPatient/edit', 'Admin\CollectionPatientController@editPost');  //编辑collectionPatient
    Route::get('/collectionPatient/setStatus/{id}', 'Admin\CollectionPatientController@setStatus');  //设置collectionPatient状态
    Route::post('/collectionPatient/deleteById/{id}', 'Admin\CollectionPatientController@deleteById');  //删除collectionPatient
    Route::get('/collectionPatient/info', 'Admin\CollectionPatientController@info');  //详细信息collectionPatient


    //doctor
    Route::any('/doctor/index', 'Admin\DoctorController@index');  //doctor首页
    Route::get('/doctor/edit', 'Admin\DoctorController@edit');  //编辑doctor
    Route::post('/doctor/edit', 'Admin\DoctorController@editPost');  //编辑doctor
    Route::get('/doctor/setStatus/{id}', 'Admin\DoctorController@setStatus');  //设置doctor状态
    Route::post('/doctor/deleteById/{id}', 'Admin\DoctorController@deleteById');  //删除doctor
    Route::get('/doctor/info', 'Admin\DoctorController@info');  //详细信息doctor


    //doctorLogin
    Route::any('/doctorLogin/index', 'Admin\DoctorLoginController@index');  //doctorLogin首页
    Route::get('/doctorLogin/edit', 'Admin\DoctorLoginController@edit');  //编辑doctorLogin
    Route::post('/doctorLogin/edit', 'Admin\DoctorLoginController@editPost');  //编辑doctorLogin
    Route::get('/doctorLogin/setStatus/{id}', 'Admin\DoctorLoginController@setStatus');  //设置doctorLogin状态
    Route::post('/doctorLogin/deleteById/{id}', 'Admin\DoctorLoginController@deleteById');  //删除doctorLogin
    Route::get('/doctorLogin/info', 'Admin\DoctorLoginController@info');  //详细信息doctorLogin


    //doctorPatientRel
    Route::any('/doctorPatientRel/index', 'Admin\DoctorPatientRelController@index');  //doctorPatientRel首页
    Route::get('/doctorPatientRel/edit', 'Admin\DoctorPatientRelController@edit');  //编辑doctorPatientRel
    Route::post('/doctorPatientRel/edit', 'Admin\DoctorPatientRelController@editPost');  //编辑doctorPatientRel
    Route::get('/doctorPatientRel/setStatus/{id}', 'Admin\DoctorPatientRelController@setStatus');  //设置doctorPatientRel状态
    Route::post('/doctorPatientRel/deleteById/{id}', 'Admin\DoctorPatientRelController@deleteById');  //删除doctorPatientRel
    Route::get('/doctorPatientRel/info', 'Admin\DoctorPatientRelController@info');  //详细信息doctorPatientRel


    //doctorPatientRelEasemob
    Route::any('/doctorPatientRelEasemob/index', 'Admin\DoctorPatientRelEasemobController@index');  //doctorPatientRelEasemob首页
    Route::get('/doctorPatientRelEasemob/edit', 'Admin\DoctorPatientRelEasemobController@edit');  //编辑doctorPatientRelEasemob
    Route::post('/doctorPatientRelEasemob/edit', 'Admin\DoctorPatientRelEasemobController@editPost');  //编辑doctorPatientRelEasemob
    Route::get('/doctorPatientRelEasemob/setStatus/{id}', 'Admin\DoctorPatientRelEasemobController@setStatus');  //设置doctorPatientRelEasemob状态
    Route::post('/doctorPatientRelEasemob/deleteById/{id}', 'Admin\DoctorPatientRelEasemobController@deleteById');  //删除doctorPatientRelEasemob
    Route::get('/doctorPatientRelEasemob/info', 'Admin\DoctorPatientRelEasemobController@info');  //详细信息doctorPatientRelEasemob


    //easemobUser
    Route::any('/easemobUser/index', 'Admin\EasemobUserController@index');  //easemobUser首页
    Route::get('/easemobUser/edit', 'Admin\EasemobUserController@edit');  //编辑easemobUser
    Route::post('/easemobUser/edit', 'Admin\EasemobUserController@editPost');  //编辑easemobUser
    Route::get('/easemobUser/setStatus/{id}', 'Admin\EasemobUserController@setStatus');  //设置easemobUser状态
    Route::post('/easemobUser/deleteById/{id}', 'Admin\EasemobUserController@deleteById');  //删除easemobUser
    Route::get('/easemobUser/info', 'Admin\EasemobUserController@info');  //详细信息easemobUser


    //field
    Route::any('/field/index', 'Admin\FieldController@index');  //field首页
    Route::get('/field/edit', 'Admin\FieldController@edit');  //编辑field
    Route::post('/field/edit', 'Admin\FieldController@editPost');  //编辑field
    Route::get('/field/setStatus/{id}', 'Admin\FieldController@setStatus');  //设置field状态
    Route::post('/field/deleteById/{id}', 'Admin\FieldController@deleteById');  //删除field
    Route::get('/field/info', 'Admin\FieldController@info');  //详细信息field


    //fieldTemplate
    Route::any('/fieldTemplate/index', 'Admin\FieldTemplateController@index');  //fieldTemplate首页
    Route::get('/fieldTemplate/edit', 'Admin\FieldTemplateController@edit');  //编辑fieldTemplate
    Route::post('/fieldTemplate/edit', 'Admin\FieldTemplateController@editPost');  //编辑fieldTemplate
    Route::get('/fieldTemplate/setStatus/{id}', 'Admin\FieldTemplateController@setStatus');  //设置fieldTemplate状态
    Route::post('/fieldTemplate/deleteById/{id}', 'Admin\FieldTemplateController@deleteById');  //删除fieldTemplate
    Route::get('/fieldTemplate/info', 'Admin\FieldTemplateController@info');  //详细信息fieldTemplate


    //fieldType
    Route::any('/fieldType/index', 'Admin\FieldTypeController@index');  //fieldType首页
    Route::get('/fieldType/edit', 'Admin\FieldTypeController@edit');  //编辑fieldType
    Route::post('/fieldType/edit', 'Admin\FieldTypeController@editPost');  //编辑fieldType
    Route::get('/fieldType/setStatus/{id}', 'Admin\FieldTypeController@setStatus');  //设置fieldType状态
    Route::post('/fieldType/deleteById/{id}', 'Admin\FieldTypeController@deleteById');  //删除fieldType
    Route::get('/fieldType/info', 'Admin\FieldTypeController@info');  //详细信息fieldType


    //hospitalDepartment
    Route::any('/hospitalDepartment/index', 'Admin\HospitalDepartmentController@index');  //hospitalDepartment首页
    Route::get('/hospitalDepartment/edit', 'Admin\HospitalDepartmentController@edit');  //编辑hospitalDepartment
    Route::post('/hospitalDepartment/edit', 'Admin\HospitalDepartmentController@editPost');  //编辑hospitalDepartment
    Route::get('/hospitalDepartment/setStatus/{id}', 'Admin\HospitalDepartmentController@setStatus');  //设置hospitalDepartment状态
    Route::post('/hospitalDepartment/deleteById/{id}', 'Admin\HospitalDepartmentController@deleteById');  //删除hospitalDepartment
    Route::get('/hospitalDepartment/info', 'Admin\HospitalDepartmentController@info');  //详细信息hospitalDepartment


    //hospital
    Route::any('/hospital/index', 'Admin\HospitalController@index');  //hospital首页
    Route::get('/hospital/edit', 'Admin\HospitalController@edit');  //编辑hospital
    Route::post('/hospital/edit', 'Admin\HospitalController@editPost');  //编辑hospital
    Route::get('/hospital/setStatus/{id}', 'Admin\HospitalController@setStatus');  //设置hospital状态
    Route::post('/hospital/deleteById/{id}', 'Admin\HospitalController@deleteById');  //删除hospital
    Route::get('/hospital/info', 'Admin\HospitalController@info');  //详细信息hospital


    //materialRecord
    Route::any('/materialRecord/index', 'Admin\MaterialRecordController@index');  //materialRecord首页
    Route::get('/materialRecord/edit', 'Admin\MaterialRecordController@edit');  //编辑materialRecord
    Route::post('/materialRecord/edit', 'Admin\MaterialRecordController@editPost');  //编辑materialRecord
    Route::get('/materialRecord/setStatus/{id}', 'Admin\MaterialRecordController@setStatus');  //设置materialRecord状态
    Route::post('/materialRecord/deleteById/{id}', 'Admin\MaterialRecordController@deleteById');  //删除materialRecord
    Route::get('/materialRecord/info', 'Admin\MaterialRecordController@info');  //详细信息materialRecord


    //nationality
    Route::any('/nationality/index', 'Admin\NationalityController@index');  //nationality首页
    Route::get('/nationality/edit', 'Admin\NationalityController@edit');  //编辑nationality
    Route::post('/nationality/edit', 'Admin\NationalityController@editPost');  //编辑nationality
    Route::get('/nationality/setStatus/{id}', 'Admin\NationalityController@setStatus');  //设置nationality状态
    Route::post('/nationality/deleteById/{id}', 'Admin\NationalityController@deleteById');  //删除nationality
    Route::get('/nationality/info', 'Admin\NationalityController@info');  //详细信息nationality


    //patientCase
    Route::any('/patientCase/index', 'Admin\PatientCaseController@index');  //patientCase首页
    Route::get('/patientCase/edit', 'Admin\PatientCaseController@edit');  //编辑patientCase
    Route::post('/patientCase/edit', 'Admin\PatientCaseController@editPost');  //编辑patientCase
    Route::get('/patientCase/setStatus/{id}', 'Admin\PatientCaseController@setStatus');  //设置patientCase状态
    Route::post('/patientCase/deleteById/{id}', 'Admin\PatientCaseController@deleteById');  //删除patientCase
    Route::get('/patientCase/info', 'Admin\PatientCaseController@info');  //详细信息patientCase


    //patientCaseTmplementTask
    Route::any('/patientCaseTmplementTask/index', 'Admin\PatientCaseTmplementTaskController@index');  //patientCaseTmplementTask首页
    Route::get('/patientCaseTmplementTask/edit', 'Admin\PatientCaseTmplementTaskController@edit');  //编辑patientCaseTmplementTask
    Route::post('/patientCaseTmplementTask/edit', 'Admin\PatientCaseTmplementTaskController@editPost');  //编辑patientCaseTmplementTask
    Route::get('/patientCaseTmplementTask/setStatus/{id}', 'Admin\PatientCaseTmplementTaskController@setStatus');  //设置patientCaseTmplementTask状态
    Route::post('/patientCaseTmplementTask/deleteById/{id}', 'Admin\PatientCaseTmplementTaskController@deleteById');  //删除patientCaseTmplementTask
    Route::get('/patientCaseTmplementTask/info', 'Admin\PatientCaseTmplementTaskController@info');  //详细信息patientCaseTmplementTask


    //patient
    Route::any('/patient/index', 'Admin\PatientController@index');  //patient首页
    Route::get('/patient/edit', 'Admin\PatientController@edit');  //编辑patient
    Route::post('/patient/edit', 'Admin\PatientController@editPost');  //编辑patient
    Route::get('/patient/setStatus/{id}', 'Admin\PatientController@setStatus');  //设置patient状态
    Route::post('/patient/deleteById/{id}', 'Admin\PatientController@deleteById');  //删除patient
    Route::get('/patient/info', 'Admin\PatientController@info');  //详细信息patient


    //patientInspectInfo
    Route::any('/patientInspectInfo/index', 'Admin\PatientInspectInfoController@index');  //patientInspectInfo首页
    Route::get('/patientInspectInfo/edit', 'Admin\PatientInspectInfoController@edit');  //编辑patientInspectInfo
    Route::post('/patientInspectInfo/edit', 'Admin\PatientInspectInfoController@editPost');  //编辑patientInspectInfo
    Route::get('/patientInspectInfo/setStatus/{id}', 'Admin\PatientInspectInfoController@setStatus');  //设置patientInspectInfo状态
    Route::post('/patientInspectInfo/deleteById/{id}', 'Admin\PatientInspectInfoController@deleteById');  //删除patientInspectInfo
    Route::get('/patientInspectInfo/info', 'Admin\PatientInspectInfoController@info');  //详细信息patientInspectInfo


    //patientPlan
    Route::any('/patientPlan/index', 'Admin\PatientPlanController@index');  //patientPlan首页
    Route::get('/patientPlan/edit', 'Admin\PatientPlanController@edit');  //编辑patientPlan
    Route::post('/patientPlan/edit', 'Admin\PatientPlanController@editPost');  //编辑patientPlan
    Route::get('/patientPlan/setStatus/{id}', 'Admin\PatientPlanController@setStatus');  //设置patientPlan状态
    Route::post('/patientPlan/deleteById/{id}', 'Admin\PatientPlanController@deleteById');  //删除patientPlan
    Route::get('/patientPlan/info', 'Admin\PatientPlanController@info');  //详细信息patientPlan


    //patientPlanTemplate
    Route::any('/patientPlanTemplate/index', 'Admin\PatientPlanTemplateController@index');  //patientPlanTemplate首页
    Route::get('/patientPlanTemplate/edit', 'Admin\PatientPlanTemplateController@edit');  //编辑patientPlanTemplate
    Route::post('/patientPlanTemplate/edit', 'Admin\PatientPlanTemplateController@editPost');  //编辑patientPlanTemplate
    Route::get('/patientPlanTemplate/setStatus/{id}', 'Admin\PatientPlanTemplateController@setStatus');  //设置patientPlanTemplate状态
    Route::post('/patientPlanTemplate/deleteById/{id}', 'Admin\PatientPlanTemplateController@deleteById');  //删除patientPlanTemplate
    Route::get('/patientPlanTemplate/info', 'Admin\PatientPlanTemplateController@info');  //详细信息patientPlanTemplate


    //patientPlanTemplateItem
    Route::any('/patientPlanTemplateItem/index', 'Admin\PatientPlanTemplateItemController@index');  //patientPlanTemplateItem首页
    Route::get('/patientPlanTemplateItem/edit', 'Admin\PatientPlanTemplateItemController@edit');  //编辑patientPlanTemplateItem
    Route::post('/patientPlanTemplateItem/edit', 'Admin\PatientPlanTemplateItemController@editPost');  //编辑patientPlanTemplateItem
    Route::get('/patientPlanTemplateItem/setStatus/{id}', 'Admin\PatientPlanTemplateItemController@setStatus');  //设置patientPlanTemplateItem状态
    Route::post('/patientPlanTemplateItem/deleteById/{id}', 'Admin\PatientPlanTemplateItemController@deleteById');  //删除patientPlanTemplateItem
    Route::get('/patientPlanTemplateItem/info', 'Admin\PatientPlanTemplateItemController@info');  //详细信息patientPlanTemplateItem


    //patientTw
    Route::any('/patientTw/index', 'Admin\PatientTwController@index');  //patientTw首页
    Route::get('/patientTw/edit', 'Admin\PatientTwController@edit');  //编辑patientTw
    Route::post('/patientTw/edit', 'Admin\PatientTwController@editPost');  //编辑patientTw
    Route::get('/patientTw/setStatus/{id}', 'Admin\PatientTwController@setStatus');  //设置patientTw状态
    Route::post('/patientTw/deleteById/{id}', 'Admin\PatientTwController@deleteById');  //删除patientTw
    Route::get('/patientTw/info', 'Admin\PatientTwController@info');  //详细信息patientTw


    //provinceCity
    Route::any('/provinceCity/index', 'Admin\ProvinceCityController@index');  //provinceCity首页
    Route::get('/provinceCity/edit', 'Admin\ProvinceCityController@edit');  //编辑provinceCity
    Route::post('/provinceCity/edit', 'Admin\ProvinceCityController@editPost');  //编辑provinceCity
    Route::get('/provinceCity/setStatus/{id}', 'Admin\ProvinceCityController@setStatus');  //设置provinceCity状态
    Route::post('/provinceCity/deleteById/{id}', 'Admin\ProvinceCityController@deleteById');  //删除provinceCity
    Route::get('/provinceCity/info', 'Admin\ProvinceCityController@info');  //详细信息provinceCity


    //scaleAnswer
    Route::any('/scaleAnswer/index', 'Admin\ScaleAnswerController@index');  //scaleAnswer首页
    Route::get('/scaleAnswer/edit', 'Admin\ScaleAnswerController@edit');  //编辑scaleAnswer
    Route::post('/scaleAnswer/edit', 'Admin\ScaleAnswerController@editPost');  //编辑scaleAnswer
    Route::get('/scaleAnswer/setStatus/{id}', 'Admin\ScaleAnswerController@setStatus');  //设置scaleAnswer状态
    Route::post('/scaleAnswer/deleteById/{id}', 'Admin\ScaleAnswerController@deleteById');  //删除scaleAnswer
    Route::get('/scaleAnswer/info', 'Admin\ScaleAnswerController@info');  //详细信息scaleAnswer


    //scale
    Route::any('/scale/index', 'Admin\ScaleController@index');  //scale首页
    Route::get('/scale/edit', 'Admin\ScaleController@edit');  //编辑scale
    Route::post('/scale/edit', 'Admin\ScaleController@editPost');  //编辑scale
    Route::get('/scale/setStatus/{id}', 'Admin\ScaleController@setStatus');  //设置scale状态
    Route::post('/scale/deleteById/{id}', 'Admin\ScaleController@deleteById');  //删除scale
    Route::get('/scale/info', 'Admin\ScaleController@info');  //详细信息scale


    //scaleTopic
    Route::any('/scaleTopic/index', 'Admin\ScaleTopicController@index');  //scaleTopic首页
    Route::get('/scaleTopic/edit', 'Admin\ScaleTopicController@edit');  //编辑scaleTopic
    Route::post('/scaleTopic/edit', 'Admin\ScaleTopicController@editPost');  //编辑scaleTopic
    Route::get('/scaleTopic/setStatus/{id}', 'Admin\ScaleTopicController@setStatus');  //设置scaleTopic状态
    Route::post('/scaleTopic/deleteById/{id}', 'Admin\ScaleTopicController@deleteById');  //删除scaleTopic
    Route::get('/scaleTopic/info', 'Admin\ScaleTopicController@info');  //详细信息scaleTopic


    //vertify
    Route::any('/vertify/index', 'Admin\VertifyController@index');  //vertify首页
    Route::get('/vertify/edit', 'Admin\VertifyController@edit');  //编辑vertify
    Route::post('/vertify/edit', 'Admin\VertifyController@editPost');  //编辑vertify
    Route::get('/vertify/setStatus/{id}', 'Admin\VertifyController@setStatus');  //设置vertify状态
    Route::post('/vertify/deleteById/{id}', 'Admin\VertifyController@deleteById');  //删除vertify
    Route::get('/vertify/info', 'Admin\VertifyController@info');  //详细信息vertify


