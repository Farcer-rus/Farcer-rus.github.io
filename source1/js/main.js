(function(w, d, u, i, o, s, p) {
    if (d.getElementById(i)) { return; } w['MangoObject'] = o; 
    w[o] = w[o] || function() { (w[o].q = w[o].q || []).push(arguments) }; w[o].u = u; w[o].t = 1 * new Date();
    s = d.createElement('script'); s.async = 1; s.id = i; s.src = u;
    p = d.getElementsByTagName('script')[0]; p.parentNode.insertBefore(s, p);
}(window, document, '//widgets.mango-office.ru/widgets/mango.js', 'mango-js', 'mgo'));
mgo({calltracking: {id: 13664, elements: [{"selector":".number_mango"}]}});

$(document).ready(function() {
	$(".block_about_mini").click(function() {
		$(".block_about_mini").fadeOut(100);
		$(".n100").fadeIn(100);
		$(".block_about_video").fadeIn(100);
	});
	$(".block_about_mini_close").click(function() {
		$(".block_about_mini").fadeOut(100);
		$(".block_about_mini_close").fadeOut(100);
	});
	setTimeout(function(){$(".block_about_mini, .block_about_mini_close").fadeIn(100)}, 15000);
	$(".loot").click(function() {
		var namer = $(this).attr("data");
		var goal = $(this).attr("goal");
		$("#tmpgoal").val(goal);
		$(".forma_fixed_head").html(namer);
		$(".forma_fixed").fadeIn(100);
		$(".n100").fadeIn(100);
		$(".type_form").val("");
		if(namer == '<span>Получите подарок</span><br/>к заказу') {
			var presernter = 'получить подарок';
			var dopper = 'Оставьте свои контактные данные в полях ниже. Менеджер свяжется с вами для заказа в течение 12 минут.';
		}
		if(namer == '<span>Cкачайте полный каталог</span><br/>продукции') {
			var presernter = 'скачать каталог';
			var dopper = 'Оставьте свои контактные данные в полях ниже. Менеджер отправит вам каталог в течение 12 минут.';
		}
		if(namer == '<span>Закажите форму</span><br/>прямо сейчас') {
			var presernter = 'заказать форму';
			var dopper = 'Оставьте свои контактные данные в полях ниже. Менеджер свяжется с вами для заказа в течение 12 минут.';
			$(".type_form").val($(this).attr("datatype"));
		}
		if(namer == '<span>Заказать</span><br/>звонок') {
			var presernter = 'заказать звонок';
			var dopper = 'Оставьте свои контактные данные в полях ниже. Менеджер свяжется с вами в течение 12 минут.';
		}
		$(".button_of_form").text(presernter);
		$(".forma_fixed_head_dop").text(dopper);
	});
	$(".n100").click(function() {
		$(".forma_fixed").fadeOut(100);
		$(".n100").fadeOut(100);
		$(".block_about_video").fadeOut(100);
		$(".block_about_mini").fadeIn(100);
		$(".block_about_mini_close").fadeIn(100);
	});
	$(".forma_close").click(function() {
		$(".block_about_video").fadeOut(100);
		$(".block_about_mini").fadeIn(100);
		$(".n100").fadeOut(100);
	});
	$(".button_of_form").click(function() {
		var errorcount = $("label.error:visible").length;
		if(errorcount==0) {
			var page = window.location;
	        var referer = document.referrer;
			var phone = $(this).parent().find(".phone_form").val();
			var mail = $(this).parent().find(".mail_form").val();
			var count = $(this).parent().find(".count_form").val();
			var type = $(this).parent().find(".type_form").val();
			var head = $(this).parent().parent().find(".forma_fixed_head").text();
			var myy = $(this);
			if($.cookie('cookie_Val')!='yes') {
				if(mail && phone && count) {
					yaCounter41176789.reachGoal($("#tmpgoal").val());
					fbq('track', 'Lead');
					ga('send', 'event', $("#tmpgoal").val(), 'click');
					$(".button_of_form").fadeOut(0);
					$(".forma_form").append("<div style='text-align:center;width: 370px;font-size:19px;color:red;'>Идет отправка, пожалуйста подождите</div>");
					$.ajax({
			                type: "POST",
			                url: "/callback.php",
			                data: "userphone="+phone+"&usermail="+mail+"&usercount="+count+"&usertype="+type+"&userhead="+head+"&userpage="+page+"&userreferer="+referer+"",
			                success: function(data){
				                 window.location = '/finish.php';
				                 $(myy).parent().fadeOut(0);
				                 $(myy).parent().next().fadeIn(0);
				                 $(myy).parent().next().next().fadeOut(0);
				                 $(".forma_fixed").delay(3000);
				                 $(".forma_fixed").fadeOut(300);
				                 $(".n100").delay(3000);
				                 $(".n100").fadeOut(300);
				                 $.cookie('cookie_Val', 'yes', {
								    expires: 5,
								    path: '/',
								 });
			                }
			        });
		        } else {
			        $(myy).parent().next().next().fadeIn(0);
		        }
	        } else {
		        alert("Вы уже подавали заявку");
	        }
        }
	});
	
	$(".portfolio_list_item_left_nav_item").click(function() {
		$(this).parent().find(".portfolio_list_item_left_nav_item").removeClass("portfolio_list_item_left_nav_item_active");
		$(this).addClass("portfolio_list_item_left_nav_item_active");
		$(this).parent().prev().find("img").attr("src",$(this).attr("data"));
	});
	
	$(".portfolio_list_right").click(function() {
		var countBlocks = $(".portfolio_list_item").length;
		var nowBlock = $(".portfolio_list_item_active").attr("data");
		var nextBlock = 0;
		if(nowBlock==countBlocks) {
			$(".portfolio_list_item").removeClass("portfolio_list_item_active");
			$(".portfolio_list_item[data=1]").addClass("portfolio_list_item_active");
		} else {
			nextBlock = nowBlock*1+1;
			$(".portfolio_list_item").removeClass("portfolio_list_item_active");
			$(".portfolio_list_item[data="+nextBlock+"]").addClass("portfolio_list_item_active");
		}
	});
	$(".portfolio_list_left").click(function() {
		var countBlocks = $(".portfolio_list_item").length;
		var nowBlock = $(".portfolio_list_item_active").attr("data");
		var nextBlock = 0;
		if(nowBlock==1) {
			$(".portfolio_list_item").removeClass("portfolio_list_item_active");
			$(".portfolio_list_item[data="+countBlocks+"]").addClass("portfolio_list_item_active");
		} else {
			nextBlock = nowBlock*1-1;
			$(".portfolio_list_item").removeClass("portfolio_list_item_active");
			$(".portfolio_list_item[data="+nextBlock+"]").addClass("portfolio_list_item_active");
		}
	});
	
	$('a[href^="#"]').click(function () { 
	    elementClick = $(this).attr("href");
	    destination = $(elementClick).offset().top;
	    $("body,html").animate({scrollTop: destination }, 800);
	});
	
	$(".showmore").click(function() {
		$(this).next().fadeIn(300);
		$(this).parent().find('.header_menu_hide').fadeIn(300);
	});
	$(".header_menu_hide").mouseleave(function() {
		$(this).fadeOut(300);
	});

   $("#justform").validate({
       rules:{ 
 
            phone:{
                required: true, 
                minlength: 11, 
                maxlength: 12, 
                digits: true,
            },
            
            mail:{
                email: true, 
            },
            
            count:{
                required: true,
            },
       },
       messages:{
 
            phone:{
                required: " Это поле обязательно для заполнения",
                minlength: " Телефон должен иметь минимум 11 символов", 
                maxlength: " Максимальное число символов - 12 (если с +7)", 
                digits: " Вводить можно только цифры"
            },
            
            mail:{
                email: " E-mail введен не верно",
            },
            
            count:{
                required: " Это поле обязательно для заполнения",
            },
 
       }
    });
});
