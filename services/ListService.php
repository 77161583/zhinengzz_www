<?php


namespace app\services;


use app\models\EduNews;

class ListService extends \yii\base\Model
{
    /**
     * class_id Corresponding to the top menu id
     */
    public static function getListData($page=1,$page_size=10,$data='')
    {
        if(!is_numeric($page)) $page=1;
        if(!is_numeric($page_size)) $page_size=10;
        $list=EduNews::getListData(1,$page,$page_size,$data);
        $nums=EduNews::getListData(2,$page,$page_size,$data);
        return array(
            'data'=>$list,
            'count'=>$nums
        );
    }

    /**
     * index news data
     */
    public static function getIndexData()
    {
        $hangye = EduNews::find()->where(['class_id'=> 4])->asArray()->all();
        $company = EduNews::find()->where(['class_id'=> 3])->asArray()->all();
        $service = EduNews::find()->where(['class_id'=> 2003])->asArray()->all();
        return array('industryNews'=> $hangye,'companyNews'=>$company,'serverList'=>$service);
    }
}