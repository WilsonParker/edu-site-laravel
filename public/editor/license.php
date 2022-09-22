<?
include("../common.lib.php");
$DB[productkey] ;
$msg = "본 LMS솔루션은 상용솔루션으로 민융기의 개인소유입니다.
<br>정식으로 구매하지 않거나 허가받지 않고 사용하는 것은 불법행위이며 국내 관련법에 의해 처벌받을수 있습니다.
<br>제품번호 : $DB[productkey] 
<br>연락처 : 민융기 segyea@nate.com";
echo $msg;
?>