<?php foreach ($data as $key => $r){?>
<div class="act-item" onclick='detail("<?=$r['id'];?>")'>
    <img  src="<?= \Yii::$app->params['fileserverhost'].$r['litimg'];?>" class="inline-img">
    <div  class="to-inline">
        <p  class="inline-title"><?=$r['title']?></p>
        <p  class="inline-sth">发布时间：<?php echo !empty($r['diy_time'])?date('Y-m-d',$r['diy_time']):date('Y-m-d',$r['add_time'])?></p>
        <p  class="inline-info"><?=$r['description'];?></p>
    </div>
</div>
<?php }?>
<div id="page">
    <?php echo $pageStr;?>
</div>