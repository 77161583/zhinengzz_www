<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>智能制造</title>
    <link type="text/css" href="/css/base.css" rel="stylesheet"/>
    <link type="text/css" href="/css/header.css" rel="stylesheet">
    <link type="text/css" href="/css/archefoucs.css" rel="stylesheet"/>
    <link type="text/css" href="/css/index.css" rel="stylesheet"/>
    <link type="text/css" href="/css/style.index.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="/css/footer.css">
    <link rel="shortcut icon" href="/favicon.ico" />
    <script type="text/javascript" src="/js/jquery-1.9.1.min.js" ></script>
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
    <style>
        .service-nav{height:190px!important;}
        .service-img{height:403px!important;margin-bottom:30px;}
        .animate-opacity{background:#000;position:relative;z-index:999;width: 100%;height: 100%;opacity: 0.75; filter:alpha(opacity=35);
            -moz-opacity:0.75; /* 老版Mozilla */
            -khtml-opacity:0.75;/* 老版Safari */
            opacity:0.75; }
    </style>
</head>
<body>
<!--header-->
<div class="header">
    <div class="top">
        <div class="top_i m0">
            <p class="fr text mr20">
                <img src="images/map.png" width="44" height="22" class="map fl mr10">
                <span style="float: left; font-size: 12px; height:24px; line-height: 24px; margin-top: 5px; margin-right: 10px; color:#838383;">CHUANG LIAN GLOBAL WEBSITE</span>
                <a href="javascript:;">繁體</a>
                <a href="javascript:;">English</a>
            </p>
        </div>
    </div>
    <div class="header_i m0">
        <i><img src="images/logo.png" width="159" height="51" alt="logo"></i>
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
                <li>
                    <a target="_blank" href="<?=$r['linkurl']?>" class="b ahover ">
                        <div class="three-d">
                            <div class="navCn"><?=$r['class_name']?></div>
                            <div class="navEn navenie7"><?=$r['class_enname']?></div>
                        </div>
                    </a>
                    <?php if(!empty($r['son'])){?>
                        <ul class="ul-list">
                            <?php foreach($r['son'] as $kk => $rr){?>
                                <li><a target="_blank" href="/<?=$rr['class_enname']?>"><?=$rr['class_name']?></a></li>
                            <?php }?>
                        </ul>
                    <?php }?>
                </li>
            <?php }?>
        </ul>
    </div>
</div>