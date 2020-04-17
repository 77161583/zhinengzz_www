<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>智能智造</title>
    <link type="text/css" href="/css/base.css" rel="stylesheet"/>
    <link type="text/css" href="/css/header.css" rel="stylesheet">
    <link type="text/css" href="/css/archefoucs.css" rel="stylesheet"/>
    <link type="text/css" href="/css/index.css" rel="stylesheet"/>
    <link type="text/css" href="/css/style.index.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="/css/footer.css">
    <link rel="shortcut icon" href="/favicon.ico" />
    <script type="text/javascript" src="/layui/layui.js"></script>
    <script type="text/javascript" src="/js/jquery-1.9.1.min.js" ></script>
    <script type="text/javascript" src="js/jquery.SuperSlide.2.1.3.js"></script>
    <script>
        var load_index;
        function _open_loading(){
            /*layui.use('layer', function() {
                load_index = layer.msg('加载中，请稍候',{icon: 16,time:false,shade:0.8});
            });*/
        }

        function _close_loading(){
            /*layui.use('layer', function() {
                layer.close(load_index);
            });*/
        }
    </script>
    <!--[if IE ]>
    <script src="/js/html5.js"></script>
    <script>
        $(function(){
            $("#service .icoList li").hover(function(){
                var i=$("#service .icoList li").index(this);
                $(this).addClass('cur').siblings().removeClass('cur');
                $('.service-img .ImgList li').eq(i).addClass('cur').siblings('.service-img .ImgList li').removeClass('cur');
            })
        })
    </script>
    <![endif]-->

</head>
<body background="/images/back.png">
<!--heade这事一次更新时间3.1r-->
<div class="header">
   <div class="header_i m0">
        <i><img src="/images/logo.png" width="159" height="51" alt="logo"></i>
        <ul id="nav" class="nav">
            <li>
                <a href="/" class="a ahover navbj">
                    <div class="three-d">
                        <div class="navCn">HOME</div>
                        <div class="navEn navenie7">HOME</div>
                    </div>
                </a>
            </li>
            <?php foreach ($menu as $k => $r){?>
                <?php  $url = '';
                if($r['id'] == 19){
                    $url = $r['linkurl'];
                }elseif ($r['id'] == 20 || $r['id'] == 21){
                    $url = '/detail/'.$r['id'].'.html';
                }
                ?>
                <li>
                    <a target="_blank" href="<?=$url;?>" class="b ahover ">
                        <div class="three-d">
                            <div class="navCn"><?=$r['class_name']?></div>
                            <div class="navEn navenie7"><?=$r['class_name']?></div>

                        </div>
                    </a>
                    <?php if(!empty($r['son'])){?>
                        <ul class="ul-list">
                            <?php foreach($r['son'] as $kk => $rr){?>
				<?php if(!empty($rr['linkurl'])){?>
					<li><a href="<?=$rr['linkurl']?>"><?=$rr['class_name']?></a></li>
				<?php }else{?>				
                               		 <li><a href="/<?=$rr['class_enname']?>"><?=$rr['class_name']?></a></li>
				<?php }?>
                            <?php }?>
                        </ul>
                    <?php }?>
                </li>
            <?php }?>
            <li >
                <a id="login_in" href="javascrip:;" class="ahover navbj" >
                    <div class="three-d">
                        <div class="navCn" >登录</div>
                    </div>
                </a>
            </li>
        </ul>
    </div>
</div>
<script>
    layui.use('layer', function() {});
    $('#login_in').click(function(){
        layer.open({
            type: 2, //page层
            area: ['913px', '748px'],
            skin: 'myskin',
            title: false,
            shade: 0.7, //遮罩透明度
            moveType: 1, //拖拽风格，0是默认，1是传统拖动
            content: ['/login.html', 'no'] //这里content是一个普通的String
        });
    });
</script>
