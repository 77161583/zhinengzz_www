<?php
/**
 * Created by PhpStorm.
 * User: lihao
 * Date: 2018/10/31
 * Time: 15:11
 */
namespace app\controllers;

use app\models\LoginFormModle;
use app\services\LoginService;
use Yii;
use yii\web\Controller;
use yii\web\Session;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;


class LoginController extends BasemController
{
    public function actionIndex(){
        //获取登录成功回跳地址
        $fromUrl=LoginService::handleFromUrl();
        //渲染页面
        $loginForm = new LoginFormModle();//这里要把刚才写的类new下，注意你们要引入文件路径额
        $title = '登录';
        $pageStr='';
        $pageStr .= $this->renderPartial('/public/header_reg');
        $body_data=array(
            'loginForm'=>$loginForm,
            'fromUrl'=>$fromUrl,
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

    /**********************verifyCode****************************/
    /**
     * @用户授权规则
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup','login'],//这里一定要加
                'rules' => [
                    [
                        'actions' => ['login','captcha'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions'=>['logout','edit','add','del','index','users','thumb','upload','cutpic','follow','nofollow'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
    /**     图片
     * @验证码独立操作  下面这个actions注意一点，验证码调试出来的样式也许你并不满意，这里就可
    以需修改，这些个参数对应的类是@app\vendor\yiisoft\yii2\captcha\CaptchaAction.php,可以参照这个
    类里的参数去修改，也可以直接修改这个类的默认参数，这样这里就不需要改了
     */
    public function actions()
    {
        return  [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'backColor'=>0x00B956,//背景颜色
                'maxLength' => 4, //最大显示个数
                'minLength' => 4,//最少显示个数
                'padding' => 5,//间距
                'height'=>40,//高度
                'width' => 102,  //宽度
                'foreColor'=>0xffffff,     //字体颜色
                'offset'=>4,        //设置字符偏移量 有效果
                //'controller'=>'login',        //拥有这个动作的controller
                'fontFile' => '@webroot/ttf/Baker.ttf'
            ],
        ];
    }
}