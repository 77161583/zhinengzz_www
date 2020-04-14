<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "edu_app_ads".
 *
 * @property int $id
 * @property int $category_id 广告位ID
 * @property int $class_id 考试项目分类ID
 * @property string $title 广告标题
 * @property string $description 描述
 * @property int $ads_type 链接方式 1 APP原生 2 APP网页 3外部网页
 * @property string $redirect_uri 跳转链接
 * @property string $picurl 广告图片
 * @property int $sorting 排序
 * @property int $ios_allowed 是否允许IOS获取数据
 * @property int $start_time
 * @property int $end_time
 * @property int $state 状态 1正常 0屏蔽
 * @property int $add_time
 * @property string $add_ip
 * @property int $update_time
 * @property string $update_ip
 * @property int $operator_id
 */
class EduAppAds extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'edu_app_ads';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'class_id', 'ads_type', 'sorting', 'ios_allowed', 'start_time', 'end_time', 'state', 'add_time', 'update_time', 'operator_id'], 'integer'],
            [['title', 'redirect_uri', 'picurl'], 'string', 'max' => 90],
            [['description'], 'string', 'max' => 900],
            [['add_ip', 'update_ip'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'class_id' => 'Class ID',
            'title' => 'Title',
            'description' => 'Description',
            'ads_type' => 'Ads Type',
            'redirect_uri' => 'Redirect Uri',
            'picurl' => 'Picurl',
            'sorting' => 'Sorting',
            'ios_allowed' => 'Ios Allowed',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'state' => 'State',
            'add_time' => 'Add Time',
            'add_ip' => 'Add Ip',
            'update_time' => 'Update Time',
            'update_ip' => 'Update Ip',
            'operator_id' => 'Operator ID',
        ];
    }
}
