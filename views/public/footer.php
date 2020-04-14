<!-- footer -->
<div class="footer mt50">
    <div class="home-footer">
        <div>
            <ul class="footer-left">
                <li>邮箱：talent@shiyenet.com.cn</li>
                <li>地址：北京市海淀区西小口路66号中关村东升科技园北领地B-2楼1层C103</li>
                <li>© Copyright 北京智能智造科技有限公司 . 京ICP备20003345号</li>
                <li><img src="/images/ba.jpg" style="float:left;"/><p style="float:left;height:20px;line-height:20px;margin: 0px 0px 0px 5px; color:#ffffff;">京公网安备 11010802030938号</p ></li >
            </ul>
            <ul class="footer-right">
<!--                <li>-->
<!--                    <img src="http://file.zhinanche.com/manage/0/1573450990633微信图片_20191104103650.jpg" width="90" height="90" />-->
<!--                    <p>微信扫一扫</p>-->
<!--                    <p>领取免费资料</p>-->
<!--                </li>-->
                <li>
                    <img src="/images/wechat.png" width="90" height="90" />
                    <p>关注公众号</p>
                    <p>获取更多资讯</p>
                </li>
            </ul>
        </div>
   	 </div>
</div>
</body>
</html>
<script type="text/javascript" src="js/archefoucs.js"></script>
<script type="text/javascript" src="js/jquery.slides.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.new-nav ul li').mouseover(function(){
            $(this).addClass('active new-pic-box').siblings().removeClass('active new-pic-box');
            var index = $(this).index();
            $('.new-pic-lr').eq(index).addClass('on').siblings().removeClass('on');
          });
        $('.new-nav ul li').eq(0).mouseover();
        $('#nav li a').click(function(){
            $('#nav li a').removeClass('curr');
            $(this).addClass('curr');
            $(".mor").css('background',"#fff");
            $(".mor img").attr("src", "images/more.png");
            $(".mor ul").hide();

        });
        $(".mor img").click(function(){
            $(".mor img").attr("src", "images/more1.png");
            $(".mor ul").show();
            $(".mor").css('background',"#14a6e1");
            $('#nav li a').removeClass('curr');
        })
        $("#nav li a").hover(function(){
            $(".mor img").attr("src", "images/more.png");
            $(".mor ul").hide();
            $(".mor").css('background',"#fff");

        })
    });
    $('.main-tab-nav ul li').mouseover(function(){
        var num = $(this).index();
        var index=$('.main-tab-nav ul li').index(this);
        if (num%4==0){$(this).siblings().removeClass();$(this).addClass('mainpicbox');}
        if(num%4==1) {$(this).siblings().removeClass();$(this).addClass('mainpicbox1');}
        if(num%4==2) {$(this).siblings().removeClass(); $(this).addClass('mainpicbox2');}
        if(num%4==3) {$(this).siblings().removeClass();$(this).addClass('mainpicbox3');}
        $(this).children('.main-text').hide();
        $(this).siblings().children('.main-text').show();
        var index = $(this).index();
    });
</script>
<script>
    var $wh=$(window).height();
    var $container=$("#container");
    var wheelNum=0;

    $("section",$container).height($wh);
    $(window).resize(function(){
        $wh=$(window).height();
        $("section",$container).height($wh);
        $container.stop().animate({top:-$wh*wheelNum},{duration:500});
    });
    $("body").on('mousewheel', function(e,dir){
        if(!$("#container").is(":animated")){
            if(dir>0){
                wheelNum=wheelNum>0?wheelNum-1:0;
            }
            if(dir<0){
                wheelNum=wheelNum<5?wheelNum+1:5;
            }
            fnPageChange(wheelNum);
        }
        setTimeout(function(){
            $(".Navigation_point li").eq(wheelNum).addClass("curs").siblings().removeClass("curs");
        },500);

    });


    function fnPageChange(wheelNum){
        if(wheelNum==4){
            $("#log").addClass("cur");
        }else
        if(wheelNum==5){
            $("#log").addClass("cur");
        }else{
            $("#log").removeClass("cur");
        }

        if(wheelNum<5){
            $container.stop().animate({top:-$wh*wheelNum},{duration:1000});
        }else{
            $container.stop().animate({top:-$wh*4-130},{duration:1000});
        }
        setTimeout(function(){
            if(wheelNum==3){
                $(".Navigation_point ul li").addClass("cur");
            }else if(wheelNum==4){
                $(".Navigation_point ul li").addClass("cur");
            }else  if(wheelNum==5){
                $(".Navigation_point ul li").addClass("cur");
            }else{
                $(".Navigation_point ul li").removeClass("cur");
            }
            if(wheelNum==4){
                $("#log").addClass("logos2");
            }else if(wheelNum==0|wheelNum==1|wheelNum==2|wheelNum==3){
                $("#log").removeClass("logos2");
            }
        },500);
    }

    $(".ImgList li:first").children().addClass("cur");
    $("#service .icoList li").hover(function(){
        $(this).addClass("cur").siblings().removeClass("cur");
        $("#service .ImgList li").stop(false,true).eq($(this).index()).addClass("cur").siblings().removeClass("cur");
        $("#service .ImgList li").stop(false,true).eq($(this).index()).find(".img").addClass("cur").parent().siblings().find(".img").removeClass("cur");
    });
    $('#nav .ahover').mouseover(function(){
        var index=$('#nav .ahover').index(this);
        $('#nav .ahover').removeClass('navbj');
        $(this).addClass('navbj');
    });
    if($(document.body)