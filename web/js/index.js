$(function(){
	
//	更换考试
	
	$('.changes').hover(function(){
		$('.changeShow').toggle();
		$(this).toggleClass('changess');
	});
	
//	首页导航

    $(".index_con .in_kct").hover(function() {
        $(this).find('i:first').addClass('smaller').removeClass('bigger')
        $(this).find('span:first').fadeOut()
        $(this).find('.in_text').show().addClass('show')
        $(this).find('.ch').removeClass('show')
    }, function() {
        $(this).find('i:first').removeClass('smaller').addClass('bigger')
        $(this).find('span:first').fadeIn('show')
        $(this).find('.in_text').hide().removeClass('show')
        $(this).find('.ch').addClass('show')
    });
    
    $(".index_con .in_jbk").hover(function() {
        $(this).find('i:first').addClass('hide')
        $(this).find('span:first').hide()
        $(this).find('.in_text').show().addClass('show')
        var num = $(this).index('.in_jbk') + 1;
        $(this).find('.in_none').show().addClass('toLeft' + num).removeClass('toRight' + num)
        $(this).find('.ch1').removeClass('show')
    }, function() {
        $(this).find('i:first').addClass('hide')
        $(this).find('span:first').fadeIn()
        $(this).find('.in_text').hide().removeClass('show')
        var num = $(this).index('.in_jbk') + 1;
        $(this).find('.in_none').show().addClass('toRight' + num).removeClass('toLeft' + num)
        $(this).find('.ch1').addClass('show')
    });
    
    $(".index_con .in_zxl").hover(function() {
        $(this).find('i:first').addClass('hide')
        $(this).find('span:first').hide()
        $(this).find('.in_text').show().addClass('show')
        var nums = $(this).index('.in_zxl') + 1;
        $(this).find('.in_none').show().addClass('toLeft4').removeClass('toRight4')
        $(this).find('.ch2').removeClass('show')
    }, function() {
        $(this).find('i:first').addClass('hide')
        $(this).find('span:first').fadeIn()
        $(this).find('.in_text').hide().removeClass('show')
        $(this).find('.in_none').show().addClass('toRight4').removeClass('toLeft4')
        $(this).find('.ch2').addClass('show')
    });
    
//  设置默认

	$('.selectExam dd a.acquiesce').click(function(){
		$(this).parent().addClass('on').siblings().removeClass('on');
	});
	
//	删除考试

	$('.selectExam dd a.selectExamDel').click(function(){
		$(this).parent().hide();
	});

//	编辑考试

	$('.selectExam dd a.examEidt').click(function(){
		$('.selectExams').fadeIn();
	});
	
	$('.selectExams dd.last input,.selectExamDiv').click(function(){
		$('.selectExams').fadeOut();
	});

	
//  订单选择
	
	$('.orderCancel strike').click(function(){
		$(this).toggleClass('on');
	});
	
//  展开课程
	
	$('.courseList ul li strike').click(function(){
		$(this).parent().find('.courseLists').toggle();
	});

	$('.classList strong').click(function(){
		$('.classList strong').text('+');
		$(this).toggleClass('on').parent().find('.classLists').toggle();
		$('.classList strong.on').text('-');
	});
	
	
//  选择头像
	
	$('.photos img').click(function(){
		$('.photos').fadeOut();
		$('.accountCon dt img').attr('src',$(this).attr('src'));
	});
	
	$('.accountCon dt img,.accountCon dt a.photo').click(function(e){
		$('.photos').fadeIn();
		e = e || event;
        stopFunc(e);　
	});
	
	document.onclick = function(e) {　　　　　　　　
    	$(".photos").fadeOut();
	};
	
	function stopFunc(e) {　　　　　　
	    e.stopPropagation ? e.stopPropagation() : e.cancelBubble = true;　　　　
	};




});
