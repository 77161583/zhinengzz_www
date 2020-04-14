<?php


namespace app\services;


use app\models\EduAppAds;

class PublicService extends \yii\base\Model
{
    //get Ads
    public static function getAds($category_id)
    {
        $img =  EduAppAds::find()->where(
            'start_time<=:time and end_time>=:time and category_id=:category_id and state=1',[':time'=>time(),'category_id'=>$category_id]
        )->asArray()->all();
        foreach ($img as $key => $r){
            $img[$key]['picurl'] = \Yii::$app->params['fileserverhost'].$r['picurl'];
        }
        return $img;
    }

    //分页处理
    public static function handleAjaxPage($page=1,$page_size=10,$all_num=0,$uri=''){
        $str='<div class="layui-box layui-laypage layui-laypage-default page tc">';
        //计算总页数
        $all_page=ceil($all_num/$page_size);
        //拼接参数
        $para='';
        //拼接返回字符串开始
        $str.='<span class="layui-laypage-count">共 '.$all_num.' 条，'.$all_page.'页</span>';
        if($page<2) {
            //$str.='<a href="javascript:;" class="layui-laypage-prev layui-disabled">首页</a>';
            $str.='<a href="javascript:;" class="layui-disabled"> < </a>';
            $str.='<span class="layui-laypage-curr"><em class="layui-laypage-em"></em><em>1</em></span>';
        }
        else{
            //$str.='<a href="'.$uri.'?page=1'.$para.'" class="layui-laypage-prev layui-disabled">首页</a>';
            $str.='<a onclick="'.$uri.'('.($page-1).')" href="javascript:void(0);"> < </a>';
            $str.='<a onclick="'.$uri.'(1)" href="javascript:void(0);">1</a>';
        }
        //处理当前页前的
        if($page-3>2) $str.='<span class="layui-laypage-spr">…</span>';
        for($i=$page-3;$i<$page;$i++){
            if($i>1) $str.='<a onclick="'.$uri.'('.$i.')" href="javascript:void(0);">'.$i.'</a>';
        }
        //当前页
        if($page>1){
            $str.='<span class="layui-laypage-curr"><em class="layui-laypage-em"></em><em>'.$page.'</em></span>';
        }
        //当前页后面
        for($i=$page+1;$i<=$page+3;$i++){
            if($i<$all_page) $str.='<a onclick="'.$uri.'('.$i.')" href="javascript:void(0);">'.$i.'</a>';
        }
        if($all_page>$page+4) $str.='<span class="layui-laypage-spr">…</span>';
        //最后一页
        if($all_page>1&&$all_page!=$page) {
            $str.='<a onclick="'.$uri.'('.$all_page.')" href="javascript:void(0);">'.$all_page.'</a>';
        }
        if($page>=$all_page){
            $str.='<a href="javascript:;" class="layui-disabled ivu-page-next"> > </a>';
            //$str.='<a href="javascript:;" class="layui-laypage-next">尾页</a>';
        }
        else{
            $str.='<a onclick="'.$uri.'('.($page+1).')" href="javascript:void(0);"> > </a>';
            //$str.='<a href="'.$uri.'?page='.$all_page.$para.'" class="layui-laypage-next">尾页</a>';
        }
        $str.='</div>';
        return $str;
    }
}