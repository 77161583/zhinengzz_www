<?php
namespace app\services;

class LoginService
{

    public static function toLogin($data){
        $apiUrl=AutoService::getApiInfo()['home']['login'];
        $result=AutoService::requestApi($apiUrl,$data);
        if(!isset($result['status'])||$result['status']!=100){
            if(isset($result['msg'])) {
                return array('status'=>0,'msg'=>$result['msg']);
            }
            else{
                return array('status'=>0,'msg'=>'登录失败');
            }
        }
        else{
            $reData=AutoService::decryptData($result);
            return array('status'=>1,'msg'=>$reData);
        }
    }

    public static function handleFromUrl(){
        //不记录来源的页面
        $outFrom=array(
            'home',
            'findpassword',
            'handleorder'
        );
        $isRemember=1;
        $fromUrl=\Yii::$app->request->getReferrer();
        $nowUrl=\Yii::$app->request->getHostInfo().\Yii::$app->request->url;
        if($fromUrl!=''&&$fromUrl!=$nowUrl){
            foreach($outFrom as $v){
                if(strstr($fromUrl,$v)) $isRemember=0;
            }
            if($isRemember){
                \Yii::$app->session->set('fromUrl',$fromUrl);
            }
        }
        $fromUrl=\Yii::$app->session->get('fromUrl');
        //判断下，如果当前页面的url跟记录的url一样，返回首页
        if($fromUrl!=''&&$fromUrl==$nowUrl){
            $fromUrl='/index';
        }
        if(empty($fromUrl)) $fromUrl='/index';
        return $fromUrl;
    }
}