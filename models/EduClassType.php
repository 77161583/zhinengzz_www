<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "edu_class_type".
 *
 * @property int $id 栏目id
 * @property int $up_class_id 上级栏目id(外键关联 自表id)
 * @property int $level
 * @property string $class_name 栏目名称
 * @property string $class_enname 类型英文标识（只能英文字母，不能包括空格，并且唯一）
 * @property int $childs
 * @property int $has_tiku 是否有题库
 * @property string $seo_title SEO标题
 * @property string $seo_keywords SEO关键字
 * @property string $seo_desc SEO描述
 * @property int $copartner_id 合作商id
 * @property int $typeid 栏目类型(0-顶级，1-考试频道，2-列表，3-单页, 4-外部链接)
 * @property int $shownum 排序
 * @property string $linkurl 外部链接url
 * @property int $is_close 是否屏蔽
 * @property int $is_del 是否删除
 * @property string $tplfolder 模板目录
 * @property string $tplfile 模板文件
 * @property int $addtime 添加时间
 * @property int $edittime 修改时间
 * @property int $add_time
 * @property string $add_ip
 * @property int $update_time
 * @property string $update_ip
 * @property int $operator_id
 * @property int $is_show_pc
 * @property int $is_show_app
 * @property int $is_show_wap
 * @property int|null $exam_time 考试时间
 */
class EduClassType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'edu_class_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['up_class_id', 'level', 'childs', 'has_tiku', 'copartner_id', 'typeid', 'shownum', 'is_close', 'is_del', 'addtime', 'edittime', 'add_time', 'update_time', 'operator_id', 'is_show_pc', 'is_show_app', 'is_show_wap', 'exam_time'], 'integer'],
            [['class_name', 'class_enname'], 'string', 'max' => 60],
            [['seo_title', 'seo_keywords', 'seo_desc', 'linkurl', 'tplfolder', 'tplfile'], 'string', 'max' => 200],
            [['add_ip', 'update_ip'], 'string', 'max' => 30],
            [['class_enname'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'up_class_id' => 'Up Class ID',
            'level' => 'Level',
            'class_name' => 'Class Name',
            'class_enname' => 'Class Enname',
            'childs' => 'Childs',
            'has_tiku' => 'Has Tiku',
            'seo_title' => 'Seo Title',
            'seo_keywords' => 'Seo Keywords',
            'seo_desc' => 'Seo Desc',
            'copartner_id' => 'Copartner ID',
            'typeid' => 'Typeid',
            'shownum' => 'Shownum',
            'linkurl' => 'Linkurl',
            'is_close' => 'Is Close',
            'is_del' => 'Is Del',
            'tplfolder' => 'Tplfolder',
            'tplfile' => 'Tplfile',
            'addtime' => 'Addtime',
            'edittime' => 'Edittime',
            'add_time' => 'Add Time',
            'add_ip' => 'Add Ip',
            'update_time' => 'Update Time',
            'update_ip' => 'Update Ip',
            'operator_id' => 'Operator ID',
            'is_show_pc' => 'Is Show Pc',
            'is_show_app' => 'Is Show App',
            'is_show_wap' => 'Is Show Wap',
            'exam_time' => 'Exam Time',
        ];
    }

    //获取考试类型
    public static  function getClassType(){
        $sql = "select * from edu_class_type where up_class_id !=0 AND  is_close=0 order by shownum ASC";
        $db = \Yii::$app->db;
        $command=$db->createCommand($sql);
        $result = $command->queryAll();
        return $result;
    }
}
