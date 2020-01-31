<?php
/**
 * Created by PhpStorm.
 * User: TerryQi
 * Date: 2019/10/23
 * Time: 12:17
 */

namespace App\MongoDB\Models\Doc;


class PatientCaseDoc
{
    private $collection_name = "patient_case";       //mongodb的collection名称

    private $patient_id;          //患者id
    private $first_symptom_date;      //首次出现症状日期
    private $first_inspection_date;      //首诊日期
    private $first_inspection_age;       //首诊年龄
    private $first_inspection_symptom;          //首诊症状
    private $fetermine_inspection_date;          //确诊日期
    private $fetermine_inspection_age;          //确诊年龄
    private $fetermine_inspection_hospital;          //确诊医院
    private $disease_type;          //疾病分型 0:I型 1:II型 2:III型 3:IV型
    private $brothers_sisters_num;          //兄弟姐妹人数
    private $brothers_sisters_is_sma;          //兄弟姐妹是否有SMA病史 0:否 1:是
    private $brothers_sisters_disease_symptom;          //兄弟姐妹患病情况描述
    private $parent_is_sma;          //父母辈是否有SMA病史 0:否 1:是
    private $parent_disease_symptom;          //父母辈患病情况描述
    private $ancestor_is_sma;          //祖辈是否有SMA病史 0:否 1:是
    private $ancestor_disease_symptom;          //祖辈患病情况描述

    private $smn1_copy_num;          //SMN1拷贝数 单位:copies
    private $smn1_is_mutation;          //SMN1是否突变 0:否 1:是
    private $smn1_mutation_type;          //SMN1突变类型
    private $smn2_copy_num;          //SMN2拷贝数 单位:copies
    private $gene_detection_date;          //基因检测时间
    private $gene_detection_method;          //基因检测方法 0:MLPA 1:qPCR 2:其他（给医生自己填）
    private $gene_detection_method_other;          //其他基因检测方法（基因检测方法选择其他的时候使用）
    private $gene_detection_mechanism;          //基因检测机构
    private $gene_detection_annex;          //基因报告附件





    private $seq = 99;       //排序       值越大越靠前
    private $status = '1';        //状态        0：失效 1：生效

}