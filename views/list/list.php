<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>列表页</title>
	<link rel="stylesheet" type="text/css" href="/css/base_list.css">
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
                    <li><a href="<?=$r['redirect_uri']?>" target="_blank"><img src="<?=$r['picurl']?>" height="500" /></a></li>
                <?php }?>
            <?php }?>
        </ul>
    </div>
    <!-- 下面是前/后按钮代码，如果不需要删除即可 -->
    <a class="prev" href="javascript:void(0)"></a>
    <a class="next" href="javascript:void(0)"></a>
</div>
<body class="bg">
	<div class="activity-list" id="data-area">
	</div>
</body>
<script>
    jQuery(".slideBox").slide({mainCell:".bd ul",effect:"leftLoop",autoPlay:true});
    layui.use('layer', function() {});
    var nowPage = 1;
    _to_search();

    //点击详情
    function detail(id) {
        window.open( '/detail/'+id+'.html');
    }

    //获取广告
    function _to_search(page=1){
        nowPage = page;
        var state = $('#state').val();
        var class_id = "<?=$class_id;?>";
        _open_loading();
        $.ajax({
            dataType : "text",
            type: "POST",
            async:false,
            url: '/list/pull_data',
            data: {
                'state':state,
                'class_id':class_id,
                'page':page,
                '_csrf':'<?php echo Yii::$app->request->csrfToken?>'
            },
            success: function(msg){
                $('#data-area').html(msg);
            }
        });
        _close_loading();
    }
</script>
</html>