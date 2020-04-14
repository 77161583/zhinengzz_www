<?php


namespace app\services;


use app\models\EduNews;

class DetailService extends \yii\base\Model
{
    //get detail
    public static function getDetail($id)
    {
        //判断关于我们和联系我们
        if($id == 20){
            $rec_data = EduNews::getDetail(1);  //关于我们
        }elseif ($id == 21){
            $rec_data = EduNews::getDetail(2);  //关于我们
        }else{
            $rec_data = EduNews::getDetail($id);
        }
        if(isset($rec_data['content'])){
            $rec_data['content']=str_replace('"/upload2nd','"'.\Yii::$app->params['file_server_2nd'],$rec_data['content']);
        }
        return $rec_data;
    }
}