$(function () {
    var $con = $('#gg'),
     $box = $con.find('#ggBox'),
      $btns = $con.find('#ggBtns'), i = 0,
       autoChange = function () {
        i += 1;
        if (i === 5) { i = 0; }
		$btns.find('p').eq(i).children('a').addClass('ggOn');
        $btns.find('p').eq(i).siblings().children('a').removeClass('ggOn');
        var curr = $box.find('a:eq(' + i + ')'), prev = curr.siblings();
        prev.css('z-index', 2);
        curr.css('z-index', 3).animate({
            'opacity': 1
        }, 150, function () {
            prev.css({
                'z-index': 1 
            });
        });
    }, loop = setInterval(autoChange, 4000);
    // $con.hover(function () {
    //     clearInterval(loop);
    // }, function () {
    //     loop = setInterval(autoChange, 4000);
    // });
    $(".stop").click(function () {
        clearInterval(loop);
         // $(".stop img").attr("src","images/play.png");
          $(".stop").css("display","none");
          $(".play").css("display","block");
     });
    $(".play").click(function () {
         loop = setInterval(autoChange, 4000);
           $(".play").css("display","none");
          $(".stop").css("display","block");
     });
    $btns.find('p').click(function() {
        i = $(this).index() - 1;
        autoChange();
    });
	$('.ggBtns p:last').css('background','none');

});