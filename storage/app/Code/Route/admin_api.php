<?php


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


    //assessRecord
    Route::get('assessRecord/getById', 'Api\AssessRecordController@getById');
    Route::get('assessRecord/getListByCon', 'Api\AssessRecordController@getListByCon');
    Route::post('assessRecord/edit', 'Api\AssessRecordController@edit');
    Route::post('assessRecord/deleteById', 'Api\AssessRecordController@deleteById');


    //city
    Route::get('city/getById', 'Api\CityController@getById');
    Route::get('city/getListByCon', 'Api\CityController@getListByCon');
    Route::post('city/edit', 'Api\CityController@edit');
    Route::post('city/deleteById', 'Api\CityController@deleteById');


    //collectionDoctorVideo
    Route::get('collectionDoctorVideo/getById', 'Api\CollectionDoctorVideoController@getById');
    Route::get('collectionDoctorVideo/getListByCon', 'Api\CollectionDoctorVideoController@getListByCon');
    Route::post('collectionDoctorVideo/edit', 'Api\CollectionDoctorVideoController@edit');
    Route::post('collectionDoctorVideo/deleteById', 'Api\CollectionDoctorVideoController@deleteById');


    //collectionDoctorVideoLabel
    Route::get('collectionDoctorVideoLabel/getById', 'Api\CollectionDoctorVideoLabelController@getById');
    Route::get('collectionDoctorVideoLabel/getListByCon', 'Api\CollectionDoctorVideoLabelController@getListByCon');
    Route::post('collectionDoctorVideoLabel/edit', 'Api\CollectionDoctorVideoLabelController@edit');
    Route::post('collectionDoctorVideoLabel/deleteById', 'Api\CollectionDoctorVideoLabelController@deleteById');


    //collectionPatient
    Route::get('collectionPatient/getById', 'Api\CollectionPatientController@getById');
    Route::get('collectionPatient/getListByCon', 'Api\CollectionPatientController@getListByCon');
    Route::post('collectionPatient/edit', 'Api\CollectionPatientController@edit');
    Route::post('collectionPatient/deleteById', 'Api\CollectionPatientController@deleteById');


    //doctor
    Route::get('doctor/getById', 'Api\DoctorController@getById');
    Route::get('doctor/getListByCon', 'Api\DoctorController@getListByCon');
    Route::post('doctor/edit', 'Api\DoctorController@edit');
    Route::post('doctor/deleteById', 'Api\DoctorController@deleteById');


    //doctorLogin
    Route::get('doctorLogin/getById', 'Api\DoctorLoginController@getById');
    Route::get('doctorLogin/getListByCon', 'Api\DoctorLoginController@getListByCon');
    Route::post('doctorLogin/edit', 'Api\DoctorLoginController@edit');
    Route::post('doctorLogin/deleteById', 'Api\DoctorLoginController@deleteById');


    //doctorPatientRel
    Route::get('doctorPatientRel/getById', 'Api\DoctorPatientRelController@getById');
    Route::get('doctorPatientRel/getListByCon', 'Api\DoctorPatientRelController@getListByCon');
    Route::post('doctorPatientRel/edit', 'Api\DoctorPatientRelController@edit');
    Route::post('doctorPatientRel/deleteById', 'Api\DoctorPatientRelController@deleteById');


    //doctorPatientRelEasemob
    Route::get('doctorPatientRelEasemob/getById', 'Api\DoctorPatientRelEasemobController@getById');
    Route::get('doctorPatientRelEasemob/getListByCon', 'Api\DoctorPatientRelEasemobController@getListByCon');
    Route::post('doctorPatientRelEasemob/edit', 'Api\DoctorPatientRelEasemobController@edit');
    Route::post('doctorPatientRelEasemob/deleteById', 'Api\DoctorPatientRelEasemobController@deleteById');


    //easemobUser
    Route::get('easemobUser/getById', 'Api\EasemobUserController@getById');
    Route::get('easemobUser/getListByCon', 'Api\EasemobUserController@getListByCon');
    Route::post('easemobUser/edit', 'Api\EasemobUserController@edit');
    Route::post('easemobUser/deleteById', 'Api\EasemobUserController@deleteById');


    //field
    Route::get('field/getById', 'Api\FieldController@getById');
    Route::get('field/getListByCon', 'Api\FieldController@getListByCon');
    Route::post('field/edit', 'Api\FieldController@edit');
    Route::post('field/deleteById', 'Api\FieldController@deleteById');


    //fieldTemplate
    Route::get('fieldTemplate/getById', 'Api\FieldTemplateController@getById');
    Route::get('fieldTemplate/getListByCon', 'Api\FieldTemplateController@getListByCon');
    Route::post('fieldTemplate/edit', 'Api\FieldTemplateController@edit');
    Route::post('fieldTemplate/deleteById', 'Api\FieldTemplateController@deleteById');


    //fieldType
    Route::get('fieldType/getById', 'Api\FieldTypeController@getById');
    Route::get('fieldType/getListByCon', 'Api\FieldTypeController@getListByCon');
    Route::post('fieldType/edit', 'Api\FieldTypeController@edit');
    Route::post('fieldType/deleteById', 'Api\FieldTypeController@deleteById');


    //hospitalDepartment
    Route::get('hospitalDepartment/getById', 'Api\HospitalDepartmentController@getById');
    Route::get('hospitalDepartment/getListByCon', 'Api\HospitalDepartmentController@getListByCon');
    Route::post('hospitalDepartment/edit', 'Api\HospitalDepartmentController@edit');
    Route::post('hospitalDepartment/deleteById', 'Api\HospitalDepartmentController@deleteById');


    //hospital
    Route::get('hospital/getById', 'Api\HospitalController@getById');
    Route::get('hospital/getListByCon', 'Api\HospitalController@getListByCon');
    Route::post('hospital/edit', 'Api\HospitalController@edit');
    Route::post('hospital/deleteById', 'Api\HospitalController@deleteById');


    //materialRecord
    Route::get('materialRecord/getById', 'Api\MaterialRecordController@getById');
    Route::get('materialRecord/getListByCon', 'Api\MaterialRecordController@getListByCon');
    Route::post('materialRecord/edit', 'Api\MaterialRecordController@edit');
    Route::post('materialRecord/deleteById', 'Api\MaterialRecordController@deleteById');


    //nationality
    Route::get('nationality/getById', 'Api\NationalityController@getById');
    Route::get('nationality/getListByCon', 'Api\NationalityController@getListByCon');
    Route::post('nationality/edit', 'Api\NationalityController@edit');
    Route::post('nationality/deleteById', 'Api\NationalityController@deleteById');


    //patientCase
    Route::get('patientCase/getById', 'Api\PatientCaseController@getById');
    Route::get('patientCase/getListByCon', 'Api\PatientCaseController@getListByCon');
    Route::post('patientCase/edit', 'Api\PatientCaseController@edit');
    Route::post('patientCase/deleteById', 'Api\PatientCaseController@deleteById');


    //patientCaseTmplementTask
    Route::get('patientCaseTmplementTask/getById', 'Api\PatientCaseTmplementTaskController@getById');
    Route::get('patientCaseTmplementTask/getListByCon', 'Api\PatientCaseTmplementTaskController@getListByCon');
    Route::post('patientCaseTmplementTask/edit', 'Api\PatientCaseTmplementTaskController@edit');
    Route::post('patientCaseTmplementTask/deleteById', 'Api\PatientCaseTmplementTaskController@deleteById');


    //patient
    Route::get('patient/getById', 'Api\PatientController@getById');
    Route::get('patient/getListByCon', 'Api\PatientController@getListByCon');
    Route::post('patient/edit', 'Api\PatientController@edit');
    Route::post('patient/deleteById', 'Api\PatientController@deleteById');


    //patientInspectInfo
    Route::get('patientInspectInfo/getById', 'Api\PatientInspectInfoController@getById');
    Route::get('patientInspectInfo/getListByCon', 'Api\PatientInspectInfoController@getListByCon');
    Route::post('patientInspectInfo/edit', 'Api\PatientInspectInfoController@edit');
    Route::post('patientInspectInfo/deleteById', 'Api\PatientInspectInfoController@deleteById');


    //patientPlan
    Route::get('patientPlan/getById', 'Api\PatientPlanController@getById');
    Route::get('patientPlan/getListByCon', 'Api\PatientPlanController@getListByCon');
    Route::post('patientPlan/edit', 'Api\PatientPlanController@edit');
    Route::post('patientPlan/deleteById', 'Api\PatientPlanController@deleteById');


    //patientPlanTemplate
    Route::get('patientPlanTemplate/getById', 'Api\PatientPlanTemplateController@getById');
    Route::get('patientPlanTemplate/getListByCon', 'Api\PatientPlanTemplateController@getListByCon');
    Route::post('patientPlanTemplate/edit', 'Api\PatientPlanTemplateController@edit');
    Route::post('patientPlanTemplate/deleteById', 'Api\PatientPlanTemplateController@deleteById');


    //patientPlanTemplateItem
    Route::get('patientPlanTemplateItem/getById', 'Api\PatientPlanTemplateItemController@getById');
    Route::get('patientPlanTemplateItem/getListByCon', 'Api\PatientPlanTemplateItemController@getListByCon');
    Route::post('patientPlanTemplateItem/edit', 'Api\PatientPlanTemplateItemController@edit');
    Route::post('patientPlanTemplateItem/deleteById', 'Api\PatientPlanTemplateItemController@deleteById');


    //patientTw
    Route::get('patientTw/getById', 'Api\PatientTwController@getById');
    Route::get('patientTw/getListByCon', 'Api\PatientTwController@getListByCon');
    Route::post('patientTw/edit', 'Api\PatientTwController@edit');
    Route::post('patientTw/deleteById', 'Api\PatientTwController@deleteById');


    //provinceCity
    Route::get('provinceCity/getById', 'Api\ProvinceCityController@getById');
    Route::get('provinceCity/getListByCon', 'Api\ProvinceCityController@getListByCon');
    Route::post('provinceCity/edit', 'Api\ProvinceCityController@edit');
    Route::post('provinceCity/deleteById', 'Api\ProvinceCityController@deleteById');


    //scaleAnswer
    Route::get('scaleAnswer/getById', 'Api\ScaleAnswerController@getById');
    Route::get('scaleAnswer/getListByCon', 'Api\ScaleAnswerController@getListByCon');
    Route::post('scaleAnswer/edit', 'Api\ScaleAnswerController@edit');
    Route::post('scaleAnswer/deleteById', 'Api\ScaleAnswerController@deleteById');


    //scale
    Route::get('scale/getById', 'Api\ScaleController@getById');
    Route::get('scale/getListByCon', 'Api\ScaleController@getListByCon');
    Route::post('scale/edit', 'Api\ScaleController@edit');
    Route::post('scale/deleteById', 'Api\ScaleController@deleteById');


    //scaleTopic
    Route::get('scaleTopic/getById', 'Api\ScaleTopicController@getById');
    Route::get('scaleTopic/getListByCon', 'Api\ScaleTopicController@getListByCon');
    Route::post('scaleTopic/edit', 'Api\ScaleTopicController@edit');
    Route::post('scaleTopic/deleteById', 'Api\ScaleTopicController@deleteById');


    //vertify
    Route::get('vertify/getById', 'Api\VertifyController@getById');
    Route::get('vertify/getListByCon', 'Api\VertifyController@getListByCon');
    Route::post('vertify/edit', 'Api\VertifyController@edit');
    Route::post('vertify/deleteById', 'Api\VertifyController@deleteById');


