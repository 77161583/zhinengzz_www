<?php


namespace app\controllers;

use app\services\ClassTypeService;
use app\services\ListService;
use app\services\PublicService;
use Yii;
use yii\web\Controller;
class IndexController extends Controller
{
    public function actionIndex()
    {
        $header_category = '';
        //menu
        $menu = ClassTypeService::getClassType();
        //banner
        $banner = PublicService::getAds(1);
        //center
        $center = PublicService::getAds(2);
        //coop
        $coop = PublicService::getAds(3);
        //最新资讯
        $index_news_data = ListService::getIndexData();
        //首页资讯子类
        $child_type = ClassTypeService::geyClassTypeChild(2);
        $header_data=array(
            'the_title'=>'1',
            'the_keywords'=>'2',
            'the_description'=>'3',
            'header_category'=>$header_category,
            'menu'=>$menu,
            'banner'=>$banner,
            'center'=>$center,
            'coop'=>$coop,
            'index_news_data'=>$index_news_data,
            'child_type'=>$child_type,
        );
        $pageStr = '';
        $pageStr .= $this->renderPartial('/public/header',$header_data);
        $pageStr .= $this->renderPartial('/index/index',$header_data);
        $pageStr .= $this->renderPartial('/public/footer');
        return $pageStr;
    }
}
