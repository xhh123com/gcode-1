<?php


/**
* Created by PhpStorm.
* User: mtt17
* Date: 2018/4/9
* Time: 11:32
*/

namespace App\Components;


use App\Components\Common\Utils;
use App\MongoDB\Models\Doc\PatientInspectInfoDoc;
use App\MongoDB\Models\PatientInspectInfo;
use Illuminate\Support\Facades\DB;

//该版本Manager主要支持MongoDB的数据模型
class PatientInspectInfoManager
{


    /*
    * getById
    *
    * By Auto CodeCreator
    *
    * 2020-01-30 11:20:35
    */
    public static function getById($_id)
    {

        $info = PatientInspectInfo::where('_id', $_id)->first();
        return $info;
    }


    /*
    * getByIdWithTrashed
    *
    * By Auto CodeCreator
    *
    * 2020-01-30 11:20:35
    */
    public static function getByIdWithTrashed($_id)
    {
        $info = PatientInspectInfo::withTrashed()->where('_id', $_id)->first();
        return $info;
    }

    /*
    * deleteById
    *
    * By Auto CodeCreator
    *
    * 2020-01-30 11:20:35
    */
    public static function deleteById($id)
    {
        $info = self::getById($id);
        $result = $info->delete();
        return $result;
    }


    /*
    * save
    *
    * By Auto CodeCreator
    *
    * 2020-01-30 11:20:35
    */
    public static function save($info)
    {
        $result = $info->save();
        return $result;
    }


    /*
    * getInfoByLevel
    *
    * By Auto CodeCreator
    *
    * 2020-01-30 11:20:35
    *
    */
    public static function getInfoByLevel($info, $level)
    {
        $level_arr = explode(',', $level);

        $info->id = $info->_id;
        $info->status_str = Utils::COMMON_STATUS_VAL[$info->status];

        //图片转数组，2020-01-19 TerryQi补充了img转数组，img一般定义为图片链接，多张图片用逗号分隔
        if ($info->img) {
            $info->img_arr = explode(",", $info->img);
        }

        //0:
        if (in_array('0', $level_arr)) {

        }
        //1:
        if (in_array('1', $level_arr)) {

        }
        //2:
        if (in_array('2', $level_arr)) {

        }

        //X: 脱敏
        if (strpos($level, 'X') !== false) {

        }
        //Y: 压缩，去掉content_html等大报文信息
        if (strpos($level, 'Y') !== false) {
        unset($info->content_html);
        unset($info->seq);
        unset($info->status);
        unset($info->updated_at);
        unset($info->deleted_at);
        }
        //Z: 预留
        if (strpos($level, 'Z') !== false) {

        }


        return $info;
    }

    /*
    * getListByCon
    *
    * By Auto CodeCreator
    *
    * 2020-01-30 11:20:35
    */
    public static function getListByCon($con_arr, $is_paginate, $page = 1)
    {
        $infos = new PatientInspectInfo();

        if (array_key_exists('search_word', $con_arr) && !Utils::isObjNull($con_arr['search_word'])) {
        $keyword = $con_arr['search_word'];
        $infos = $infos->where(function ($query) use ($keyword) {
            $query->where('name', 'like', "%{$keyword}%");
            });
        }

        if (array_key_exists('_ids_arr', $con_arr) && !empty($con_arr['_ids_arr'])) {
            $infos = $infos->wherein('_id', $con_arr['_ids_arr']);
        }


        if (array_key_exists('_id', $con_arr) && !Utils::isObjNull($con_arr['_id'])) {
            $infos = $infos->where('_id', '=', $con_arr['_id']);
        }

    
        if (array_key_exists('collection_name', $con_arr) && !Utils::isObjNull($con_arr['collection_name'])) {
        $infos = $infos->where('collection_name', '=', $con_arr['collection_name']);
        }
    
        if (array_key_exists('patient_id', $con_arr) && !Utils::isObjNull($con_arr['patient_id'])) {
        $infos = $infos->where('patient_id', '=', $con_arr['patient_id']);
        }
    
        if (array_key_exists('doctor_id', $con_arr) && !Utils::isObjNull($con_arr['doctor_id'])) {
        $infos = $infos->where('doctor_id', '=', $con_arr['doctor_id']);
        }
    
        if (array_key_exists('num', $con_arr) && !Utils::isObjNull($con_arr['num'])) {
        $infos = $infos->where('num', '=', $con_arr['num']);
        }
    
        if (array_key_exists('field_ids', $con_arr) && !Utils::isObjNull($con_arr['field_ids'])) {
        $infos = $infos->where('field_ids', '=', $con_arr['field_ids']);
        }
    
        if (array_key_exists('patient_plan_time', $con_arr) && !Utils::isObjNull($con_arr['patient_plan_time'])) {
        $infos = $infos->where('patient_plan_time', '=', $con_arr['patient_plan_time']);
        }
    
        if (array_key_exists('medical_record_number', $con_arr) && !Utils::isObjNull($con_arr['medical_record_number'])) {
        $infos = $infos->where('medical_record_number', '=', $con_arr['medical_record_number']);
        }
    
        if (array_key_exists('nearly_half_year_hospitalization_describe', $con_arr) && !Utils::isObjNull($con_arr['nearly_half_year_hospitalization_describe'])) {
        $infos = $infos->where('nearly_half_year_hospitalization_describe', '=', $con_arr['nearly_half_year_hospitalization_describe']);
        }
    
        if (array_key_exists('nearly_half_year_hospitalization_num', $con_arr) && !Utils::isObjNull($con_arr['nearly_half_year_hospitalization_num'])) {
        $infos = $infos->where('nearly_half_year_hospitalization_num', '=', $con_arr['nearly_half_year_hospitalization_num']);
        }
    
        if (array_key_exists('platelet_num', $con_arr) && !Utils::isObjNull($con_arr['platelet_num'])) {
        $infos = $infos->where('platelet_num', '=', $con_arr['platelet_num']);
        }
    
        if (array_key_exists('platelet_num_unit', $con_arr) && !Utils::isObjNull($con_arr['platelet_num_unit'])) {
        $infos = $infos->where('platelet_num_unit', '=', $con_arr['platelet_num_unit']);
        }
    
        if (array_key_exists('urine_protein_quantification', $con_arr) && !Utils::isObjNull($con_arr['urine_protein_quantification'])) {
        $infos = $infos->where('urine_protein_quantification', '=', $con_arr['urine_protein_quantification']);
        }
    
        if (array_key_exists('urine_protein_quantification_unit', $con_arr) && !Utils::isObjNull($con_arr['urine_protein_quantification_unit'])) {
        $infos = $infos->where('urine_protein_quantification_unit', '=', $con_arr['urine_protein_quantification_unit']);
        }
    
        if (array_key_exists('plasma_prothrombin_time', $con_arr) && !Utils::isObjNull($con_arr['plasma_prothrombin_time'])) {
        $infos = $infos->where('plasma_prothrombin_time', '=', $con_arr['plasma_prothrombin_time']);
        }
    
        if (array_key_exists('plasma_prothrombin_time_unit', $con_arr) && !Utils::isObjNull($con_arr['plasma_prothrombin_time_unit'])) {
        $infos = $infos->where('plasma_prothrombin_time_unit', '=', $con_arr['plasma_prothrombin_time_unit']);
        }
    
        if (array_key_exists('prothrombin_international_normalized_ratio', $con_arr) && !Utils::isObjNull($con_arr['prothrombin_international_normalized_ratio'])) {
        $infos = $infos->where('prothrombin_international_normalized_ratio', '=', $con_arr['prothrombin_international_normalized_ratio']);
        }
    
        if (array_key_exists('activated_partial_thromboplastin_time', $con_arr) && !Utils::isObjNull($con_arr['activated_partial_thromboplastin_time'])) {
        $infos = $infos->where('activated_partial_thromboplastin_time', '=', $con_arr['activated_partial_thromboplastin_time']);
        }
    
        if (array_key_exists('activated_partial_thromboplastin_time_unit', $con_arr) && !Utils::isObjNull($con_arr['activated_partial_thromboplastin_time_unit'])) {
        $infos = $infos->where('activated_partial_thromboplastin_time_unit', '=', $con_arr['activated_partial_thromboplastin_time_unit']);
        }
    
        if (array_key_exists('thrombin_time', $con_arr) && !Utils::isObjNull($con_arr['thrombin_time'])) {
        $infos = $infos->where('thrombin_time', '=', $con_arr['thrombin_time']);
        }
    
        if (array_key_exists('thrombin_time_unit', $con_arr) && !Utils::isObjNull($con_arr['thrombin_time_unit'])) {
        $infos = $infos->where('thrombin_time_unit', '=', $con_arr['thrombin_time_unit']);
        }
    
        if (array_key_exists('fibrinogen', $con_arr) && !Utils::isObjNull($con_arr['fibrinogen'])) {
        $infos = $infos->where('fibrinogen', '=', $con_arr['fibrinogen']);
        }
    
        if (array_key_exists('fibrinogen_unit', $con_arr) && !Utils::isObjNull($con_arr['fibrinogen_unit'])) {
        $infos = $infos->where('fibrinogen_unit', '=', $con_arr['fibrinogen_unit']);
        }
    
        if (array_key_exists('blood_coagulation_time', $con_arr) && !Utils::isObjNull($con_arr['blood_coagulation_time'])) {
        $infos = $infos->where('blood_coagulation_time', '=', $con_arr['blood_coagulation_time']);
        }
    
        if (array_key_exists('blood_coagulation_time_unit', $con_arr) && !Utils::isObjNull($con_arr['blood_coagulation_time_unit'])) {
        $infos = $infos->where('blood_coagulation_time_unit', '=', $con_arr['blood_coagulation_time_unit']);
        }
    
        if (array_key_exists('prothrombin_time_activity', $con_arr) && !Utils::isObjNull($con_arr['prothrombin_time_activity'])) {
        $infos = $infos->where('prothrombin_time_activity', '=', $con_arr['prothrombin_time_activity']);
        }
    
        if (array_key_exists('prothrombin_time_activity_unit', $con_arr) && !Utils::isObjNull($con_arr['prothrombin_time_activity_unit'])) {
        $infos = $infos->where('prothrombin_time_activity_unit', '=', $con_arr['prothrombin_time_activity_unit']);
        }
    
        if (array_key_exists('d_dimer', $con_arr) && !Utils::isObjNull($con_arr['d_dimer'])) {
        $infos = $infos->where('d_dimer', '=', $con_arr['d_dimer']);
        }
    
        if (array_key_exists('d_dimer_unit', $con_arr) && !Utils::isObjNull($con_arr['d_dimer_unit'])) {
        $infos = $infos->where('d_dimer_unit', '=', $con_arr['d_dimer_unit']);
        }
    
        if (array_key_exists('fibrinogen_degradation_products', $con_arr) && !Utils::isObjNull($con_arr['fibrinogen_degradation_products'])) {
        $infos = $infos->where('fibrinogen_degradation_products', '=', $con_arr['fibrinogen_degradation_products']);
        }
    
        if (array_key_exists('fibrinogen_degradation_products_unit', $con_arr) && !Utils::isObjNull($con_arr['fibrinogen_degradation_products_unit'])) {
        $infos = $infos->where('fibrinogen_degradation_products_unit', '=', $con_arr['fibrinogen_degradation_products_unit']);
        }
    
        if (array_key_exists('antithrombin_activity', $con_arr) && !Utils::isObjNull($con_arr['antithrombin_activity'])) {
        $infos = $infos->where('antithrombin_activity', '=', $con_arr['antithrombin_activity']);
        }
    
        if (array_key_exists('antithrombin_activity_unit', $con_arr) && !Utils::isObjNull($con_arr['antithrombin_activity_unit'])) {
        $infos = $infos->where('antithrombin_activity_unit', '=', $con_arr['antithrombin_activity_unit']);
        }
    
        if (array_key_exists('serum_cholesterol_concentration', $con_arr) && !Utils::isObjNull($con_arr['serum_cholesterol_concentration'])) {
        $infos = $infos->where('serum_cholesterol_concentration', '=', $con_arr['serum_cholesterol_concentration']);
        }
    
        if (array_key_exists('serum_cholesterol_concentration_unit', $con_arr) && !Utils::isObjNull($con_arr['serum_cholesterol_concentration_unit'])) {
        $infos = $infos->where('serum_cholesterol_concentration_unit', '=', $con_arr['serum_cholesterol_concentration_unit']);
        }
    
        if (array_key_exists('serum_bicarbonate_concentration', $con_arr) && !Utils::isObjNull($con_arr['serum_bicarbonate_concentration'])) {
        $infos = $infos->where('serum_bicarbonate_concentration', '=', $con_arr['serum_bicarbonate_concentration']);
        }
    
        if (array_key_exists('serum_bicarbonate_concentration_unit', $con_arr) && !Utils::isObjNull($con_arr['serum_bicarbonate_concentration_unit'])) {
        $infos = $infos->where('serum_bicarbonate_concentration_unit', '=', $con_arr['serum_bicarbonate_concentration_unit']);
        }
    
        if (array_key_exists('cerebrospinal_fluid', $con_arr) && !Utils::isObjNull($con_arr['cerebrospinal_fluid'])) {
        $infos = $infos->where('cerebrospinal_fluid', '=', $con_arr['cerebrospinal_fluid']);
        }
    
        if (array_key_exists('cerebrospinal_fluid_unit', $con_arr) && !Utils::isObjNull($con_arr['cerebrospinal_fluid_unit'])) {
        $infos = $infos->where('cerebrospinal_fluid_unit', '=', $con_arr['cerebrospinal_fluid_unit']);
        }
    
        if (array_key_exists('cmap', $con_arr) && !Utils::isObjNull($con_arr['cmap'])) {
        $infos = $infos->where('cmap', '=', $con_arr['cmap']);
        }
    
        if (array_key_exists('emg_result', $con_arr) && !Utils::isObjNull($con_arr['emg_result'])) {
        $infos = $infos->where('emg_result', '=', $con_arr['emg_result']);
        }
    
        if (array_key_exists('oblongata_result', $con_arr) && !Utils::isObjNull($con_arr['oblongata_result'])) {
        $infos = $infos->where('oblongata_result', '=', $con_arr['oblongata_result']);
        }
    
        if (array_key_exists('is_rehabilitation_therapy', $con_arr) && !Utils::isObjNull($con_arr['is_rehabilitation_therapy'])) {
        $infos = $infos->where('is_rehabilitation_therapy', '=', $con_arr['is_rehabilitation_therapy']);
        }
    
        if (array_key_exists('rehabilitation_therapy_plan', $con_arr) && !Utils::isObjNull($con_arr['rehabilitation_therapy_plan'])) {
        $infos = $infos->where('rehabilitation_therapy_plan', '=', $con_arr['rehabilitation_therapy_plan']);
        }
    
        if (array_key_exists('is_accessories_orthotics', $con_arr) && !Utils::isObjNull($con_arr['is_accessories_orthotics'])) {
        $infos = $infos->where('is_accessories_orthotics', '=', $con_arr['is_accessories_orthotics']);
        }
    
        if (array_key_exists('rehabilitation_medical_institutions_name', $con_arr) && !Utils::isObjNull($con_arr['rehabilitation_medical_institutions_name'])) {
        $infos = $infos->where('rehabilitation_medical_institutions_name', '=', $con_arr['rehabilitation_medical_institutions_name']);
        }
    
        if (array_key_exists('rehabilitation_therapy_frequency', $con_arr) && !Utils::isObjNull($con_arr['rehabilitation_therapy_frequency'])) {
        $infos = $infos->where('rehabilitation_therapy_frequency', '=', $con_arr['rehabilitation_therapy_frequency']);
        }
    
        if (array_key_exists('one_therapy_duration', $con_arr) && !Utils::isObjNull($con_arr['one_therapy_duration'])) {
        $infos = $infos->where('one_therapy_duration', '=', $con_arr['one_therapy_duration']);
        }
    
        if (array_key_exists('tidal_volume', $con_arr) && !Utils::isObjNull($con_arr['tidal_volume'])) {
        $infos = $infos->where('tidal_volume', '=', $con_arr['tidal_volume']);
        }
    
        if (array_key_exists('tidal_volume_unit', $con_arr) && !Utils::isObjNull($con_arr['tidal_volume_unit'])) {
        $infos = $infos->where('tidal_volume_unit', '=', $con_arr['tidal_volume_unit']);
        }
    
        if (array_key_exists('expiratory_volume', $con_arr) && !Utils::isObjNull($con_arr['expiratory_volume'])) {
        $infos = $infos->where('expiratory_volume', '=', $con_arr['expiratory_volume']);
        }
    
        if (array_key_exists('expiratory_volume_unit', $con_arr) && !Utils::isObjNull($con_arr['expiratory_volume_unit'])) {
        $infos = $infos->where('expiratory_volume_unit', '=', $con_arr['expiratory_volume_unit']);
        }
    
        if (array_key_exists('inspiratory_volume', $con_arr) && !Utils::isObjNull($con_arr['inspiratory_volume'])) {
        $infos = $infos->where('inspiratory_volume', '=', $con_arr['inspiratory_volume']);
        }
    
        if (array_key_exists('inspiratory_volume_unit', $con_arr) && !Utils::isObjNull($con_arr['inspiratory_volume_unit'])) {
        $infos = $infos->where('inspiratory_volume_unit', '=', $con_arr['inspiratory_volume_unit']);
        }
    
        if (array_key_exists('deep_inspiratory_capacity', $con_arr) && !Utils::isObjNull($con_arr['deep_inspiratory_capacity'])) {
        $infos = $infos->where('deep_inspiratory_capacity', '=', $con_arr['deep_inspiratory_capacity']);
        }
    
        if (array_key_exists('deep_inspiratory_capacity_unit', $con_arr) && !Utils::isObjNull($con_arr['deep_inspiratory_capacity_unit'])) {
        $infos = $infos->where('deep_inspiratory_capacity_unit', '=', $con_arr['deep_inspiratory_capacity_unit']);
        }
    
        if (array_key_exists('vital_capacity', $con_arr) && !Utils::isObjNull($con_arr['vital_capacity'])) {
        $infos = $infos->where('vital_capacity', '=', $con_arr['vital_capacity']);
        }
    
        if (array_key_exists('vital_capacity_unit', $con_arr) && !Utils::isObjNull($con_arr['vital_capacity_unit'])) {
        $infos = $infos->where('vital_capacity_unit', '=', $con_arr['vital_capacity_unit']);
        }
    
        if (array_key_exists('functional_residual_volume', $con_arr) && !Utils::isObjNull($con_arr['functional_residual_volume'])) {
        $infos = $infos->where('functional_residual_volume', '=', $con_arr['functional_residual_volume']);
        }
    
        if (array_key_exists('functional_residual_volume_unit', $con_arr) && !Utils::isObjNull($con_arr['functional_residual_volume_unit'])) {
        $infos = $infos->where('functional_residual_volume_unit', '=', $con_arr['functional_residual_volume_unit']);
        }
    
        if (array_key_exists('residual_volume', $con_arr) && !Utils::isObjNull($con_arr['residual_volume'])) {
        $infos = $infos->where('residual_volume', '=', $con_arr['residual_volume']);
        }
    
        if (array_key_exists('residual_volume_unit', $con_arr) && !Utils::isObjNull($con_arr['residual_volume_unit'])) {
        $infos = $infos->where('residual_volume_unit', '=', $con_arr['residual_volume_unit']);
        }
    
        if (array_key_exists('total_lung_volume', $con_arr) && !Utils::isObjNull($con_arr['total_lung_volume'])) {
        $infos = $infos->where('total_lung_volume', '=', $con_arr['total_lung_volume']);
        }
    
        if (array_key_exists('total_lung_volume_unit', $con_arr) && !Utils::isObjNull($con_arr['total_lung_volume_unit'])) {
        $infos = $infos->where('total_lung_volume_unit', '=', $con_arr['total_lung_volume_unit']);
        }
    
        if (array_key_exists('respiratory_frequency', $con_arr) && !Utils::isObjNull($con_arr['respiratory_frequency'])) {
        $infos = $infos->where('respiratory_frequency', '=', $con_arr['respiratory_frequency']);
        }
    
        if (array_key_exists('respiratory_frequency_unit', $con_arr) && !Utils::isObjNull($con_arr['respiratory_frequency_unit'])) {
        $infos = $infos->where('respiratory_frequency_unit', '=', $con_arr['respiratory_frequency_unit']);
        }
    
        if (array_key_exists('dead_space_gas_volume', $con_arr) && !Utils::isObjNull($con_arr['dead_space_gas_volume'])) {
        $infos = $infos->where('dead_space_gas_volume', '=', $con_arr['dead_space_gas_volume']);
        }
    
        if (array_key_exists('dead_space_gas_volume_unit', $con_arr) && !Utils::isObjNull($con_arr['dead_space_gas_volume_unit'])) {
        $infos = $infos->where('dead_space_gas_volume_unit', '=', $con_arr['dead_space_gas_volume_unit']);
        }
    
        if (array_key_exists('alveolar_ventilation', $con_arr) && !Utils::isObjNull($con_arr['alveolar_ventilation'])) {
        $infos = $infos->where('alveolar_ventilation', '=', $con_arr['alveolar_ventilation']);
        }
    
        if (array_key_exists('alveolar_ventilation_unit', $con_arr) && !Utils::isObjNull($con_arr['alveolar_ventilation_unit'])) {
        $infos = $infos->where('alveolar_ventilation_unit', '=', $con_arr['alveolar_ventilation_unit']);
        }
    
        if (array_key_exists('minute_ventilation', $con_arr) && !Utils::isObjNull($con_arr['minute_ventilation'])) {
        $infos = $infos->where('minute_ventilation', '=', $con_arr['minute_ventilation']);
        }
    
        if (array_key_exists('minute_ventilation_unit', $con_arr) && !Utils::isObjNull($con_arr['minute_ventilation_unit'])) {
        $infos = $infos->where('minute_ventilation_unit', '=', $con_arr['minute_ventilation_unit']);
        }
    
        if (array_key_exists('minute_ventilation_max', $con_arr) && !Utils::isObjNull($con_arr['minute_ventilation_max'])) {
        $infos = $infos->where('minute_ventilation_max', '=', $con_arr['minute_ventilation_max']);
        }
    
        if (array_key_exists('minute_ventilation_max_unit', $con_arr) && !Utils::isObjNull($con_arr['minute_ventilation_max_unit'])) {
        $infos = $infos->where('minute_ventilation_max_unit', '=', $con_arr['minute_ventilation_max_unit']);
        }
    
        if (array_key_exists('ventilation_reserve', $con_arr) && !Utils::isObjNull($con_arr['ventilation_reserve'])) {
        $infos = $infos->where('ventilation_reserve', '=', $con_arr['ventilation_reserve']);
        }
    
        if (array_key_exists('ventilation_reserve_unit', $con_arr) && !Utils::isObjNull($con_arr['ventilation_reserve_unit'])) {
        $infos = $infos->where('ventilation_reserve_unit', '=', $con_arr['ventilation_reserve_unit']);
        }
    
        if (array_key_exists('forced_vital_capacity', $con_arr) && !Utils::isObjNull($con_arr['forced_vital_capacity'])) {
        $infos = $infos->where('forced_vital_capacity', '=', $con_arr['forced_vital_capacity']);
        }
    
        if (array_key_exists('forced_vital_capacity_unit', $con_arr) && !Utils::isObjNull($con_arr['forced_vital_capacity_unit'])) {
        $infos = $infos->where('forced_vital_capacity_unit', '=', $con_arr['forced_vital_capacity_unit']);
        }
    
        if (array_key_exists('one_second_forced_expiratory_volume', $con_arr) && !Utils::isObjNull($con_arr['one_second_forced_expiratory_volume'])) {
        $infos = $infos->where('one_second_forced_expiratory_volume', '=', $con_arr['one_second_forced_expiratory_volume']);
        }
    
        if (array_key_exists('one_second_forced_expiratory_volume_unit', $con_arr) && !Utils::isObjNull($con_arr['one_second_forced_expiratory_volume_unit'])) {
        $infos = $infos->where('one_second_forced_expiratory_volume_unit', '=', $con_arr['one_second_forced_expiratory_volume_unit']);
        }
    
        if (array_key_exists('one_second_rate', $con_arr) && !Utils::isObjNull($con_arr['one_second_rate'])) {
        $infos = $infos->where('one_second_rate', '=', $con_arr['one_second_rate']);
        }
    
        if (array_key_exists('one_second_rate_unit', $con_arr) && !Utils::isObjNull($con_arr['one_second_rate_unit'])) {
        $infos = $infos->where('one_second_rate_unit', '=', $con_arr['one_second_rate_unit']);
        }
    
        if (array_key_exists('maximum_midexpiratory_flow', $con_arr) && !Utils::isObjNull($con_arr['maximum_midexpiratory_flow'])) {
        $infos = $infos->where('maximum_midexpiratory_flow', '=', $con_arr['maximum_midexpiratory_flow']);
        }
    
        if (array_key_exists('maximum_midexpiratory_flow_unit', $con_arr) && !Utils::isObjNull($con_arr['maximum_midexpiratory_flow_unit'])) {
        $infos = $infos->where('maximum_midexpiratory_flow_unit', '=', $con_arr['maximum_midexpiratory_flow_unit']);
        }
    
        if (array_key_exists('middle_expiratory_instantaneous_velocity', $con_arr) && !Utils::isObjNull($con_arr['middle_expiratory_instantaneous_velocity'])) {
        $infos = $infos->where('middle_expiratory_instantaneous_velocity', '=', $con_arr['middle_expiratory_instantaneous_velocity']);
        }
    
        if (array_key_exists('middle_expiratory_instantaneous_velocity_unit', $con_arr) && !Utils::isObjNull($con_arr['middle_expiratory_instantaneous_velocity_unit'])) {
        $infos = $infos->where('middle_expiratory_instantaneous_velocity_unit', '=', $con_arr['middle_expiratory_instantaneous_velocity_unit']);
        }
    
        if (array_key_exists('behind_expiratory_instantaneous_velocity', $con_arr) && !Utils::isObjNull($con_arr['behind_expiratory_instantaneous_velocity'])) {
        $infos = $infos->where('behind_expiratory_instantaneous_velocity', '=', $con_arr['behind_expiratory_instantaneous_velocity']);
        }
    
        if (array_key_exists('behind_expiratory_instantaneous_velocity_unit', $con_arr) && !Utils::isObjNull($con_arr['behind_expiratory_instantaneous_velocity_unit'])) {
        $infos = $infos->where('behind_expiratory_instantaneous_velocity_unit', '=', $con_arr['behind_expiratory_instantaneous_velocity_unit']);
        }
    
        if (array_key_exists('peak_expiratory_flow', $con_arr) && !Utils::isObjNull($con_arr['peak_expiratory_flow'])) {
        $infos = $infos->where('peak_expiratory_flow', '=', $con_arr['peak_expiratory_flow']);
        }
    
        if (array_key_exists('peak_expiratory_flow_unit', $con_arr) && !Utils::isObjNull($con_arr['peak_expiratory_flow_unit'])) {
        $infos = $infos->where('peak_expiratory_flow_unit', '=', $con_arr['peak_expiratory_flow_unit']);
        }
    
        if (array_key_exists('peak_expiratory_flow_rate', $con_arr) && !Utils::isObjNull($con_arr['peak_expiratory_flow_rate'])) {
        $infos = $infos->where('peak_expiratory_flow_rate', '=', $con_arr['peak_expiratory_flow_rate']);
        }
    
        if (array_key_exists('peak_expiratory_flow_rate_unit', $con_arr) && !Utils::isObjNull($con_arr['peak_expiratory_flow_rate_unit'])) {
        $infos = $infos->where('peak_expiratory_flow_rate_unit', '=', $con_arr['peak_expiratory_flow_rate_unit']);
        }
    
        if (array_key_exists('earned_value', $con_arr) && !Utils::isObjNull($con_arr['earned_value'])) {
        $infos = $infos->where('earned_value', '=', $con_arr['earned_value']);
        }
    
        if (array_key_exists('earned_value_unit', $con_arr) && !Utils::isObjNull($con_arr['earned_value_unit'])) {
        $infos = $infos->where('earned_value_unit', '=', $con_arr['earned_value_unit']);
        }
    
        if (array_key_exists('lung_carbon_monoxide_diffusing_capacity', $con_arr) && !Utils::isObjNull($con_arr['lung_carbon_monoxide_diffusing_capacity'])) {
        $infos = $infos->where('lung_carbon_monoxide_diffusing_capacity', '=', $con_arr['lung_carbon_monoxide_diffusing_capacity']);
        }
    
        if (array_key_exists('lung_carbon_monoxide_diffusing_capacity_unit', $con_arr) && !Utils::isObjNull($con_arr['lung_carbon_monoxide_diffusing_capacity_unit'])) {
        $infos = $infos->where('lung_carbon_monoxide_diffusing_capacity_unit', '=', $con_arr['lung_carbon_monoxide_diffusing_capacity_unit']);
        }
    
        if (array_key_exists('airway_resistance', $con_arr) && !Utils::isObjNull($con_arr['airway_resistance'])) {
        $infos = $infos->where('airway_resistance', '=', $con_arr['airway_resistance']);
        }
    
        if (array_key_exists('airway_resistance_unit', $con_arr) && !Utils::isObjNull($con_arr['airway_resistance_unit'])) {
        $infos = $infos->where('airway_resistance_unit', '=', $con_arr['airway_resistance_unit']);
        }
    
        if (array_key_exists('airway_conductivity', $con_arr) && !Utils::isObjNull($con_arr['airway_conductivity'])) {
        $infos = $infos->where('airway_conductivity', '=', $con_arr['airway_conductivity']);
        }
    
        if (array_key_exists('airway_conductivity_unit', $con_arr) && !Utils::isObjNull($con_arr['airway_conductivity_unit'])) {
        $infos = $infos->where('airway_conductivity_unit', '=', $con_arr['airway_conductivity_unit']);
        }
    
        if (array_key_exists('than_airway_conductivity', $con_arr) && !Utils::isObjNull($con_arr['than_airway_conductivity'])) {
        $infos = $infos->where('than_airway_conductivity', '=', $con_arr['than_airway_conductivity']);
        }
    
        if (array_key_exists('than_airway_conductivity_unit', $con_arr) && !Utils::isObjNull($con_arr['than_airway_conductivity_unit'])) {
        $infos = $infos->where('than_airway_conductivity_unit', '=', $con_arr['than_airway_conductivity_unit']);
        }
    
        if (array_key_exists('than_airway_resistance', $con_arr) && !Utils::isObjNull($con_arr['than_airway_resistance'])) {
        $infos = $infos->where('than_airway_resistance', '=', $con_arr['than_airway_resistance']);
        }
    
        if (array_key_exists('than_airway_resistance_unit', $con_arr) && !Utils::isObjNull($con_arr['than_airway_resistance_unit'])) {
        $infos = $infos->where('than_airway_resistance_unit', '=', $con_arr['than_airway_resistance_unit']);
        }
    
        if (array_key_exists('intrathoracic_gas_volume', $con_arr) && !Utils::isObjNull($con_arr['intrathoracic_gas_volume'])) {
        $infos = $infos->where('intrathoracic_gas_volume', '=', $con_arr['intrathoracic_gas_volume']);
        }
    
        if (array_key_exists('intrathoracic_gas_volume_unit', $con_arr) && !Utils::isObjNull($con_arr['intrathoracic_gas_volume_unit'])) {
        $infos = $infos->where('intrathoracic_gas_volume_unit', '=', $con_arr['intrathoracic_gas_volume_unit']);
        }
    
        if (array_key_exists('is_medication', $con_arr) && !Utils::isObjNull($con_arr['is_medication'])) {
        $infos = $infos->where('is_medication', '=', $con_arr['is_medication']);
        }
    
        if (array_key_exists('medication_name', $con_arr) && !Utils::isObjNull($con_arr['medication_name'])) {
        $infos = $infos->where('medication_name', '=', $con_arr['medication_name']);
        }
    
        if (array_key_exists('actual_medication_time', $con_arr) && !Utils::isObjNull($con_arr['actual_medication_time'])) {
        $infos = $infos->where('actual_medication_time', '=', $con_arr['actual_medication_time']);
        }
    
        if (array_key_exists('actual_medication_dose', $con_arr) && !Utils::isObjNull($con_arr['actual_medication_dose'])) {
        $infos = $infos->where('actual_medication_dose', '=', $con_arr['actual_medication_dose']);
        }
    
        if (array_key_exists('usage_description', $con_arr) && !Utils::isObjNull($con_arr['usage_description'])) {
        $infos = $infos->where('usage_description', '=', $con_arr['usage_description']);
        }
    
        if (array_key_exists('is_side_effects', $con_arr) && !Utils::isObjNull($con_arr['is_side_effects'])) {
        $infos = $infos->where('is_side_effects', '=', $con_arr['is_side_effects']);
        }
    
        if (array_key_exists('side_effects_type', $con_arr) && !Utils::isObjNull($con_arr['side_effects_type'])) {
        $infos = $infos->where('side_effects_type', '=', $con_arr['side_effects_type']);
        }
    
        if (array_key_exists('side_effects_degree', $con_arr) && !Utils::isObjNull($con_arr['side_effects_degree'])) {
        $infos = $infos->where('side_effects_degree', '=', $con_arr['side_effects_degree']);
        }
    
        if (array_key_exists('is_body_deformation', $con_arr) && !Utils::isObjNull($con_arr['is_body_deformation'])) {
        $infos = $infos->where('is_body_deformation', '=', $con_arr['is_body_deformation']);
        }
    
        if (array_key_exists('is_joint_deformity', $con_arr) && !Utils::isObjNull($con_arr['is_joint_deformity'])) {
        $infos = $infos->where('is_joint_deformity', '=', $con_arr['is_joint_deformity']);
        }
    
        if (array_key_exists('joint_deformity_type', $con_arr) && !Utils::isObjNull($con_arr['joint_deformity_type'])) {
        $infos = $infos->where('joint_deformity_type', '=', $con_arr['joint_deformity_type']);
        }
    
        if (array_key_exists('is_joint_contracture', $con_arr) && !Utils::isObjNull($con_arr['is_joint_contracture'])) {
        $infos = $infos->where('is_joint_contracture', '=', $con_arr['is_joint_contracture']);
        }
    
        if (array_key_exists('chest_is_deformation', $con_arr) && !Utils::isObjNull($con_arr['chest_is_deformation'])) {
        $infos = $infos->where('chest_is_deformation', '=', $con_arr['chest_is_deformation']);
        }
    
        if (array_key_exists('chest_deformation_result', $con_arr) && !Utils::isObjNull($con_arr['chest_deformation_result'])) {
        $infos = $infos->where('chest_deformation_result', '=', $con_arr['chest_deformation_result']);
        }
    
        if (array_key_exists('is_scoliosis', $con_arr) && !Utils::isObjNull($con_arr['is_scoliosis'])) {
        $infos = $infos->where('is_scoliosis', '=', $con_arr['is_scoliosis']);
        }
    
        if (array_key_exists('scoliosis_angle', $con_arr) && !Utils::isObjNull($con_arr['scoliosis_angle'])) {
        $infos = $infos->where('scoliosis_angle', '=', $con_arr['scoliosis_angle']);
        }
    
        if (array_key_exists('is_kyphosis', $con_arr) && !Utils::isObjNull($con_arr['is_kyphosis'])) {
        $infos = $infos->where('is_kyphosis', '=', $con_arr['is_kyphosis']);
        }
    
        if (array_key_exists('bone_density_t_value', $con_arr) && !Utils::isObjNull($con_arr['bone_density_t_value'])) {
        $infos = $infos->where('bone_density_t_value', '=', $con_arr['bone_density_t_value']);
        }
    
        if (array_key_exists('is_sleep_monitoring', $con_arr) && !Utils::isObjNull($con_arr['is_sleep_monitoring'])) {
        $infos = $infos->where('is_sleep_monitoring', '=', $con_arr['is_sleep_monitoring']);
        }
    
        if (array_key_exists('sleep_monitoring_result', $con_arr) && !Utils::isObjNull($con_arr['sleep_monitoring_result'])) {
        $infos = $infos->where('sleep_monitoring_result', '=', $con_arr['sleep_monitoring_result']);
        }
    
        if (array_key_exists('nearly_half_year_is_dyspnea', $con_arr) && !Utils::isObjNull($con_arr['nearly_half_year_is_dyspnea'])) {
        $infos = $infos->where('nearly_half_year_is_dyspnea', '=', $con_arr['nearly_half_year_is_dyspnea']);
        }
    
        if (array_key_exists('breathing_is_auxiliary_equipment', $con_arr) && !Utils::isObjNull($con_arr['breathing_is_auxiliary_equipment'])) {
        $infos = $infos->where('breathing_is_auxiliary_equipment', '=', $con_arr['breathing_is_auxiliary_equipment']);
        }
    
        if (array_key_exists('auxiliary_equipment_type', $con_arr) && !Utils::isObjNull($con_arr['auxiliary_equipment_type'])) {
        $infos = $infos->where('auxiliary_equipment_type', '=', $con_arr['auxiliary_equipment_type']);
        }
    
        if (array_key_exists('is_need_respiratory_support', $con_arr) && !Utils::isObjNull($con_arr['is_need_respiratory_support'])) {
        $infos = $infos->where('is_need_respiratory_support', '=', $con_arr['is_need_respiratory_support']);
        }
    
        if (array_key_exists('respiratory_support_time', $con_arr) && !Utils::isObjNull($con_arr['respiratory_support_time'])) {
        $infos = $infos->where('respiratory_support_time', '=', $con_arr['respiratory_support_time']);
        }
    
        if (array_key_exists('coughing_peak_velocity_inspect_result', $con_arr) && !Utils::isObjNull($con_arr['coughing_peak_velocity_inspect_result'])) {
        $infos = $infos->where('coughing_peak_velocity_inspect_result', '=', $con_arr['coughing_peak_velocity_inspect_result']);
        }
    
        if (array_key_exists('coughing_peak_velocity_inspect_unit', $con_arr) && !Utils::isObjNull($con_arr['coughing_peak_velocity_inspect_unit'])) {
        $infos = $infos->where('coughing_peak_velocity_inspect_unit', '=', $con_arr['coughing_peak_velocity_inspect_unit']);
        }
    
        if (array_key_exists('blood_oxygen_saturation', $con_arr) && !Utils::isObjNull($con_arr['blood_oxygen_saturation'])) {
        $infos = $infos->where('blood_oxygen_saturation', '=', $con_arr['blood_oxygen_saturation']);
        }
    
        if (array_key_exists('blood_oxygen_saturation_unit', $con_arr) && !Utils::isObjNull($con_arr['blood_oxygen_saturation_unit'])) {
        $infos = $infos->where('blood_oxygen_saturation_unit', '=', $con_arr['blood_oxygen_saturation_unit']);
        }
    
        if (array_key_exists('end_breath_co2_concentration', $con_arr) && !Utils::isObjNull($con_arr['end_breath_co2_concentration'])) {
        $infos = $infos->where('end_breath_co2_concentration', '=', $con_arr['end_breath_co2_concentration']);
        }
    
        if (array_key_exists('end_breath_co2_concentration_unit', $con_arr) && !Utils::isObjNull($con_arr['end_breath_co2_concentration_unit'])) {
        $infos = $infos->where('end_breath_co2_concentration_unit', '=', $con_arr['end_breath_co2_concentration_unit']);
        }
    
        if (array_key_exists('vitamin_d3', $con_arr) && !Utils::isObjNull($con_arr['vitamin_d3'])) {
        $infos = $infos->where('vitamin_d3', '=', $con_arr['vitamin_d3']);
        }
    
        if (array_key_exists('trace_element_result', $con_arr) && !Utils::isObjNull($con_arr['trace_element_result'])) {
        $infos = $infos->where('trace_element_result', '=', $con_arr['trace_element_result']);
        }
    
        if (array_key_exists('age_height_score', $con_arr) && !Utils::isObjNull($con_arr['age_height_score'])) {
        $infos = $infos->where('age_height_score', '=', $con_arr['age_height_score']);
        }
    
        if (array_key_exists('height_weight_score', $con_arr) && !Utils::isObjNull($con_arr['height_weight_score'])) {
        $infos = $infos->where('height_weight_score', '=', $con_arr['height_weight_score']);
        }
    
        if (array_key_exists('age_weight_score', $con_arr) && !Utils::isObjNull($con_arr['age_weight_score'])) {
        $infos = $infos->where('age_weight_score', '=', $con_arr['age_weight_score']);
        }
    
        if (array_key_exists('age_middle_upper_arm_circumference_score', $con_arr) && !Utils::isObjNull($con_arr['age_middle_upper_arm_circumference_score'])) {
        $infos = $infos->where('age_middle_upper_arm_circumference_score', '=', $con_arr['age_middle_upper_arm_circumference_score']);
        }
    
        if (array_key_exists('age_head_circumference_score', $con_arr) && !Utils::isObjNull($con_arr['age_head_circumference_score'])) {
        $infos = $infos->where('age_head_circumference_score', '=', $con_arr['age_head_circumference_score']);
        }
    
        if (array_key_exists('is_dysphagia', $con_arr) && !Utils::isObjNull($con_arr['is_dysphagia'])) {
        $infos = $infos->where('is_dysphagia', '=', $con_arr['is_dysphagia']);
        }
    
        if (array_key_exists('is_tube_feeding', $con_arr) && !Utils::isObjNull($con_arr['is_tube_feeding'])) {
        $infos = $infos->where('is_tube_feeding', '=', $con_arr['is_tube_feeding']);
        }
    
        if (array_key_exists('tube_feeding_type', $con_arr) && !Utils::isObjNull($con_arr['tube_feeding_type'])) {
        $infos = $infos->where('tube_feeding_type', '=', $con_arr['tube_feeding_type']);
        }
    
        if (array_key_exists('height', $con_arr) && !Utils::isObjNull($con_arr['height'])) {
        $infos = $infos->where('height', '=', $con_arr['height']);
        }
    
        if (array_key_exists('weight', $con_arr) && !Utils::isObjNull($con_arr['weight'])) {
        $infos = $infos->where('weight', '=', $con_arr['weight']);
        }
    
        if (array_key_exists('bmi', $con_arr) && !Utils::isObjNull($con_arr['bmi'])) {
        $infos = $infos->where('bmi', '=', $con_arr['bmi']);
        }
    
        if (array_key_exists('upper_arm_circumference', $con_arr) && !Utils::isObjNull($con_arr['upper_arm_circumference'])) {
        $infos = $infos->where('upper_arm_circumference', '=', $con_arr['upper_arm_circumference']);
        }
    
        if (array_key_exists('head_circumference', $con_arr) && !Utils::isObjNull($con_arr['head_circumference'])) {
        $infos = $infos->where('head_circumference', '=', $con_arr['head_circumference']);
        }
    
        if (array_key_exists('additional_explanation', $con_arr) && !Utils::isObjNull($con_arr['additional_explanation'])) {
        $infos = $infos->where('additional_explanation', '=', $con_arr['additional_explanation']);
        }
    
        if (array_key_exists('additional_enclosure', $con_arr) && !Utils::isObjNull($con_arr['additional_enclosure'])) {
        $infos = $infos->where('additional_enclosure', '=', $con_arr['additional_enclosure']);
        }
    
        if (array_key_exists('is_share', $con_arr) && !Utils::isObjNull($con_arr['is_share'])) {
        $infos = $infos->where('is_share', '=', $con_arr['is_share']);
        }
    
        if (array_key_exists('seq', $con_arr) && !Utils::isObjNull($con_arr['seq'])) {
        $infos = $infos->where('seq', '=', $con_arr['seq']);
        }
    
        if (array_key_exists('status', $con_arr) && !Utils::isObjNull($con_arr['status'])) {
        $infos = $infos->where('status', '=', $con_arr['status']);
        }
    
    //排序设定
    if (array_key_exists('orderby', $con_arr) && is_array($con_arr['orderby'])) {
        $orderby_arr = $con_arr['orderby'];
        //例子，传入数据样式为'status'=>'desc'
        if (array_key_exists('status', $orderby_arr) && !Utils::isObjNull($orderby_arr['status'])) {
            $infos = $infos->orderby('status', $orderby_arr['status']);
        }
    }
    $infos = $infos->orderby('seq', 'desc')->orderby('created_at', 'desc');

    //分页设定
    if ($is_paginate) {
        $page_size = Utils::PAGE_SIZE;
        //如果con_arr中有page_size信息
        if (array_key_exists('page_size', $con_arr) && !Utils::isObjNull($con_arr['page_size'])) {
            $page_size = $con_arr['page_size'];
        }
        $infos = $infos->skip(($page - 1) * $page_size)->paginate($page_size);
    }
    else {
        //如果con_arr中有page_size信息 2019-10-08优化，可以不分页也获取多条数据
        if (array_key_exists('page_size', $con_arr) && !Utils::isObjNull($con_arr['page_size'])) {
            $page_size = $con_arr['page_size'];
            $infos = $infos->take($page_size);
        }
            $infos = $infos->get();
        }

        //如果传入random，代表要随机获取，其中random->3代表获取3个随机数据
        //请注意，random是预留字段，数据库中不允许设定字段名叫做random
        if (array_key_exists('random', $con_arr) && !Utils::isObjNull($con_arr['random'])) {
            $infos = $infos->random($con_arr['random']);
        }

        return $infos;
    }

/*
* setInfo
*
* By Auto CodeCreator
*
* 2020-01-30 11:20:35
*/
public static function setInfo($info, $data)
{
    $ref = new \ReflectionClass(PatientInspectInfoDoc::class);

    //编辑情况，不处理data，$data有id或者$info->_id不为空
    if ($info->_id != null) {

    } else {
    //新建情况，处理data
        $class_arr = $ref->getDefaultProperties();
        unset($class_arr['collection_name']);
        $data = array_merge($class_arr, $data);
    }

    
            if (array_key_exists('collection_name', $data)) {
    $info->collection_name = $data['collection_name'];
    }
        
    
            if (array_key_exists('patient_id', $data)) {
    $info->patient_id = $data['patient_id'];
    }
        
    
            if (array_key_exists('doctor_id', $data)) {
    $info->doctor_id = $data['doctor_id'];
    }
        
    
            if (array_key_exists('num', $data)) {
    $info->num = $data['num'];
    }
        
    
            if (array_key_exists('field_ids', $data)) {
    $info->field_ids = $data['field_ids'];
    }
        
    
            if (array_key_exists('patient_plan_time', $data)) {
    $info->patient_plan_time = $data['patient_plan_time'];
    }
        
    
            if (array_key_exists('medical_record_number', $data)) {
    $info->medical_record_number = $data['medical_record_number'];
    }
        
    
            if (array_key_exists('nearly_half_year_hospitalization_describe', $data)) {
    $info->nearly_half_year_hospitalization_describe = $data['nearly_half_year_hospitalization_describe'];
    }
        
    
            if (array_key_exists('nearly_half_year_hospitalization_num', $data)) {
    $info->nearly_half_year_hospitalization_num = $data['nearly_half_year_hospitalization_num'];
    }
        
    
            if (array_key_exists('platelet_num', $data)) {
    $info->platelet_num = $data['platelet_num'];
    }
        
    
            if (array_key_exists('platelet_num_unit', $data)) {
    $info->platelet_num_unit = $data['platelet_num_unit'];
    }
        
    
            if (array_key_exists('urine_protein_quantification', $data)) {
    $info->urine_protein_quantification = $data['urine_protein_quantification'];
    }
        
    
            if (array_key_exists('urine_protein_quantification_unit', $data)) {
    $info->urine_protein_quantification_unit = $data['urine_protein_quantification_unit'];
    }
        
    
            if (array_key_exists('plasma_prothrombin_time', $data)) {
    $info->plasma_prothrombin_time = $data['plasma_prothrombin_time'];
    }
        
    
            if (array_key_exists('plasma_prothrombin_time_unit', $data)) {
    $info->plasma_prothrombin_time_unit = $data['plasma_prothrombin_time_unit'];
    }
        
    
            if (array_key_exists('prothrombin_international_normalized_ratio', $data)) {
    $info->prothrombin_international_normalized_ratio = $data['prothrombin_international_normalized_ratio'];
    }
        
    
            if (array_key_exists('activated_partial_thromboplastin_time', $data)) {
    $info->activated_partial_thromboplastin_time = $data['activated_partial_thromboplastin_time'];
    }
        
    
            if (array_key_exists('activated_partial_thromboplastin_time_unit', $data)) {
    $info->activated_partial_thromboplastin_time_unit = $data['activated_partial_thromboplastin_time_unit'];
    }
        
    
            if (array_key_exists('thrombin_time', $data)) {
    $info->thrombin_time = $data['thrombin_time'];
    }
        
    
            if (array_key_exists('thrombin_time_unit', $data)) {
    $info->thrombin_time_unit = $data['thrombin_time_unit'];
    }
        
    
            if (array_key_exists('fibrinogen', $data)) {
    $info->fibrinogen = $data['fibrinogen'];
    }
        
    
            if (array_key_exists('fibrinogen_unit', $data)) {
    $info->fibrinogen_unit = $data['fibrinogen_unit'];
    }
        
    
            if (array_key_exists('blood_coagulation_time', $data)) {
    $info->blood_coagulation_time = $data['blood_coagulation_time'];
    }
        
    
            if (array_key_exists('blood_coagulation_time_unit', $data)) {
    $info->blood_coagulation_time_unit = $data['blood_coagulation_time_unit'];
    }
        
    
            if (array_key_exists('prothrombin_time_activity', $data)) {
    $info->prothrombin_time_activity = $data['prothrombin_time_activity'];
    }
        
    
            if (array_key_exists('prothrombin_time_activity_unit', $data)) {
    $info->prothrombin_time_activity_unit = $data['prothrombin_time_activity_unit'];
    }
        
    
            if (array_key_exists('d_dimer', $data)) {
    $info->d_dimer = $data['d_dimer'];
    }
        
    
            if (array_key_exists('d_dimer_unit', $data)) {
    $info->d_dimer_unit = $data['d_dimer_unit'];
    }
        
    
            if (array_key_exists('fibrinogen_degradation_products', $data)) {
    $info->fibrinogen_degradation_products = $data['fibrinogen_degradation_products'];
    }
        
    
            if (array_key_exists('fibrinogen_degradation_products_unit', $data)) {
    $info->fibrinogen_degradation_products_unit = $data['fibrinogen_degradation_products_unit'];
    }
        
    
            if (array_key_exists('antithrombin_activity', $data)) {
    $info->antithrombin_activity = $data['antithrombin_activity'];
    }
        
    
            if (array_key_exists('antithrombin_activity_unit', $data)) {
    $info->antithrombin_activity_unit = $data['antithrombin_activity_unit'];
    }
        
    
            if (array_key_exists('serum_cholesterol_concentration', $data)) {
    $info->serum_cholesterol_concentration = $data['serum_cholesterol_concentration'];
    }
        
    
            if (array_key_exists('serum_cholesterol_concentration_unit', $data)) {
    $info->serum_cholesterol_concentration_unit = $data['serum_cholesterol_concentration_unit'];
    }
        
    
            if (array_key_exists('serum_bicarbonate_concentration', $data)) {
    $info->serum_bicarbonate_concentration = $data['serum_bicarbonate_concentration'];
    }
        
    
            if (array_key_exists('serum_bicarbonate_concentration_unit', $data)) {
    $info->serum_bicarbonate_concentration_unit = $data['serum_bicarbonate_concentration_unit'];
    }
        
    
            if (array_key_exists('cerebrospinal_fluid', $data)) {
    $info->cerebrospinal_fluid = $data['cerebrospinal_fluid'];
    }
        
    
            if (array_key_exists('cerebrospinal_fluid_unit', $data)) {
    $info->cerebrospinal_fluid_unit = $data['cerebrospinal_fluid_unit'];
    }
        
    
            if (array_key_exists('cmap', $data)) {
    $info->cmap = $data['cmap'];
    }
        
    
            if (array_key_exists('emg_result', $data)) {
    $info->emg_result = $data['emg_result'];
    }
        
    
            if (array_key_exists('oblongata_result', $data)) {
    $info->oblongata_result = $data['oblongata_result'];
    }
        
    
            if (array_key_exists('is_rehabilitation_therapy', $data)) {
    $info->is_rehabilitation_therapy = $data['is_rehabilitation_therapy'];
    }
        
    
            if (array_key_exists('rehabilitation_therapy_plan', $data)) {
    $info->rehabilitation_therapy_plan = $data['rehabilitation_therapy_plan'];
    }
        
    
            if (array_key_exists('is_accessories_orthotics', $data)) {
    $info->is_accessories_orthotics = $data['is_accessories_orthotics'];
    }
        
    
            if (array_key_exists('rehabilitation_medical_institutions_name', $data)) {
    $info->rehabilitation_medical_institutions_name = $data['rehabilitation_medical_institutions_name'];
    }
        
    
            if (array_key_exists('rehabilitation_therapy_frequency', $data)) {
    $info->rehabilitation_therapy_frequency = $data['rehabilitation_therapy_frequency'];
    }
        
    
            if (array_key_exists('one_therapy_duration', $data)) {
    $info->one_therapy_duration = $data['one_therapy_duration'];
    }
        
    
            if (array_key_exists('tidal_volume', $data)) {
    $info->tidal_volume = $data['tidal_volume'];
    }
        
    
            if (array_key_exists('tidal_volume_unit', $data)) {
    $info->tidal_volume_unit = $data['tidal_volume_unit'];
    }
        
    
            if (array_key_exists('expiratory_volume', $data)) {
    $info->expiratory_volume = $data['expiratory_volume'];
    }
        
    
            if (array_key_exists('expiratory_volume_unit', $data)) {
    $info->expiratory_volume_unit = $data['expiratory_volume_unit'];
    }
        
    
            if (array_key_exists('inspiratory_volume', $data)) {
    $info->inspiratory_volume = $data['inspiratory_volume'];
    }
        
    
            if (array_key_exists('inspiratory_volume_unit', $data)) {
    $info->inspiratory_volume_unit = $data['inspiratory_volume_unit'];
    }
        
    
            if (array_key_exists('deep_inspiratory_capacity', $data)) {
    $info->deep_inspiratory_capacity = $data['deep_inspiratory_capacity'];
    }
        
    
            if (array_key_exists('deep_inspiratory_capacity_unit', $data)) {
    $info->deep_inspiratory_capacity_unit = $data['deep_inspiratory_capacity_unit'];
    }
        
    
            if (array_key_exists('vital_capacity', $data)) {
    $info->vital_capacity = $data['vital_capacity'];
    }
        
    
            if (array_key_exists('vital_capacity_unit', $data)) {
    $info->vital_capacity_unit = $data['vital_capacity_unit'];
    }
        
    
            if (array_key_exists('functional_residual_volume', $data)) {
    $info->functional_residual_volume = $data['functional_residual_volume'];
    }
        
    
            if (array_key_exists('functional_residual_volume_unit', $data)) {
    $info->functional_residual_volume_unit = $data['functional_residual_volume_unit'];
    }
        
    
            if (array_key_exists('residual_volume', $data)) {
    $info->residual_volume = $data['residual_volume'];
    }
        
    
            if (array_key_exists('residual_volume_unit', $data)) {
    $info->residual_volume_unit = $data['residual_volume_unit'];
    }
        
    
            if (array_key_exists('total_lung_volume', $data)) {
    $info->total_lung_volume = $data['total_lung_volume'];
    }
        
    
            if (array_key_exists('total_lung_volume_unit', $data)) {
    $info->total_lung_volume_unit = $data['total_lung_volume_unit'];
    }
        
    
            if (array_key_exists('respiratory_frequency', $data)) {
    $info->respiratory_frequency = $data['respiratory_frequency'];
    }
        
    
            if (array_key_exists('respiratory_frequency_unit', $data)) {
    $info->respiratory_frequency_unit = $data['respiratory_frequency_unit'];
    }
        
    
            if (array_key_exists('dead_space_gas_volume', $data)) {
    $info->dead_space_gas_volume = $data['dead_space_gas_volume'];
    }
        
    
            if (array_key_exists('dead_space_gas_volume_unit', $data)) {
    $info->dead_space_gas_volume_unit = $data['dead_space_gas_volume_unit'];
    }
        
    
            if (array_key_exists('alveolar_ventilation', $data)) {
    $info->alveolar_ventilation = $data['alveolar_ventilation'];
    }
        
    
            if (array_key_exists('alveolar_ventilation_unit', $data)) {
    $info->alveolar_ventilation_unit = $data['alveolar_ventilation_unit'];
    }
        
    
            if (array_key_exists('minute_ventilation', $data)) {
    $info->minute_ventilation = $data['minute_ventilation'];
    }
        
    
            if (array_key_exists('minute_ventilation_unit', $data)) {
    $info->minute_ventilation_unit = $data['minute_ventilation_unit'];
    }
        
    
            if (array_key_exists('minute_ventilation_max', $data)) {
    $info->minute_ventilation_max = $data['minute_ventilation_max'];
    }
        
    
            if (array_key_exists('minute_ventilation_max_unit', $data)) {
    $info->minute_ventilation_max_unit = $data['minute_ventilation_max_unit'];
    }
        
    
            if (array_key_exists('ventilation_reserve', $data)) {
    $info->ventilation_reserve = $data['ventilation_reserve'];
    }
        
    
            if (array_key_exists('ventilation_reserve_unit', $data)) {
    $info->ventilation_reserve_unit = $data['ventilation_reserve_unit'];
    }
        
    
            if (array_key_exists('forced_vital_capacity', $data)) {
    $info->forced_vital_capacity = $data['forced_vital_capacity'];
    }
        
    
            if (array_key_exists('forced_vital_capacity_unit', $data)) {
    $info->forced_vital_capacity_unit = $data['forced_vital_capacity_unit'];
    }
        
    
            if (array_key_exists('one_second_forced_expiratory_volume', $data)) {
    $info->one_second_forced_expiratory_volume = $data['one_second_forced_expiratory_volume'];
    }
        
    
            if (array_key_exists('one_second_forced_expiratory_volume_unit', $data)) {
    $info->one_second_forced_expiratory_volume_unit = $data['one_second_forced_expiratory_volume_unit'];
    }
        
    
            if (array_key_exists('one_second_rate', $data)) {
    $info->one_second_rate = $data['one_second_rate'];
    }
        
    
            if (array_key_exists('one_second_rate_unit', $data)) {
    $info->one_second_rate_unit = $data['one_second_rate_unit'];
    }
        
    
            if (array_key_exists('maximum_midexpiratory_flow', $data)) {
    $info->maximum_midexpiratory_flow = $data['maximum_midexpiratory_flow'];
    }
        
    
            if (array_key_exists('maximum_midexpiratory_flow_unit', $data)) {
    $info->maximum_midexpiratory_flow_unit = $data['maximum_midexpiratory_flow_unit'];
    }
        
    
            if (array_key_exists('middle_expiratory_instantaneous_velocity', $data)) {
    $info->middle_expiratory_instantaneous_velocity = $data['middle_expiratory_instantaneous_velocity'];
    }
        
    
            if (array_key_exists('middle_expiratory_instantaneous_velocity_unit', $data)) {
    $info->middle_expiratory_instantaneous_velocity_unit = $data['middle_expiratory_instantaneous_velocity_unit'];
    }
        
    
            if (array_key_exists('behind_expiratory_instantaneous_velocity', $data)) {
    $info->behind_expiratory_instantaneous_velocity = $data['behind_expiratory_instantaneous_velocity'];
    }
        
    
            if (array_key_exists('behind_expiratory_instantaneous_velocity_unit', $data)) {
    $info->behind_expiratory_instantaneous_velocity_unit = $data['behind_expiratory_instantaneous_velocity_unit'];
    }
        
    
            if (array_key_exists('peak_expiratory_flow', $data)) {
    $info->peak_expiratory_flow = $data['peak_expiratory_flow'];
    }
        
    
            if (array_key_exists('peak_expiratory_flow_unit', $data)) {
    $info->peak_expiratory_flow_unit = $data['peak_expiratory_flow_unit'];
    }
        
    
            if (array_key_exists('peak_expiratory_flow_rate', $data)) {
    $info->peak_expiratory_flow_rate = $data['peak_expiratory_flow_rate'];
    }
        
    
            if (array_key_exists('peak_expiratory_flow_rate_unit', $data)) {
    $info->peak_expiratory_flow_rate_unit = $data['peak_expiratory_flow_rate_unit'];
    }
        
    
            if (array_key_exists('earned_value', $data)) {
    $info->earned_value = $data['earned_value'];
    }
        
    
            if (array_key_exists('earned_value_unit', $data)) {
    $info->earned_value_unit = $data['earned_value_unit'];
    }
        
    
            if (array_key_exists('lung_carbon_monoxide_diffusing_capacity', $data)) {
    $info->lung_carbon_monoxide_diffusing_capacity = $data['lung_carbon_monoxide_diffusing_capacity'];
    }
        
    
            if (array_key_exists('lung_carbon_monoxide_diffusing_capacity_unit', $data)) {
    $info->lung_carbon_monoxide_diffusing_capacity_unit = $data['lung_carbon_monoxide_diffusing_capacity_unit'];
    }
        
    
            if (array_key_exists('airway_resistance', $data)) {
    $info->airway_resistance = $data['airway_resistance'];
    }
        
    
            if (array_key_exists('airway_resistance_unit', $data)) {
    $info->airway_resistance_unit = $data['airway_resistance_unit'];
    }
        
    
            if (array_key_exists('airway_conductivity', $data)) {
    $info->airway_conductivity = $data['airway_conductivity'];
    }
        
    
            if (array_key_exists('airway_conductivity_unit', $data)) {
    $info->airway_conductivity_unit = $data['airway_conductivity_unit'];
    }
        
    
            if (array_key_exists('than_airway_conductivity', $data)) {
    $info->than_airway_conductivity = $data['than_airway_conductivity'];
    }
        
    
            if (array_key_exists('than_airway_conductivity_unit', $data)) {
    $info->than_airway_conductivity_unit = $data['than_airway_conductivity_unit'];
    }
        
    
            if (array_key_exists('than_airway_resistance', $data)) {
    $info->than_airway_resistance = $data['than_airway_resistance'];
    }
        
    
            if (array_key_exists('than_airway_resistance_unit', $data)) {
    $info->than_airway_resistance_unit = $data['than_airway_resistance_unit'];
    }
        
    
            if (array_key_exists('intrathoracic_gas_volume', $data)) {
    $info->intrathoracic_gas_volume = $data['intrathoracic_gas_volume'];
    }
        
    
            if (array_key_exists('intrathoracic_gas_volume_unit', $data)) {
    $info->intrathoracic_gas_volume_unit = $data['intrathoracic_gas_volume_unit'];
    }
        
    
            if (array_key_exists('is_medication', $data)) {
    $info->is_medication = $data['is_medication'];
    }
        
    
            if (array_key_exists('medication_name', $data)) {
    $info->medication_name = $data['medication_name'];
    }
        
    
            if (array_key_exists('actual_medication_time', $data)) {
    $info->actual_medication_time = $data['actual_medication_time'];
    }
        
    
            if (array_key_exists('actual_medication_dose', $data)) {
    $info->actual_medication_dose = $data['actual_medication_dose'];
    }
        
    
            if (array_key_exists('usage_description', $data)) {
    $info->usage_description = $data['usage_description'];
    }
        
    
            if (array_key_exists('is_side_effects', $data)) {
    $info->is_side_effects = $data['is_side_effects'];
    }
        
    
            if (array_key_exists('side_effects_type', $data)) {
    $info->side_effects_type = $data['side_effects_type'];
    }
        
    
            if (array_key_exists('side_effects_degree', $data)) {
    $info->side_effects_degree = $data['side_effects_degree'];
    }
        
    
            if (array_key_exists('is_body_deformation', $data)) {
    $info->is_body_deformation = $data['is_body_deformation'];
    }
        
    
            if (array_key_exists('is_joint_deformity', $data)) {
    $info->is_joint_deformity = $data['is_joint_deformity'];
    }
        
    
            if (array_key_exists('joint_deformity_type', $data)) {
    $info->joint_deformity_type = $data['joint_deformity_type'];
    }
        
    
            if (array_key_exists('is_joint_contracture', $data)) {
    $info->is_joint_contracture = $data['is_joint_contracture'];
    }
        
    
            if (array_key_exists('chest_is_deformation', $data)) {
    $info->chest_is_deformation = $data['chest_is_deformation'];
    }
        
    
            if (array_key_exists('chest_deformation_result', $data)) {
    $info->chest_deformation_result = $data['chest_deformation_result'];
    }
        
    
            if (array_key_exists('is_scoliosis', $data)) {
    $info->is_scoliosis = $data['is_scoliosis'];
    }
        
    
            if (array_key_exists('scoliosis_angle', $data)) {
    $info->scoliosis_angle = $data['scoliosis_angle'];
    }
        
    
            if (array_key_exists('is_kyphosis', $data)) {
    $info->is_kyphosis = $data['is_kyphosis'];
    }
        
    
            if (array_key_exists('bone_density_t_value', $data)) {
    $info->bone_density_t_value = $data['bone_density_t_value'];
    }
        
    
            if (array_key_exists('is_sleep_monitoring', $data)) {
    $info->is_sleep_monitoring = $data['is_sleep_monitoring'];
    }
        
    
            if (array_key_exists('sleep_monitoring_result', $data)) {
    $info->sleep_monitoring_result = $data['sleep_monitoring_result'];
    }
        
    
            if (array_key_exists('nearly_half_year_is_dyspnea', $data)) {
    $info->nearly_half_year_is_dyspnea = $data['nearly_half_year_is_dyspnea'];
    }
        
    
            if (array_key_exists('breathing_is_auxiliary_equipment', $data)) {
    $info->breathing_is_auxiliary_equipment = $data['breathing_is_auxiliary_equipment'];
    }
        
    
            if (array_key_exists('auxiliary_equipment_type', $data)) {
    $info->auxiliary_equipment_type = $data['auxiliary_equipment_type'];
    }
        
    
            if (array_key_exists('is_need_respiratory_support', $data)) {
    $info->is_need_respiratory_support = $data['is_need_respiratory_support'];
    }
        
    
            if (array_key_exists('respiratory_support_time', $data)) {
    $info->respiratory_support_time = $data['respiratory_support_time'];
    }
        
    
            if (array_key_exists('coughing_peak_velocity_inspect_result', $data)) {
    $info->coughing_peak_velocity_inspect_result = $data['coughing_peak_velocity_inspect_result'];
    }
        
    
            if (array_key_exists('coughing_peak_velocity_inspect_unit', $data)) {
    $info->coughing_peak_velocity_inspect_unit = $data['coughing_peak_velocity_inspect_unit'];
    }
        
    
            if (array_key_exists('blood_oxygen_saturation', $data)) {
    $info->blood_oxygen_saturation = $data['blood_oxygen_saturation'];
    }
        
    
            if (array_key_exists('blood_oxygen_saturation_unit', $data)) {
    $info->blood_oxygen_saturation_unit = $data['blood_oxygen_saturation_unit'];
    }
        
    
            if (array_key_exists('end_breath_co2_concentration', $data)) {
    $info->end_breath_co2_concentration = $data['end_breath_co2_concentration'];
    }
        
    
            if (array_key_exists('end_breath_co2_concentration_unit', $data)) {
    $info->end_breath_co2_concentration_unit = $data['end_breath_co2_concentration_unit'];
    }
        
    
            if (array_key_exists('vitamin_d3', $data)) {
    $info->vitamin_d3 = $data['vitamin_d3'];
    }
        
    
            if (array_key_exists('trace_element_result', $data)) {
    $info->trace_element_result = $data['trace_element_result'];
    }
        
    
            if (array_key_exists('age_height_score', $data)) {
    $info->age_height_score = $data['age_height_score'];
    }
        
    
            if (array_key_exists('height_weight_score', $data)) {
    $info->height_weight_score = $data['height_weight_score'];
    }
        
    
            if (array_key_exists('age_weight_score', $data)) {
    $info->age_weight_score = $data['age_weight_score'];
    }
        
    
            if (array_key_exists('age_middle_upper_arm_circumference_score', $data)) {
    $info->age_middle_upper_arm_circumference_score = $data['age_middle_upper_arm_circumference_score'];
    }
        
    
            if (array_key_exists('age_head_circumference_score', $data)) {
    $info->age_head_circumference_score = $data['age_head_circumference_score'];
    }
        
    
            if (array_key_exists('is_dysphagia', $data)) {
    $info->is_dysphagia = $data['is_dysphagia'];
    }
        
    
            if (array_key_exists('is_tube_feeding', $data)) {
    $info->is_tube_feeding = $data['is_tube_feeding'];
    }
        
    
            if (array_key_exists('tube_feeding_type', $data)) {
    $info->tube_feeding_type = $data['tube_feeding_type'];
    }
        
    
            if (array_key_exists('height', $data)) {
    $info->height = $data['height'];
    }
        
    
            if (array_key_exists('weight', $data)) {
    $info->weight = $data['weight'];
    }
        
    
            if (array_key_exists('bmi', $data)) {
    $info->bmi = $data['bmi'];
    }
        
    
            if (array_key_exists('upper_arm_circumference', $data)) {
    $info->upper_arm_circumference = $data['upper_arm_circumference'];
    }
        
    
            if (array_key_exists('head_circumference', $data)) {
    $info->head_circumference = $data['head_circumference'];
    }
        
    
            if (array_key_exists('additional_explanation', $data)) {
    $info->additional_explanation = $data['additional_explanation'];
    }
        
    
            if (array_key_exists('additional_enclosure', $data)) {
    $info->additional_enclosure = $data['additional_enclosure'];
    }
        
    
            if (array_key_exists('is_share', $data)) {
    $info->is_share = $data['is_share'];
    }
        
    
            if (array_key_exists('seq', $data)) {
    $info->seq = intval($data['seq']);
    }
        
    
            if (array_key_exists('status', $data)) {
    $info->status = $data['status'];
    }
        
    
    return $info;
}

    /*
    * 统一封装数量操作，部分对象涉及数量操作，例如产品销售，剩余数等，统一通过该方法封装
    *
    * By Auto CodeCreator
    *
    * 2020-01-30 11:20:35
    *
    * @param  id：对象id item：操作对象 num：加减数值
    */
    public static function setNum($id, $item, $num)
    {
        $info = self::getById($id);
        switch ($item) {
            case "show_num":
            $info->show_num = $info->show_num + $num;
            break;
            case "left_num":
            $info->left_num = $info->left_num + $num;
            break;
            case "send_num":
            $info->send_num = $info->send_num + $num;
            break;
        }
        $info->save();
        return $info;
    }

    /*
    * 获取最近的一条信息
    *
    * By TerryQi
    *
    */
    public static function getLatest()
    {
        $info = self::getListByCon(['status' => '1'], false)->first();
        return $info;
    }

}

