<?php


namespace app\controllers;

use app\models\EduClassType;
use app\services\ClassTypeService;
use app\services\ListService;
use app\services\PublicService;
use yii\web\Controller;
use Yii;

class ListController extends Controller
{
    public function actionIndex()
    {
        $classname = Yii::$app->request->get('classname','');
        if(!$classname) $this->show404();
        $classInfo = ClassTypeService::getClassTypeId($classname);
        if(!$classInfo) $this->show404();
        if(!$classInfo['id']) $this->show404();
        //menu
        $menu = ClassTypeService::getClassType();
        //banner
       if($classInfo['id']==19) {
        	$banner = PublicService::getAds(5);
       }else{
       		 $banner = PublicService::getAds(4);
       }
        $header_data=array(
            'menu'=>$menu,
        );
        $data = array(
            'class_id' => $classInfo['id'],
            'banner'=>$banner,
        );
        $pageStr = '';
        $pageStr .= $this->renderPartial('/public/header',$header_data);
        $pageStr .= $this->renderPartial('/list/list',$data);
        $pageStr .= $this->renderPartial('/public/footer');
        return $pageStr;
    }

    //获取列表
    public function actionPull_data()
    {
        $page=\Yii::$app->request->post('page');
        $class_id=\Yii::$app->request->post('class_id');
        $state=\Yii::$app->request->post('state');
        $page_size=2;
        $data = [
            'state'=>$state,
            'class_id'=>$class_id,
        ];
        $result = ListService::getListData($page,$page_size,$data);
        $pageStr=PublicService::handleAjaxPage($page,$page_size,$result['count']['nums'],'_to_search');
        //渲染模板
        $pageData=array(
            'data'=>$result['data'],
            'pageStr'=>$pageStr,
        );
        return $this->renderPartial('index_ajax',$pageData);
    }
}