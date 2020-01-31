<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class PatientInspectInfoDoc
{
    private $collection_name = "patient_inspect_info";       //mongodb的collection名称

    private $patient_id;          //患者id
    private $doctor_id;          //医生id
    private $num;          //数据有多少项
    private $field_ids;          //数据字段ids
    private $patient_plan_time;          //随访计划时间
    private $medical_record_number;          //案例号
    private $nearly_half_year_hospitalization_describe;          //近半年住院情况描述
    private $nearly_half_year_hospitalization_num;          //近半年住院次数
    private $platelet_num;          //血小板计数
    private $platelet_num_unit;          //血小板计数单位 10^9/L；g/L
    private $urine_protein_quantification;          //24小时尿蛋白定量
    private $urine_protein_quantification_unit;          //24小时尿蛋白定量单位 mg/24h，g/24h ,1g/24h=1000 mg/24h
    private $plasma_prothrombin_time;          //血浆凝血酶原时间（PT)
    private $plasma_prothrombin_time_unit;          //血浆凝血酶原时间（PT)单位 s
    private $prothrombin_international_normalized_ratio;          //凝血酶原国际标准化比值(PT-INR)
    private $activated_partial_thromboplastin_time;          //活化部分凝血活酶时间（APTT）
    private $activated_partial_thromboplastin_time_unit;          //活化部分凝血活酶时间（APTT）单位 s
    private $thrombin_time;          //凝血酶时间（TT)
    private $thrombin_time_unit;          //凝血酶时间（TT)单位 s
    private $fibrinogen;          //纤维蛋白原（FIB)
    private $fibrinogen_unit;          //纤维蛋白原（FIB)单位 g/L
    private $blood_coagulation_time;          //凝血时间（CT)
    private $blood_coagulation_time_unit;          //凝血时间（CT)单位 s
    private $prothrombin_time_activity;          //凝血酶原时间活动度（PTA)
    private $prothrombin_time_activity_unit;          //凝血酶原时间活动度（PTA)单位 %
    private $d_dimer;          //D-二聚体（D-Dimer）
    private $d_dimer_unit;          //D-二聚体（D-Dimer）单位 μg/L，μg/mL ,1 μg/mL=1000 μg/L
    private $fibrinogen_degradation_products;          //纤维蛋白原降解产物（FDP)
    private $fibrinogen_degradation_products_unit;          //纤维蛋白原降解产物（FDP)单位 μg/L，μg/mL ,1 μg/mL=1000 μg/L
    private $antithrombin_activity;          //抗凝血酶III活性（ATIII:A）)
    private $antithrombin_activity_unit;          //抗凝血酶III活性（ATIII:A）单位 %
    private $serum_cholesterol_concentration;          //血清胆固醇浓度
    private $serum_cholesterol_concentration_unit;          //血清胆固醇浓度单位 mmol/L，mg/dL ,1mmol/L×18=mg/dL
    private $serum_bicarbonate_concentration;          //血清碳酸氢盐浓度
    private $serum_bicarbonate_concentration_unit;          //血清碳酸氢盐浓度单位 mmol/L，nmol/L ,1 mmol/L=10^6 nmol/L
    private $cerebrospinal_fluid;          //NFL-H
    private $cerebrospinal_fluid_unit;          //NFL-H单位 ng/L，pg/mL ,1 ng/L= 1 pg/mL
    private $cmap;          //CMAP
    private $emg_result;          //肌电图结果
    private $oblongata_result;          //延髓功能评测结果
    private $is_rehabilitation_therapy;          //是否进行康复治疗;
    private $rehabilitation_therapy_plan;          //康复治疗方案
    private $is_accessories_orthotics;          //是否配有辅具以及矫形设备;
    private $rehabilitation_medical_institutions_name;          //康复医疗机构名称
    private $rehabilitation_therapy_frequency;          //康复治疗频率（多少月一次）
    private $one_therapy_duration;          //单次治疗时长（小时）
    private $tidal_volume;          //潮气容积（VT)
    private $tidal_volume_unit;          //潮气容积（VT)单位;mL，L ;1L=1000 mL
    private $expiratory_volume;          //补呼气容积（ERV)
    private $expiratory_volume_unit;          //补呼气容积（ERV)单位;mL，L ;1L=1000 mL
    private $inspiratory_volume;          //补吸气容积（IRV)
    private $inspiratory_volume_unit;          //补吸气容积（IRV)单位;mL，L ;1L=1000 mL
    private $deep_inspiratory_capacity;          //深吸气量（IC）
    private $deep_inspiratory_capacity_unit;          //深吸气量（IC）单位;mL，L ;1L=1000 mL
    private $vital_capacity;          //肺活量（VC）
    private $vital_capacity_unit;          //肺活量（VC）单位;mL，L ;1L=1000 mL
    private $functional_residual_volume;          //功能残气量（FRC）
    private $functional_residual_volume_unit;          //功能残气量（FRC）单位;mL，L ;1L=1000 mL
    private $residual_volume;          //	残气容积（RV）
    private $residual_volume_unit;          //	残气容积（RV）单位;mL，L ;1L=1000 mL
    private $total_lung_volume;          //	肺总量（TLC）
    private $total_lung_volume_unit;          //	肺总量（TLC）单位;mL，L ;1L=1000 mL
    private $respiratory_frequency;          //	呼吸频率（f）
    private $respiratory_frequency_unit;          //	呼吸频率（f）单位;次/min
    private $dead_space_gas_volume;          //	死腔气量（VD）
    private $dead_space_gas_volume_unit;          //	死腔气量（VD）单位;mL，L ;1L=1000 mL
    private $alveolar_ventilation;          //	肺泡通气量（VA）
    private $alveolar_ventilation_unit;          //	肺泡通气量（VA）单位;mL，L ;1L=1000 mL
    private $minute_ventilation;          //	每分钟通气量（VE）
    private $minute_ventilation_unit;          //	每分钟通气量（VE）单位;mL，L ;1L=1000 mL
    private $minute_ventilation_max;          //	最大自主分钟通气量（MVV）
    private $minute_ventilation_max_unit;          //	最大自主分钟通气量（MVV）单位;L/min，L/s ;1L/s= 60 L/min
    private $ventilation_reserve;          //	通气储量（VR）
    private $ventilation_reserve_unit;          //	通气储量（VR）单位;%
    private $forced_vital_capacity;          //	用力肺活量（FVC）
    private $forced_vital_capacity_unit;          //	用力肺活量（FVC）单位;mL，L ;1L=1000 mL
    private $one_second_forced_expiratory_volume;          //	一秒用力呼气量（FEV1）
    private $one_second_forced_expiratory_volume_unit;          //	一秒用力呼气量（FEV1）单位;mL，L ;1L=1000 mL
    private $one_second_rate;          //	一秒率（FEV1%)
    private $one_second_rate_unit;          //	一秒率（FEV1%)单位;%
    private $maximum_midexpiratory_flow;          //	呼气中段流速（MMEF)
    private $maximum_midexpiratory_flow_unit;          //	呼气中段流速（MMEF)单位;L/min，L/s ;1L/s= 60 L/min
    private $middle_expiratory_instantaneous_velocity;          //	呼气中期瞬间流速（V50）
    private $middle_expiratory_instantaneous_velocity_unit;          //	呼气中期瞬间流速（V50）单位;L/min，L/s ;1L/s= 60 L/min
    private $behind_expiratory_instantaneous_velocity;          //	呼气后期瞬间流速（V25）
    private $behind_expiratory_instantaneous_velocity_unit;          //	呼气后期瞬间流速（V25）单位;L/min，L/s ;1L/s= 60 L/min
    private $peak_expiratory_flow;          //	最高呼气流速（PEF）
    private $peak_expiratory_flow_unit;          //	最高呼气流速（PEF）单位;L/min，L/s ;1L/s= 60 L/min
    private $peak_expiratory_flow_rate;          //	最高呼气流速变异率（PEFR）
    private $peak_expiratory_flow_rate_unit;          //	最高呼气流速变异率（PEFR）单位;%
    private $earned_value;          //	外推容量（EV)
    private $earned_value_unit;          //	外推容量（EV)单位;mL，L ;1L=1000 mL
    private $lung_carbon_monoxide_diffusing_capacity;          //	肺一氧化碳弥散量（DLco）
    private $lung_carbon_monoxide_diffusing_capacity_unit;          //	肺一氧化碳弥散量（DLco）单位;mL/min/mmHg ;
    private $airway_resistance;          //	气道阻力（Raw）
    private $airway_resistance_unit;          //	气道阻力（Raw）单位;cmH2O/L/s ;
    private $airway_conductivity;          //	气道传导率（Gaw）
    private $airway_conductivity_unit;          //	气道传导率（Gaw）单位;(L·s)/cmH2O;
    private $than_airway_conductivity;          //	比气道传导率（sGaw）
    private $than_airway_conductivity_unit;          //	比气道传导率（sGaw）单位;L·cmH2O/s;
    private $than_airway_resistance;          //	比气道阻力（sRaw）
    private $than_airway_resistance_unit;          //	比气道阻力（sRaw）单位;cmH2O/s;
    private $intrathoracic_gas_volume;          //	胸腔内气体容积（Vtg）
    private $intrathoracic_gas_volume_unit;          //	胸腔内气体容积（Vtg）单位;mL，:L ;1L=1000 mL
    private $is_medication;          //	是否药物治疗;
    private $medication_name;          //	治疗药物名称
    private $actual_medication_time;          //	实际给药时间
    private $actual_medication_dose;          //	实际给药剂量
    private $usage_description;          //	用法描述
    private $is_side_effects;          //	是否有不良反应;
    private $side_effects_type;          //	不良反应类型;0:头痛，1:呕吐，2:背痛，3:脑膜炎，4:血小板减少，5:凝血异常，6:蛋白尿，7:脑积水，8:其他（给医生自己填）
    private $side_effects_degree;          //	不良反应程度
    private $is_body_deformation;          //	是否出现身体变形
    private $is_joint_deformity;          //	是否有关节畸形
    private $joint_deformity_type;          //	畸形种类
    private $is_joint_contracture;          //	是否有关节挛缩
    private $chest_is_deformation;          //	胸廓是否变形
    private $chest_deformation_result;          //	胸廓变形情况
    private $is_scoliosis;          //	是否有脊柱侧凸;
    private $scoliosis_angle;          //	脊柱侧凸角度
    private $is_kyphosis;          //	是否有脊柱后凸;
    private $bone_density_t_value;          //	骨密度T值
    private $is_sleep_monitoring;          //	是否进行睡眠监测;
    private $sleep_monitoring_result;          //	睡眠监测结果
    private $nearly_half_year_is_dyspnea;          //	近半年是否出现呼吸困难或障碍;
    private $breathing_is_auxiliary_equipment;          //	针对呼吸问题是否有辅助设备;
    private $auxiliary_equipment_type;          //	辅助设备类型
    private $is_need_respiratory_support;          //	是否需要呼吸支持;
    private $respiratory_support_time;          //	呼吸支持时间
    private $coughing_peak_velocity_inspect_result;          //	咳嗽峰流速检查结果
    private $coughing_peak_velocity_inspect_unit;          //	咳嗽峰流速检查结果单位;L/min，L/s ,1L/s= 60 L/min
    private $blood_oxygen_saturation;          //	血氧饱和度
    private $blood_oxygen_saturation_unit;          //	血氧饱和度单位;%
    private $end_breath_co2_concentration;          //	呼吸末CO2浓度
    private $end_breath_co2_concentration_unit;          //	呼吸末CO2浓度单位;mmol/L
    private $vitamin_d3;          //	维生素D3
    private $trace_element_result;          //	微量元素检查结果
    private $age_height_score;          //	年龄别身高/身长Z评分（HFA）
    private $height_weight_score;          //	身高别体重Z评分（WFH）
    private $age_weight_score;          //	年龄别体重Z评分（WFA)
    private $age_middle_upper_arm_circumference_score;          //	年龄别中上臂围Z评分
    private $age_head_circumference_score;          //	年龄别头围Z评分
    private $is_dysphagia;          //	是否吞咽困难（如吸允减弱或消失）;
    private $is_tube_feeding;          //	是否有管饲;
    private $tube_feeding_type;          //	管饲种类
    private $height;          //	身高（身长）（CM）
    private $weight;          //	体重（KG）
    private $bmi;          //	BMI
    private $upper_arm_circumference;          //	上臂围（CM）
    private $head_circumference;          //	头围（CM）
    private $additional_explanation;          //	补充说明
    private $additional_enclosure;          //	补充附件
    private $is_share = '0';          //	是否院内共享;0:否；1是
    private $seq = 99;       //排序       值越大越靠前
    private $status = '1';        //状态        0：失效 1：生效

}