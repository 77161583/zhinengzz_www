<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="/css/base.css">
	<link rel="stylesheet" type="text/css" href="/css/list.css">
</head>
<div id="slideBox" class="slideBox slideBox2">
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
<body class="bg">
	<div class="activity-info pt20">
		<div class="activitymsg">
			<div class="top">
				<div class="topbox">
					<p class="title"><?=$data['title'];?></p>
<!--					<p class="msg">DETAIL OF ACTIVITY</p>-->
				</div>
			</div> 
			<!-- 内容 -->
			<div class="content">
                <?=$data['content'];?>
			</div>
		</div>
	</div>
</body>
</html>