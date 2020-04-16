<?php
/**
 * Created by PhpStorm.
 * User: lihao
 * Date: 2018/10/31
 * Time: 15:11
 */
namespace app\controllers;

use app\controllers\BasemController;
use app\modules\services\LoginService;
use app\modules\services\RegisterService;
use app\modules\services\AesService;
use yii\web\Controller;
use Yii;

class LoginController extends BasemController
{
    public function actionIndex(){
        //获取登录成功回跳地址
        $fromUrl=LoginService::handleFromUrl();
        //渲染页面
        $title = '登录'.' - '.$this->coopInfo['site_title'];
        $pageStr='';
        $pageStr .= $this->renderPartial('/public/header_tpl.php',array('header_title'=>$title));
        $body_data=array(
            'fromUrl'=>$fromUrl,
            'site_title'=>$this->coopInfo['site_title']
        );
        $pageStr .= $this->renderPartial('/login/login',$body_data);
        return $pageStr;
    }

    public function actionLogin(){
        //13161147465   000000
        $data['username'] = \Yii::$app->request->post("username");
        $data['passwd'] = \Yii::$app->request->post("password");
        $data['passwd']=urldecode($data['passwd']);
        $data['timestamp'] = time();
        $reData=LoginService::toLogin($data);

        if(isset($reData['status'])){
            if($reData['status']){
                $userInfo=json_encode($reData['msg']);
                $userInfo=AesService::encrypt($userInfo);
                Yii::$app->session->set('userInfo',$userInfo);
                $reData['status'] = '1';
                $reData['msg'] = '登录成功';
            }
            else{
                $reData['status'] = '0';
                $reData['msg'] = '登录名或密码错误';//$reData['msg'];
            }
        }else{
            $reData['status'] = '0';
            $reData['msg'] = '登录失败';
        }
        echo json_encode($reData);
        exit;
    }


    public function actionLogout(){
        Yii::$app->session->remove('userInfo');
        header('Location:/home/login');
        exit;
    }
}