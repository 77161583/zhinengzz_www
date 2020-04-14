<div id="slideBox" class="slideBox">
    <div class="hd">
        <?php if (!empty($banner)){?>
        <ul>
            <?php foreach ($banner as $key => $r){?>
                <li></li>
            <?php }?>
        </ul>
        <?php }?>
    </div>
    <div class="bd">
        <ul>
            <?php if (!empty($banner)){?>
                <?php foreach ($banner as $key => $r){?>
                    <li><a href="<?=$r['redirect_uri']?>" target="_blank"><img src="<?=$r['picurl']?>" /></a></li>
                <?php }?>
            <?php }?>
        </ul>
    </div>
    <!-- 下面是前/后按钮代码，如果不需要删除即可 -->
    <a class="prev" href="javascript:void(0)"></a>
    <a class="next" href="javascript:void(0)"></a>
</div>
<div class="main-wrap m0 mt10" >
    <div id="container">
        <section id="service" class="service-img">
            <img src="<?= !empty($center[0]['picurl'])?$center[0]['picurl']:''?>" alt="" width="1200" height="234">
        </section>
    </div>
<!--    新闻-->
    <div class="main-news">
        <div class="new-main m0">
            <div class="oh">
                <p class="tc fl" style="font-size: 24px;">最新资讯</p>
                <div class="new-nav fr">
                    <ul>
                        <?php foreach ($child_type as $key => $r){?>
                            <li class="<?php if($key==0){echo 'active';}?>"><?=$r['class_name'];?></li>
                        <?php }?>
                    </ul>
                </div>
            </div>
            <?php foreach ($child_type as $k => $rr){?>
                <div class="<?php if($k==0){echo 'new-pic-lr cb on pr';}else{echo 'new-pic-lr cb pr';}?>">
                    <div class="new-picslider m0">
                        <div class="hd2">
                            <a class="next"><img src="images/left-btn_03.png"/></a>
                            <a class="prev"><img src="images/right-btn_05.png"/></a>
                        </div>
                        <div class="slider bd m0">
                            <ul>
                                <?php foreach ($index_news_data[$rr['class_enname']] as $key => $r){?>
                                    <li>
                                        <div class="new-imgbox">
                                            <h3><?=!empty($r['diy_time'])?date('Y-m-d',$r['diy_time']):date('Y-m-d',$r['add_time'])?></h3>
                                            <a target="_blank" href="/detail/<?=$r['id'];?>.html">
                                                <p class="box-bt"><?= mb_substr($r['title'],0,26);?><?php if(mb_strlen($r['title'])>26)echo '...';?></p>
                                                <p class="img"><img src="<?= \Yii::$app->params['fileserverhost'].$r['litimg'];?>" width="331" height="150" alt="图片"/></p>
                                            </a>
                                            <p class="new-text"><?= mb_substr($r['description'],0,55,'utf8');?></p>
                                        </div>
                                    </li>
                                <?php }?>
                            </ul>
                        </div>
                    </div>
                    <p class="xq-btn cb m0"><a href="/<?=$rr['class_enname'];?>">查看详情</a></p>
                </div>
            <?php }?>

        </div>
    </div>
<!--    合作伙伴-->
        <div class="new-main2 m0">
            <div class="oh">
              <p class="tc fl" style="font-size: 24px;">合作伙伴</p>
            </div>
            <div class="cooperative-partner m0">
                <ul>
                    <?php foreach ($coop as $key => $r){?>
                        <?php if($key == 10){break;}?>
                    <li>
                        <a href="<?=$r['redirect_uri']?>" title="汽车人才培训网" target="_blank">
                            <img src="<?=$r['picurl']?>" height="66" alt="logo"/>
                        </a>
                    </li>
                    <?php }?>
                </ul>
            </div>
<!--           <p class="xq-btn cb" style="margin: 0 auto"><a href="javascript:;">查看详情</a></p>-->
         </div>
    </div>

<script>
    jQuery(".slideBox").slide({mainCell:".bd ul",effect:"leftLoop",autoPlay:true});
    jQuery(".new-picslider").slide({mainCell:".slider ul",autoPage:true,effect:"leftLoop",autoPlay:true,vis:3,trigger:"click"});
</script>
