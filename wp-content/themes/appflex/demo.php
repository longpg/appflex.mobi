<?php
require_once 'Mobile_Detect.php';
$detect = new Mobile_Detect;
$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
$scriptVersion = $detect->getScriptVersion();
   if($deviceType=="computer"){
   }
   else{
		$Android = stripos($_SERVER['HTTP_USER_AGENT'],"Android");
		if($Android){
		echo'<center>Bạn đang dùng điện thoại Android, hãy truy cập <font color="red"><b>GAMEHOT.MOBI</b></font> tường xuyên để tải Game và ứng dụng MIỄN PHÍ mới nhất cho điện thoại nhé !</center>';
		}else{
		}
		
	}
?>

