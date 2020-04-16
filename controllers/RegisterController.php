<?php
/**
 * Created by PhpStorm.
 * User: lihao
 * Date: 2018/11/3
 * Time: 13:56
 */

namespace app\controllers;

use app\modules\models\LoginFormModle;
use app\modules\services\MessageService;
use app\modules\services\RegisterService;
use app\modules\services\LoginService;
use app\modules\services\AesService;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii;
use yii\filters\VerbFilter;
use yii\captcha\CaptchaValidator;

class RegisterController extends BasemController
{
    public function init(){
        $this->is_mast_login=true;
        parent::init();
    }

    public function actionIndex()
    {
        $title = '注册'.' - '.$this->coopInfo['site_title'];
        //获取注册成功回跳地址
        $fromUrl=LoginService::handleFromUrl();
        //渲染
        $loginForm = new LoginFormModle();//这里要把刚才写的类new下，注意你们要引入文件路径额

        $pageStr='';
        $pageStr .= $this->renderPartial('/public/header_tpl',array('header_title'=>$title));
        $bodyData=array(
            'loginForm'=>$loginForm,
            'fromUrl'=>$fromUrl,
            'site_name'=>$this->coopInfo['site_title']
        );
        $pageStr .= $this->renderPartial('/register/register',$bodyData);
        $pageStr .= $this->renderPartial('/public/footer_tpl');
        return $pageStr;
    }

    //发送短信验证码，发送之前先验证验证码是否正确
    public function actionPhone_code(){
        $data['phone'] = Yii::$app->request->post("tel_num") ;
        if(!preg_match('/^1[3-9]([0-9]{9})$/',$data['phone'])){
            return json_encode(['status'=>0,'msg'=>'手机号码格式不正确']);
        }
        $imgVerifyCode = Yii::$app->request->post("img_code") ;
        $caprcha = new CaptchaValidator();
        $caprcha->captchaAction = '/home/register/captcha';
        $verifyRs = $caprcha->validate($imgVerifyCode);
        if($verifyRs==false){
            return json_encode(["status"=>'0',"msg"=>"图形验证码有误"]);
        }
        $data['type_id'] = 1;   //1注册 2找回密码 3更换手机号
        $reData=MessageService::getDetail($data);
        if(isset($reData['sign'])) unset($reData['sign']);
        if(isset($reData['data'])) unset($reData['data']);
        return json_encode($reData);
    }

    //验证短息验证码
    public function actionTo_reg(){
        $data['phone'] = Yii::$app->request->post("tel_num");
        $data['code'] = Yii::$app->request->post("phone_code");
        $data['passwd'] = Yii::$app->request->post("passwd");
        $data['nickname'] = Yii::$app->request->post("nickname");
        $data['passwd']=urldecode($data['passwd']);
        $data['nickname']=urldecode($data['nickname']);
        if(!preg_match('/^1[3-9]([0-9]{9})$/',$data['phone'])){
            return json_encode(['status'=>0,'msg'=>'手机号码格式不正确']);
        }
        if(!preg_match('/^([0-9]{4,})$/',$data['code'])){
            return json_encode(['status'=>0,'msg'=>'短信验证码错误']);
        }
        if(!preg_match('/^.{6,20}$/',$data['passwd'])){
            return json_encode(['status'=>0,'msg'=>'密码必须是6-20位']);
        }
        if(empty($data['nickname'])){
            return json_encode(['status'=>0,'msg'=>'请填写昵称']);
        }
        if(strlen($data['nickname'])>60){
            return json_encode(['status'=>0,'msg'=>'昵称太长了，不能大于20汉字']);
        }
        //先验证短信验证码
        $para=array(
            'type_id'=>1, //1注册 2找回密码 3更换手机号
            'phone'=>$data['phone'],
            'code'=>$data['code']
        );
        $reData = RegisterService::toVerifyCode($para);
        if(!isset($reData['status'])){
            return json_encode(["status"=>'0',"msg"=>"短信验证码验证失败"]);
        }
        else{
            if(!$reData['status']){
                return json_encode($reData);
            }
        }
        //去注册
        $para=array(
            'username'=>$data['phone'],
            'passwd'=>$data['passwd'],
            'nickname'=>$data['nickname'],
            'copartner_id'=>$this->coopInfo['copartner_id']
        );
        $reData = RegisterService::toReg($para);
        if(!isset($reData['status'])){
            return json_encode(["status"=>'0',"msg"=>"注册失败"]);
        }
        else{
            if($reData['status']){
                $userInfo=json_encode($reData['msg']);
                $userInfo=AesService::encrypt($userInfo);
                Yii::$app->session->set('userInfo',$userInfo);
                return json_encode(["status"=>'1',"msg"=>"注册成功"]);
            }
            else{
                return json_encode($reData);
            }
        }
    }

    //用户隐私协议
    public function actionAgreement(){
        $title = '服务协议';
        $pageStr='';
        $pageStr .= $this->renderPartial('/public/header_tpl',array('header_title'=>$title));
        $pageStr .= $this->renderPartial('/register/user_protocol');
        return $pageStr;
    }

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
//                 'captcha' =>
//                    [
//                        'class' => 'yii\captcha\CaptchaAction',
//                        'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
//                    ],  //默认的写法
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'backColor'=>0x00B956,//背景颜色
                'maxLength' => 4, //最大显示个数
                'minLength' => 4,//最少显示个数
                'padding' => 5,//间距
                'height'=>40,//高度
                'width' => 130,  //宽度
                'foreColor'=>0xffffff,     //字体颜色
                'offset'=>4,        //设置字符偏移量 有效果
                //'controller'=>'login',        //拥有这个动作的controller
                'fontFile' => '@webroot/ttf/Baker.ttf'
            ],
        ];
    }
}