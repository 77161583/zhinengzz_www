<?php
return array(
        'index' => 'index/index', //整站默认首页
        '/<classname:latestNews|companyNews|industryNews|serverList|personnelService|telUs|aboutUs|smsCourse|collegeCourses|classService>/?' => 'list/index',
        '/detail/<id:\d+>.html'=>'detail/index',//内容页
);