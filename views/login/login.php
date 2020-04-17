<?php
use common\widgets;
use yii\captcha\Captcha;
?>
<div class="loginBoxA">
    <div class="fl loginPic">
        <h1 class="tc"><img src="/copy_style/images/logo.png" width="200"></h1>
        <h3 class="tc mt20">培养互联网时代核心人才的新职业大学</h3>
    </div>
    <div class="loginWarp fl">
        <div class="loginMain">
            <h1 class="loginTitle">欢迎登录</h1>
            <form>
                <p>
                    <label>账号</label>
                    <input type="text" class="ipt tel_num" placeholder="请输入手机号码"/>
                </p>
                <p>
                    <label>密码</label>
                    <input type="password" class="ipt password" placeholder="请输入密码"/>
                </p>
                <p class="tc">
                    <input type="submit" value="登录"  onclick="_login();" class="btn"/>
                </p>
            </form>
            <p class="tc mt50 jump" ><a href="javascript:;" id="registerBtn">没有账号？去注册</a></p>
            <p class="tc mt20 jump"><a href="javascript:;" id="resetBtn">重置密码</a></p>
        </div>
        <div class="registeMain">
            <h1 class="loginTitle">欢迎注册</h1>
            <form action="" method="post" enctype="multipart/form-data" name="form" >
                <p>
                    <label>手机号</label>
                    <input type="text" class="ipt re_tel_num" name="re_tel_num" placeholder="请输入手机号码" />
                </p>
                <p>
                    <label>图片验证码</label>
                    <input type="text" name="re_img_code" class="ipt smipt" placeholder="请输入图片验证码" />
                    <?php echo Captcha::widget(['name'=>'captchaimg','captchaAction'=>'login/captcha','imageOptions'=>['id'=>'captchaimg', 'name'=>'captchaimg','title'=>'换一个', 'alt'=>'换一个', 'style'=>'cursor:pointer;margin-left:11px;'],'template'=>'{image}']);?>
                </p>
                <p>
                    <label>手机验证码</label>
                    <input type="text" class="re_phone_code ipt smipt" name="re_phone_code" onkeyup="update_on()" placeholder="请输入手机验证码"></input>
                    <span id="get_code" class="code ml10">获取验证码</span>
                </p>
                <p>
                    <label>密码</label>
                    <input type="password" class="re_passwd ipt" name="re_passwd" placeholder="请输入密码，密码长度6~12字符" />
                </p>
                <p>
                    <label>确认密码</label>
                    <input type="password" class="passwd_two ipt" name="passwd_two" placeholder="请输入确认密码"/>
                </p>
                <p>
                    <label></label>
                    <input type="checkbox" class="checkbox"/>
                    我已阅读并接受
                </p>
                <p class="tc mt30">
                    <input type="submit" value="注册" onclick="to_reg();" class="btn"/>
                </p>
            </form>
            <p class="tc mt20 jump " ><a href="javascript:;" class="returnBtn">返回登录</a></p>

        </div>
        <div class="resetMain">
            <h1 class="loginTitle">重置密码</h1>
            <form>
                <p>
                    <label>手机号</label>
                    <input type="text" class="ipt"></input>
                </p>
                <p>
                    <label>验证码</label>
                    <input type="text" class="ipt smipt"></input>
                    <span class="code ml10">获取验证码</span>
                </p>
                <p>
                    <label>密码</label>
                    <input type="password" class="ipt"></input>
                </p>
                <p>
                    <label>确认密码</label>
                    <input type="password" class="ipt"></input>
                </p>
                <p class="tc mt30">
                    <input type="submit" value="重置密码" class="btn"></input>
                </p>
            </form>
            <p class="tc mt20 jump " ><a href="javascript:;" class="returnBtn">返回登录</a></p>

        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $("#registerBtn").click(function(){
            $(".loginMain").hide();
            $(".registeMain").show();
        });
        $(".returnBtn").click(function(){
            $(".registeMain").hide();
            $(".resetMain").hide();
            $(".loginMain").show();
        });
        $("#resetBtn").click(function(){
            $(".loginMain").hide();
            $(".resetMain").show();
        });
    })
</script>
<script type="text/javascript">
    layui.use('layer', function() {});
    //登录
    function _login(){
        var username = $('.tel_num').val();
        var password = $('.password').val();
        if(username == ''){
            layer.msg('请输入手机号!');
            return false;
        }
        if(password == ''){
            layer.msg('请输入密码!');
            return false;
        }
        $('#sub-btn1').hide();
        $('#sub-btn2').show();
        $.ajax({
            url:'/login/login',
            type:"POST",
            async:false,
            dataType:'json',
            data:{
                'username':username,
                'password':encodeURIComponent(password),
                '_csrf':'<?php echo \Yii::$app->request->csrfToken?>'
            },
            success:function(data){
                //console.log(data.status);
                if(data.status == 1){
                    window.location.href='<?php echo $fromUrl;?>';
                }
                else{
                    layer.msg(data.msg);
                }
                $('#sub-btn2').hide();
                $('#sub-btn1').show();
            },
            error:function(e){
                layer.msg('登录失败，请重试');
                $('#sub-btn2').hide();
                $('#sub-btn1').show();
            }
        });
    }

    //获取验证码
    var registerCode = 0;
    layui.use('layer', function() {});
    $('#get_code').click(function () {
        var tel_num = $('.re_tel_num').val();
        var img_code = $('.re_img_code').val();
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
            url: "/register/phone_code",
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
    //注册
    function to_reg(){
        var phone_code =  $('.re_phone_code').val();
        var tel_num =  $('.re_tel_num').val();
        var passwd =  $('.re_passwd').val();
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
            url: "/login/captcha?refresh",
            dataType: 'json',
            cache: false,
            success: function (data) {
                //将验证码图片中的图片地址更换
                $("#captchaimg").attr('src', data['url']);
            }
        });
    }
</script>