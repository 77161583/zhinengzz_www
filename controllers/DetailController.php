<?php


namespace app\controllers;


use app\services\ClassTypeService;
use app\services\DetailService;
use app\services\PublicService;
use yii\web\Controller;

class DetailController extends Controller
{
    public function actionIndex()
    {
        //menu
        $menu = ClassTypeService::getClassType();
        //banner
        $banner = PublicService::getAds(1);
        $header_data=array(
            'menu'=>$menu,
        );
        //获取详情
        $id = \Yii::$app->request->get('id');
        if(!$id) $this->show404();
        $dump = DetailService::getDetail($id);
        $data=array(
            'data'=>$dump,
            'banner'=>$banner,
        );
        $pageStr = '';
        $pageStr .= $this->renderPartial('/public/header',$header_data);
        $pageStr .= $this->renderPartial('/detail/index',$data);
        $pageStr .= $this->renderPartial('/public/footer');
        return $pageStr;
    }
}