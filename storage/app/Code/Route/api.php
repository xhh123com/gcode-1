<?php


    //admin
    Route::get('admin/getById', 'Api\AdminController@getById');
    Route::get('admin/getListByCon', 'Api\AdminController@getListByCon');

    //adminLogin
    Route::get('adminLogin/getById', 'Api\AdminLoginController@getById');
    Route::get('adminLogin/getListByCon', 'Api\AdminLoginController@getListByCon');

    //assessRecord
    Route::get('assessRecord/getById', 'Api\AssessRecordController@getById');
    Route::get('assessRecord/getListByCon', 'Api\AssessRecordController@getListByCon');

    //city
    Route::get('city/getById', 'Api\CityController@getById');
    Route::get('city/getListByCon', 'Api\CityController@getListByCon');

    //collectionDoctorVideo
    Route::get('collectionDoctorVideo/getById', 'Api\CollectionDoctorVideoController@getById');
    Route::get('collectionDoctorVideo/getListByCon', 'Api\CollectionDoctorVideoController@getListByCon');

    //collectionDoctorVideoLabel
    Route::get('collectionDoctorVideoLabel/getById', 'Api\CollectionDoctorVideoLabelController@getById');
    Route::get('collectionDoctorVideoLabel/getListByCon', 'Api\CollectionDoctorVideoLabelController@getListByCon');

    //collectionPatient
    Route::get('collectionPatient/getById', 'Api\CollectionPatientController@getById');
    Route::get('collectionPatient/getListByCon', 'Api\CollectionPatientController@getListByCon');

    //doctor
    Route::get('doctor/getById', 'Api\DoctorController@getById');
    Route::get('doctor/getListByCon', 'Api\DoctorController@getListByCon');

    //doctorLogin
    Route::get('doctorLogin/getById', 'Api\DoctorLoginController@getById');
    Route::get('doctorLogin/getListByCon', 'Api\DoctorLoginController@getListByCon');

    //doctorPatientRel
    Route::get('doctorPatientRel/getById', 'Api\DoctorPatientRelController@getById');
    Route::get('doctorPatientRel/getListByCon', 'Api\DoctorPatientRelController@getListByCon');

    //doctorPatientRelEasemob
    Route::get('doctorPatientRelEasemob/getById', 'Api\DoctorPatientRelEasemobController@getById');
    Route::get('doctorPatientRelEasemob/getListByCon', 'Api\DoctorPatientRelEasemobController@getListByCon');

    //easemobUser
    Route::get('easemobUser/getById', 'Api\EasemobUserController@getById');
    Route::get('easemobUser/getListByCon', 'Api\EasemobUserController@getListByCon');

    //field
    Route::get('field/getById', 'Api\FieldController@getById');
    Route::get('field/getListByCon', 'Api\FieldController@getListByCon');

    //fieldTemplate
    Route::get('fieldTemplate/getById', 'Api\FieldTemplateController@getById');
    Route::get('fieldTemplate/getListByCon', 'Api\FieldTemplateController@getListByCon');

    //fieldType
    Route::get('fieldType/getById', 'Api\FieldTypeController@getById');
    Route::get('fieldType/getListByCon', 'Api\FieldTypeController@getListByCon');

    //hospitalDepartment
    Route::get('hospitalDepartment/getById', 'Api\HospitalDepartmentController@getById');
    Route::get('hospitalDepartment/getListByCon', 'Api\HospitalDepartmentController@getListByCon');

    //hospital
    Route::get('hospital/getById', 'Api\HospitalController@getById');
    Route::get('hospital/getListByCon', 'Api\HospitalController@getListByCon');

    //materialRecord
    Route::get('materialRecord/getById', 'Api\MaterialRecordController@getById');
    Route::get('materialRecord/getListByCon', 'Api\MaterialRecordController@getListByCon');

    //nationality
    Route::get('nationality/getById', 'Api\NationalityController@getById');
    Route::get('nationality/getListByCon', 'Api\NationalityController@getListByCon');

    //patientCase
    Route::get('patientCase/getById', 'Api\PatientCaseController@getById');
    Route::get('patientCase/getListByCon', 'Api\PatientCaseController@getListByCon');

    //patientCaseTmplementTask
    Route::get('patientCaseTmplementTask/getById', 'Api\PatientCaseTmplementTaskController@getById');
    Route::get('patientCaseTmplementTask/getListByCon', 'Api\PatientCaseTmplementTaskController@getListByCon');

    //patient
    Route::get('patient/getById', 'Api\PatientController@getById');
    Route::get('patient/getListByCon', 'Api\PatientController@getListByCon');

    //patientInspectInfo
    Route::get('patientInspectInfo/getById', 'Api\PatientInspectInfoController@getById');
    Route::get('patientInspectInfo/getListByCon', 'Api\PatientInspectInfoController@getListByCon');

    //patientPlan
    Route::get('patientPlan/getById', 'Api\PatientPlanController@getById');
    Route::get('patientPlan/getListByCon', 'Api\PatientPlanController@getListByCon');

    //patientPlanTemplate
    Route::get('patientPlanTemplate/getById', 'Api\PatientPlanTemplateController@getById');
    Route::get('patientPlanTemplate/getListByCon', 'Api\PatientPlanTemplateController@getListByCon');

    //patientPlanTemplateItem
    Route::get('patientPlanTemplateItem/getById', 'Api\PatientPlanTemplateItemController@getById');
    Route::get('patientPlanTemplateItem/getListByCon', 'Api\PatientPlanTemplateItemController@getListByCon');

    //patientTw
    Route::get('patientTw/getById', 'Api\PatientTwController@getById');
    Route::get('patientTw/getListByCon', 'Api\PatientTwController@getListByCon');

    //provinceCity
    Route::get('provinceCity/getById', 'Api\ProvinceCityController@getById');
    Route::get('provinceCity/getListByCon', 'Api\ProvinceCityController@getListByCon');

    //scaleAnswer
    Route::get('scaleAnswer/getById', 'Api\ScaleAnswerController@getById');
    Route::get('scaleAnswer/getListByCon', 'Api\ScaleAnswerController@getListByCon');

    //scale
    Route::get('scale/getById', 'Api\ScaleController@getById');
    Route::get('scale/getListByCon', 'Api\ScaleController@getListByCon');

    //scaleTopic
    Route::get('scaleTopic/getById', 'Api\ScaleTopicController@getById');
    Route::get('scaleTopic/getListByCon', 'Api\ScaleTopicController@getListByCon');

    //vertify
    Route::get('vertify/getById', 'Api\VertifyController@getById');
    Route::get('vertify/getListByCon', 'Api\VertifyController@getListByCon');

