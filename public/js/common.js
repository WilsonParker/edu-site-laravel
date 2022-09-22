function unlock()
{
  check_attack.check.value=0;
}


//isEmpty(공백검사함수)
function isEmpty( data )
{
   for ( var i = 0 ; i < data.length ; i++ )
   {
      if ( data.substring( i, i+1 ) != " " )
         return false;
   }
   return true;
}

//한글입력확인하기
function CheckHangul(name) {
    strarr = new Array(name.value.length);
    schar = new Array('/','.','>','<',',','?','}','{',' ','\\','|','(',')','+','=');

    for (i=0; i<name.value.length; i++)
    {
        for (j=0; j<schar.length; j++)
        {
            if (schar[j] ==name.value.charAt(i))
            {
                //alert(escape(name.value.charAt(i)) );
                alert("이름은 한글입력만 가능합니다.");
                name.focus();
                return false;
            }
            else
                continue;
        }

        strarr[i] = name.value.charAt(i)
        if ((strarr[i] >=0) && (strarr[i] <=9))
		{
            alert("이름에 숫자가 있습니다. 이름은 한글입력만 가능합니다.");
			name.focus();
            return false;
		}
        else if ((strarr[i] >='a') && (strarr[i] <='z'))
		{
            alert("이름에 알파벳이 있습니다. 이름은 한글입력만 가능합니다.");
			name.focus();
            return false;
		}
        else if ((strarr[i] >='A') && (strarr[i] <='Z'))
		{
            alert("이름에 알파벳이 있습니다. 이름은 한글입력만 가능합니다.");
			name.focus();
            return false;
		}
        else if ((escape(strarr[i]) > '%60') && (escape(strarr[i]) <'%80') )
		{
            alert("이름에 특수문자가 있습니다. 이름은 한글입력만 가능합니다.");
			name.focus();
            return false;
		}
        else
        {
        //      alert(escape(strarr[i]) );
				continue;
        }

    }
        return true;
}

//입력길이 체크함수(바이트비교)
function CheckLen(textname,bytesname){
	var t;
	var msglen;
	msglen=0; 
	l=textname.value.length; 
	for(k=0;k<l;k++){
		t=textname.value.charAt(k);
		if(escape(t).length>4) msglen+=2; 
		else msglen++;
	} 
	bytesname.value=msglen; 
}

//입력길이체크하기 함수(단순비교)
function CheckLen1(name,minlen,maxlen) {
        if (name.value.length < minlen)
        {
            // alert("입력된 값의 길이가 짧습니다!");
            name.focus();
            return false;
        }
        else if (name.value.length > maxlen)
        {
            // alert("입력된 값의 길이가 너무 깁니다!");
            name.focus();
            return false;
        }
        else
            return true;
}





// 특수문자 체크
function Check_nonChar(id_text)
{
	var nonchar = '~`!@#$%^&*()-_=+\|<>?,./;:"';
	var numeric = '1234567890';
	var nonkorean = nonchar+numeric; 
	
	var i ; 
	for ( i=0; i < id_text.length; i++ )  {
		if( nonkorean.indexOf(id_text.substring(i,i+1)) > 0) {
			break ; 
		}
	}
	
	if ( i != id_text.length ) {
		return false ; 
	}
	else{
		return true ;
	} 
	
	return false;
}

function TrimString(SrcString)
{

   /* 왼쪽 트림   */
   len = SrcString.length;
   for(i=0;i<len;i++)
   {
      if(SrcString.substring(0,1) == " ")
      {
         SrcString = SrcString.substring(1);
      }
      else
      {
         break;
      }
   }

   /* 오른쪽 트림   */
   len = SrcString.length;
   for(i=len;i>0;i--)
   {
      if(SrcString.substring(i-1) == " ")
      {
         SrcString = SrcString.substring(0,i-1);
      }
      else
      {
         break;
      }
   }

   return SrcString;
}

//spec
var NUM = "0123456789";
var SALPHA = "abcdefghijklmnopqrstuvwxyz";
var ALPHA = "ABCDEFGHIJKLMNOPQRSTUVWXYZ"+SALPHA;	
var UNDER="-";

function TypeCheck (s, spc) {
		var i;

		for(i=0; i< s.length; i++) {
			if (spc.indexOf(s.substring(i, i+1)) < 0) {
				return false;
			}
		}        
		return true;
}


// 삭제함수
function Really(){
		if(confirm('정말로 삭제하시겠습니까?\n\n삭제하시면 복구가 불가능합니다.')) return true;
		return false;
}
function ReallyMove(a){
		if(confirm('정말로 삭제하시겠습니까?\n\n삭제하시면 복구가 불가능합니다.')) location.href=a;
		return false;
}
function sysReallyMove(a){
		if(confirm('정말로 삭제하시겠습니까?\n\n삭제하시면 복구가 불가능합니다.')) sysfrm.location.href=a;
		return false;
}
function sysReallyMove2(a){
		if(confirm('정말로 채점전 상태로 변경하시겠습니까?\n\n변경하시면 복구가 불가능합니다.')) sysfrm.location.href=a;
		return false;
}

function ReallyMove2(a){
		if(confirm('일괄변경 하시겠습니까?')) location.href=a;
		return false;
}
function ReallySend(){
		if(confirm('정말로 발송하시겠습니까?\n\n잘 생각하시고 보내시기 바랍니다.')) return true;
		return false;
}
function ReallySend2(a){
		if(confirm('정말로 발송하시겠습니까?\n\n잘 생각하시고 보내시기 바랍니다.'))  location.href=a;
		return false;
}
function ReallyMove3(a){
		if(confirm('등록거부하시겠습니까?')) location.href=a;
		return false;
}
function ReallyCancle(a){
		if(confirm('정말로 취소 하시겠습니까?\n\n취소 하시면 복구가 불가능합니다.')) location.href=a;
		return false;
}

// 블로그에 담기전에 물어보기
function BlogInput(){
		if(confirm('내 블로그에 담아가시겠습니까?')) return true;
		return false;
}

// ----------------------------------------------------------- 한묶음 -----------------------------------------------------
// 이메일체크
function ChkMail(strValue) {
  if(ChkSpace(strValue)){
    alert ("E메일 주소에서 공란을 빼주십시오");
    return false;
  }else  if (strValue.indexOf("/")!=-1 || strValue.indexOf(";") !=-1 || ChkHan(strValue)) {
    alert("E-Mail형식이 잘못되었습니다.\n  다시한번 확인바랍니다.");
    return false;
  }else  if ((strValue.length != 0) && (strValue.search(/(\S+)@(\S+)\.(\S+)/) == -1)) {
    alert("E-Mail형식이 잘못되었습니다..\n  다시한번 확인바랍니다.");
    return false;
  }else{ 
  return true;
  }
}

//공백체크////////////////////////////////////////////////////
function ChkSpace(strValue) {
  if (strValue.indexOf(" ")>=0) {
    return true;
  }else {
    return false;
  }
}

//한글체크////////////////////////////////////////////////////
function ChkHan(strValue) {
  for(i=0;i<strValue.length;i++) {
  var a=strValue.charCodeAt(i);
    if (a > 128) {
      return true;
    }else{
      return false;
    }
  }
}
// ------------------------------------------------------------------------------------------------------------------
	function changeMyemail(){	// 이메일 교체 함수
		var Frm = document.join;
		var Sel_mail = Frm.wbMyemailDomainSel.value
		if (Sel_mail == ""){
			Frm.email2.readOnly = false;
			Frm.email2.value = Sel_mail;
			Frm.email2.focus();
		}else{
			Frm.email2.readOnly = true;
			Frm.email2.value = Sel_mail;
		}
	}

function conAlert(a){
		if(!confirm(a)) return false;
		return true;
}

var ifrm_resize_try_cnt = 0
function Resize_Frame(name)
{
	try
	{   
		ifrm_resize_try_cnt = ifrm_resize_try_cnt + 1;

		var oBody 	= document.frames(name).document.body;
		var oFrame 	= document.all(name);

		oFrame.style.width 
				= oBody.scrollWidth + (oBody.offsetWidth-oBody.clientWidth);
		oFrame.style.width
				=	"100%";
		oFrame.style.height 
				= oBody.scrollHeight + (oBody.offsetHeight-oBody.clientHeight);

		if (oFrame.style.height == "0px" || oFrame.style.width == "0px")
		{
			oFrame.style.width = "100%";
			oFrame.style.height = "700px"; 
			window.status = 'iframe resizing fail.';
			if ( ifrm_resize_try_cnt < 2 )
			{
				window.status = 'resizing failed. retrying..';
				Resize_Frame(name);
			}
		}
		else
		{
			window.status = '';
		}
	}
	catch(e)
	{
		window.status = 'Error: ' + e.number + '; ' + e.description;
	}
}

function show(url)
{
	if(screen.availWidth==1024)
	{
		window.open(url,"","fullscreen");
	}
	else
	{
		left1=(screen.availWidth-1024-5)/2;
		top1=(screen.availHeight-768-10)/2;
		window.open(url,"","toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, width=1024, height=768, top="+top1+", left="+left1);	
	}
}

function controlFocus(obj, toID) {
	if (toID == null) return;
	var maxLen = obj.getAttribute("maxlength"); 
	if (obj.value.length >= maxLen) {
		focusThis(toID);
	}
}

function focusThis(id) {
	document.getElementById(id).focus();
}
function isNotnum(str){
	var len = str.length;
	for(var i = 0;i < len;i++){
		var Jstr = str.charAt(i);
		if(Jstr < "0" || Jstr > "9") return true;
	}
	return false;
}


function IsNumeric(sText)
{
   var ValidChars = "0123456789.";
   var IsNumber=true;
   var Char;

   for (i = 0; i < sText.length && IsNumber == true; i++) {
      Char = sText.charAt(i);
      if (ValidChars.indexOf(Char) == -1) {
         IsNumber = false;
      }
   }

   return IsNumber;
}
function OnlyNumber(el) {
	if(!IsNumeric(el.value)) {
		el.value = "";
		el.focus();
	}
}

function phoneNumber(el) {
	el.value = _phoneNumber(el.value);
}

function _phoneNumber(value) {
	value = value.replace(/[^0-9]/g, "")
	var pattern = new RegExp("^(02|[0-9]{3})([0-9]{" + (value.length <= (/^02/.test(value) ? 9 : 10) ? 3 : 4) + "})?([0-9]{4})?");
	var arr = value.replace(pattern, "$1-$2-$3").replace(/--/g, "-").split("-");
	if(arr[2]) arr[2] = arr[2].substring(0, 4);
	return arr.join("-", arr);
}

function OnlyEnglish(obj){

	val=obj.value;
	re=/[^a-zA-Z0-9@\.]/gi;
	obj.value=val.replace(re,"");
}
function OnlyEmail(obj){

	val=obj.value;
	re=/[^a-zA-Z0-9@\.]/gi;
	obj.value=val.replace(re,"");
}
$(document).ready(function(){
	  //한글입력 안되게 처리
	  $(".onlyengnum").keyup(function(event){ 
	   if (!(event.keyCode >=37 && event.keyCode<=40)) {
		var inputVal = $(this).val();
		$(this).val(inputVal.replace(/[^a-z0-9]/gi,''));
	   }
	  });
		checkIsRedirectUrl();
});

/**
 * 해당 정보를 포함하는 url 을 redirect 시킵니다
 * @author  dev9163
 * @added   2021/07/12
 * @updated 2021/07/12
 */
var redirectUrls = [
	"mypage",
	"pay_general",
];
function checkIsRedirectUrl() {
	redirectUrls.forEach(function (item) {
		if(window.location.href.indexOf(item) > -1) {
			movePageIfIE();
		}
	});
}

function movePageIfIE() {
	ieAction(function() {
		location.href = "/page/ie_redirect.html";
	}, function() {}
	);
}

function ieAction(callback, other) {
	if (isIE()) {
		// ie일 경우
		if(isFunction(callback)) {
			callback();
		}
	}else{
		// ie가 아닐 경우
		if(isFunction(other)) {
			other();
		}
	}
}

function isIE() {
	var agent = navigator.userAgent.toLowerCase();
	return (navigator.appName == 'Netscape' && agent.indexOf('trident') != -1) || (agent.indexOf("msie") != -1);
}

function isFunction(functionToCheck) {
	return functionToCheck && {}.toString.call(functionToCheck) === '[object Function]';
}

function disableContextMenu() {
	document.addEventListener('contextmenu', function(event) {
		event.preventDefault()
	});
}

function disableContextMenuInFrame(obj) {
	let frame =  $('#'+obj.id);
	let contents =  frame.contents();
	contents.find('body').attr("oncontextmenu", "return false");
}

function addScript( src , target, onload) {
	let s = document.createElement( 'script' );
	s.setAttribute( 'src', src );
	if(!target) {
		target = document.body;
	}

	s.onload = onload;
	target.appendChild( s );
}

function addStyle( href , target) {
	let s = document.createElement( 'link' );
	s.setAttribute( 'href', href );
	s.setAttribute( 'rel', 'stylesheet' );
	if(!target) {
		target = document.head;
	}
	target.appendChild( s );
}

function addMeta(callback, target) {
	let meta = document.createElement('meta');
	meta = callback(meta);
	if(!target) {
		target = document.head;
	}
	target.appendChild(meta);
}