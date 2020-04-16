<?php

namespace app\controllers;
use app\modules\home\services\MemberService;
use Yii;
use yii\web\Controller;
use app\modules\home\services\AesService;
use app\modules\home\models\CoopDomain;

class BasemController extends Controller
{
    //此处为登录处理定义开始 20181016
    public $is_mast_login=false;
    public $is_mast_goto=false;
    public $userInfo=array();
    public $coopInfo=[];
    public function init()
    {
        //设置中国时区
        date_default_timezone_set('PRC');
        parent::init();
        if (!session_id()) {
            session_start();
        }
        if($this->is_mast_login){
            $this->checkLogin();
        }
        $url = parse_url(\Yii::$app->request->hostInfo);
        if(!isset($url['host'])||empty($url['host'])) exit('访问出错啦');
        $coopInfo=CoopDomain::find()
            ->where(
                'domain_name=:domain_name',
                [':domain_name'=>$url['host']]
            )
            ->asArray()->one();
        if(!$coopInfo) exit('访问出错啦');
        $this->coopInfo=$coopInfo;
    }
    //此处为登录处理结束

    //此处为登录判断开始，20181016
    public function checkLogin(){
        $result=Yii::$app->session->get('userInfo');
        if(!$result&&$this->is_mast_goto){
            exit('<script>top.location.href="/home/login"</script>');
            //header('Location:/admin/login');
            exit;
        }
        if($result){
            $result=AesService::decrypt($result);
            $result=json_decode($result,true);
            //检查user_key
            if($this->is_mast_goto) {
                $para = array(
                    'userid' => $result['userid'],
                    'user_key' => $result['user_key']
                );
                $chkResult = MemberService::checkUserKey($para);
                if (!$chkResult) {
                    exit('<script>alert("您的账户在别处登录，如密码泄露请及时重置");top.location.href="/home/login/logout"</script>');
                    //header('Location:/login/login');
                    exit;
                }
            }
            //返回结果
            $this->userInfo=$result;
        }
    }
    //此处为结束

    public static function checkUserKey(){
        $result=Yii::$app->session->get('userInfo');
        if(!$result){
            return false;
        }
        if($result){
            $result=AesService::decrypt($result);
            $result=json_decode($result,true);
            //检查user_key
            $para = array(
                'userid' => $result['userid'],
                'user_key' => $result['user_key']
            );
            $chkResult = MemberService::checkUserKey($para);
            if (!$chkResult) {
                return false;
            }
            //返回结果
            return true;
        }
        return false;
    }
}