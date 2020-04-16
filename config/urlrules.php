<?php
return
    array(
        'index' => 'index/index', //整站默认首页

        'login.html' => '/login/index',       //登录页面
        'logout.html' => '/login/logout',     //登出
        'reg.html'=> '/register/toreg',  //注册页面
        'signin' => '/login/login',      //点击登录
        'to_reg' => '/register/to_reg' ,     //提交注册
        'phone_code' => '/register/phone_code',      //图片验证码

        '/<classname:latestNews|companyNews|industryNews|serverList|personnelService|telUs|aboutUs|smsCourse|collegeCourses|classService>/?' => 'list/index',
        '/detail/<id:\d+>.html'=>'detail/index',//内容页
);