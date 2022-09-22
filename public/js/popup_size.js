jQuery(document).ready(function(){
	var winW, winH, sizeToW, sizeToH;
	
	if(parseInt(navigator.appVersion)>3){
		if(navigator.appName == "Netscape"){
			winW = window.outerWidth;
			winH = window.outerHeight;
		}
	}
	
	if(navigator.appName.indexOf("Microsoft") != -1){
		winW = document.body.scrollWidth;
		winH = document.body.scrollHeight;
	}
	
	sizeToW = 0;
	sizeToH = 0;
	
	if(winW > 1200){
		sizeToW = 1200 - $(window).width();
	}else if(Math.abs(document.body.clientWidth - winW)>3){
		sizeToW = winW - $(window).width();
	}
	if(winH > 768){
		sizeToH = 768 - $(window).height();
	}else if(Math.abs(document.body.clientHeight - winH)>4){
		sizeToH = winH - $(window).height();
	}
	
	if(sizeToW != 0 || sizeToH != 0){
		window.resizeBy(sizeToW, sizeToH);
	}
});