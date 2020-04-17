<?php
use common\widgets;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\base;
?>
<body>
<div class="header">
    注册 <?php echo $site_name;?>
    <a href="/home/login"><span></span></a>
</div>
<div class="headerDiv"></div>
<div class="login">
	<form action="" method="post" enctype="multipart/form-data" name="form" >
		<ul>
            <li>
                <input type="text" class="tel_num" name="tel_num" placeholder="请输入手机号码" />
            </li>
            <li>
                <?php echo Captcha::widget(['name'=>'captchaimg','captchaAction'=>'register/captcha','imageOptions'=>['id'=>'captchaimg', 'name'=>'captchaimg','title'=>'换一个', 'alt'=>'换一个', 'style'=>'cursor:pointer;margin-left:25px;'],'template'=>'{image}']);?>
                <input type="text" name="img_code" class="img_code" placeholder="请输入图片验证码" />
            </li>
			<li>
				<input type="text" class="phone_code" onkeyup="update_on()" placeholder="请输入手机验证码" />
				<input id="get_code" type="button" value="获取验证码"/>
			</li>
            <li>
                <input type="password" class="passwd" placeholder="请输入密码，密码长度6~12字符" />
            </li>
            <li>
                <input type="text" class="nickname" placeholder="请输入昵称，12个字符以内" />
            </li>
			<li>
                <span class="register on" id="btn1" onclick="to_reg();" disabled="true">注册</span>
                <span class="register on" id="btn2" disabled="true" style="display: none">注册中</span>
			</li>
			<li>
				<strong>点击上方“注册”按钮，即表示已阅读并同意<a href="/home/register/agreement">《用户协议及隐私正常》</a></strong>
			</li>

		</ul>
	</form>
</div>
<script>
    var registerCode = 0;
    layui.use('layer', function() {});
    $('#get_code').click(function () {
        var tel_num = $('.tel_num').val();
        var img_code = $('.img_code').val();
        if(tel_num==''){
            layer.msg('请输入手机号码');
            return false;
        }
        if(img_code == ''){
            layer.msg('请输入图片验证码!');
            return false;
        }
        //发送手机验证码
        $.ajax({
            url: "/home/register/phone_code",
            dataType: 'json',
            type:"POST",
            async:false,
            data:{
                'tel_num': tel_num,
                'img_code':img_code,
                '_csrf':'<?php echo \Yii::$app->request->csrfToken?>',
            },
            success: function (data) {
                layer.msg(data.msg);
                if(data.status == 100){
                    //倒计时
                    $('#get_code').addClass('click');
                    var registerCode = 59;
                    var timer = setInterval(function(){
                        if (registerCode == 0) {
                            registerCode = 59;
                            $('#get_code').attr("disabled",false);
                            clearInterval(timer);
                            $('#get_code').removeClass('click');
                            $('#get_code').val("获取验证码");
                        } else {
                            $('#get_code').val("重新发送(" + registerCode + ")");
                            $('#get_code').attr("disabled", true);
                            registerCode--;
                        }
                    },1000);

                }
                changeVerifyCode();
            }
        });
    });


    function update_on() {
        $('#btn1').attr('disabled',false);
        $('#btn1').removeClass('on');
    }

    function to_reg(){
        var phone_code =  $('.phone_code').val();
        var tel_num =  $('.tel_num').val();
        var passwd =  $('.passwd').val();
        var nickname =  $('.nickname').val();
        if(tel_num ==''){
            layer.msg('请输入手机号码');
            return false;
        }
        if(phone_code ==''){
            layer.msg('手机验证码不能为空');
            return false;
        }
        if(passwd ==''){
            layer.msg('请输入密码');
            return false;
        }
        if(nickname ==''){
            layer.msg('请输入昵称');
            return false;
        }
        $('#btn1').hide();
        $('#btn2').show();
        $.ajax({
            url: "/home/register/to_reg",
            dataType: 'json',
            type:"POST",
            async:false,
            data:{
                'tel_num': tel_num,
                'phone_code': phone_code,
                'passwd':encodeURIComponent(passwd),
                'nickname':encodeURIComponent(nickname),
                '_csrf':'<?php echo \Yii::$app->request->csrfToken?>'
            },
            success: function (data) {
                layer.msg(data.msg);
                $('#btn2').hide();
                $('#btn1').show();
                if (data.status = '1'){
                    window.location.href="<?php echo $fromUrl;?>";
                }
            }
        });
    }

    //解决验证码不刷新的问题
    $(function () {
        changeVerifyCode();
        $('#captchaimg').click(function () {
            changeVerifyCode();
        });
    });

    //更改或者重新加载验证码
    function changeVerifyCode() {
        //项目URL
        $.ajax({
            //使用ajax请求site/captcha方法，加上refresh参数，接口返回json数据
            url: "/home/register/captcha?refresh",
            dataType: 'json',
            cache: false,
            success: function (data) {
                //将验证码图片中的图片地址更换
                $("#captchaimg").attr('src', data['url']);
            }
        });
    }
</script>