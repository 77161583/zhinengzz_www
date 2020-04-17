<body>
<div class="header">
    注册轻轻考
    <a href="/home/member"><span></span></a>
</div>
<div class="login">
	<form>
		<ul>
			<li>
				<div class="rePhone">请完善以下账号信息进行注册 <input type="text" class="tel_num" name="tel_num" value=<?php echo $tel_num;?>> <strike></strike></div>
			</li>
			<li>
				<input type="text" class="nickname" placeholder="请输入昵称，12个字符以内" />
			</li>
			<li>
				<input type="password" class="passwd" placeholder="请输入密码，密码长度6~12字符" />
			</li>
			<li>
				<span class="register on">完成注册</span>
			</li>
		</ul>
	</form>
</div>
<script>
    layui.use('layer', function() {});
    $('.register').click(function () {
        var nickname = $('.nickname').val();
        var password = $('.passwd').val();
        var tel_num = $('.tel_num').val();
        // if(tel_num == ''){
        //     window.location.href="/home/register/index"
        // }
        if(password.length < 6){
            layer.msg('密码不能不能小于6位!');
        }
        if(password == ''){
            layer.msg('密码不能为空！');
        }
        if(nickname == ''){
            layer.msg('昵称不能为空！');
        }
        $.ajax({
            url: "/home/register/personal_information",
            dataType: 'json',
            type: "POST",
            async: false,
            data: {
                'tel_num': tel_num,
                'nickname': nickname,
                'password': password,
                '_csrf': '<?php echo \Yii::$app->request->csrfToken?>',
            },
            success: function (data) {
                if (data.status = '1'){
                    layer.msg(data.msg);
                }else{
                    layer.msg(data.msg);
                }
            }
        });
    })
</script>
</body>
</html>