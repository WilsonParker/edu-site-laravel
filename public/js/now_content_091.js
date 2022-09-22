document.domain = "edu-site-laravel.co.kr";
function onLoadFunc(str){
	var fa = parent.document.frmListen.log_num.value;
	parent.document.frmListen.log_num.value= fa +str + ',';
}

window.onload = function(){
		// onLoadFunc(now_page);
}
