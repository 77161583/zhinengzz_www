<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "edu_news".
 *
 * @property int $id
 * @property int $type_id 资讯类型ID（对应edu_news_type表id字段）外键关联
 * @property int $class_id 考试类别id（对应表edu_class_type表id） 外键关联
 * @property int $lesson_id 考试科目id（对应edu_lesson表id）
 * @property string $title 资讯标题
 * @property string $short_title 资讯短标题
 * @property string $meta_word 关键词
 * @property string $description 文章导读，文章描述，seo  description
 * @property string $writer 作者
 * @property string $litimg 缩略图
 * @property string $source 资讯来源
 * @property int $click 资讯单击次数
 * @property int $show_num 排序
 * @property int $is_show 是否显示
 * @property int $is_top 是否头条
 * @property int $is_get 是否推荐
 * @property int $is_channel 是否考试频道也显示
 * @property int $is_home 是否首页显示
 * @property int $diy_time 自定义时间
 * @property int $add_time 添加时间
 * @property string $add_ip
 * @property int $update_time 更新时间
 * @property string $update_ip
 * @property int $operator_id
 */
class EduNews extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'edu_news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type_id', 'class_id', 'lesson_id', 'click', 'show_num', 'is_show', 'is_top', 'is_get', 'is_channel', 'is_home', 'diy_time', 'add_time', 'update_time', 'operator_id'], 'integer'],
            [['title', 'short_title', 'meta_word', 'litimg'], 'string', 'max' => 200],
            [['description'], 'string', 'max' => 255],
            [['writer'], 'string', 'max' => 20],
            [['source'], 'string', 'max' => 100],
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
            'type_id' => 'Type ID',
            'class_id' => 'Class ID',
            'lesson_id' => 'Lesson ID',
            'title' => 'Title',
            'short_title' => 'Short Title',
            'meta_word' => 'Meta Word',
            'description' => 'Description',
            'writer' => 'Writer',
            'litimg' => 'Litimg',
            'source' => 'Source',
            'click' => 'Click',
            'show_num' => 'Show Num',
            'is_show' => 'Is Show',
            'is_top' => 'Is Top',
            'is_get' => 'Is Get',
            'is_channel' => 'Is Channel',
            'is_home' => 'Is Home',
            'diy_time' => 'Diy Time',
            'add_time' => 'Add Time',
            'add_ip' => 'Add Ip',
            'update_time' => 'Update Time',
            'update_ip' => 'Update Ip',
            'operator_id' => 'Operator ID',
        ];
    }

    //获取list
    public static  function getListData($dotype,$page,$page_size,$data=''){
        $addsql='';
        $bindarr=array();
        if(is_numeric($data['class_id'])){
            $class_id = $data['class_id'];
            $addsql.=" and class_id=:class_id";
            $bindarr[]=array('name'=>'class_id');
        }
        $addsql.=" and is_show=1";
        $db = \Yii::$app->db;
        if($dotype==1){
            $start=($page-1)*$page_size;
            $sql = "select id,class_id,title,short_title,meta_word,description,litimg,diy_time,add_time from `edu_news`  
                where 1=1 {$addsql} order by show_num asc,id desc
                limit {$start},{$page_size}";
        }
        else{
            $sql = "select count(id) as nums from `edu_news` 
                where 1=1{$addsql}";
        }
        $command=$db->createCommand($sql);
        if($bindarr){
            foreach($bindarr as $k=>$v){
                $command->bindValue(':'.$v['name'].'',${$v['name']});
            }
        }
        if($dotype==1) return $command->queryAll();
        else return $command->queryOne();
    }

    //获取详情
    public static function getDetail($id)
    {
        $db = \Yii::$app->db;
        $sql = "SELECT
                    a.id,
                    a.class_id,
                    a.title,
                    a.short_title,
                    a.meta_word,
                    b.content
                FROM
                    `edu_news` a left JOIN edu_news_content b ON  a.id=b.news_id
                WHERE
                 a.id =:id";
        $command=$db->createCommand($sql);
        $command->bindValue(':id',$id);
        return $command->queryOne();
    }
}
