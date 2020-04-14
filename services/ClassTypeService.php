<?php
namespace app\services;

use app\models\EduClassType;

class ClassTypeService extends \yii\base\Model
{
    //get Category type
    public static function getClassType(){
        $menu = EduClassType::getClassType();
        return self::handleCategory($menu,'1','0');
    }

    // weiya tree
    public static function handleCategory($data, $parent_id=1, $level=0)
    {
        $items = array();
        foreach($data as $v){
            $items[$v['id']] = $v;
        }
        $tree = array();
        foreach($items as $k => $item){
            if(isset($items[$item['up_class_id']])){
                $items[$item['up_class_id']]['son'][] = &$items[$k];
            }else{
                $tree[] = &$items[$k];
            }
        }
        return $tree;
    }

    //get classenname id
    public static function getClassTypeId($class_enname)
    {
        return EduClassType::find()->where(
            'class_enname=:class_enname',[':class_enname'=>$class_enname]
        )->asArray()->one();
    }
    
    //根据id 获取 child 值
    public static function geyClassTypeChild($id)
    {
        return EduClassType::find()->where(['up_class_id'=>$id])->asArray()->all();
    }
}