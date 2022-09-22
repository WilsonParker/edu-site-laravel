jQuery(document).ready(function(){
	$('.main_banner .banner_list').slick({
		dots: true,
		dotsClass: 'banner_dot',
		prevArrow: '',
		nextArrow: '',
		autoplay: true
	});
	
	if($(window).width() <= 525){
		$('.main_lecture .lecture_list').slick({
			dots: false,
			infinite: true,
			slidesToShow: 2,
			sclidesToScroll: 1,
			prevArrow: '.main_lecture .btn_prev',
			nextArrow: '.main_lecture .btn_next'
		});
	}else{
		$('.main_lecture .lecture_list').slick({
			dots: false,
			infinite: true,
			slidesToShow: 4,
			sclidesToScroll: 4,
			prevArrow: '.main_lecture .btn_prev',
			nextArrow: '.main_lecture .btn_next'
		});
	}
	
	$('.main_etc .etc_box .etc_notice .list').hide();
	$('.main_etc .etc_box .etc_notice .list').eq(0).show();
	$('.main_etc .etc_box .etc_notice .tab').on('click', function(){
		$('.main_etc .etc_box .etc_notice .tab').removeClass('on');
		$(this).addClass('on');
		$('.main_etc .etc_box .etc_notice .list').hide();
		$(this).next('.list').show();
		
		return false;
	});
});