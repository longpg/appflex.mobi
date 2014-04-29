<?php

require_once 'Mobile_Detect.php';
$detect = new Mobile_Detect;
$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
$scriptVersion = $detect->getScriptVersion();
   if($deviceType=="computer"){
   echo'';
   }
   else{
		$iPod    = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
		$iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
		$iPad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
		$Android = stripos($_SERVER['HTTP_USER_AGENT'],"Android");
		$webOS   = stripos($_SERVER['HTTP_USER_AGENT'],"webOS");
		//do something with this information
		if( $iPod || $iPhone ){
		echo "Hãy truy cập <b>GAMEHOT.MOBI</b> thường xuyên để cập nhật những game/app mới nhất nhé!";
		}else if($iPad){
			echo "Hãy truy cập <b>GAMEHOT.MOBI</b> thường xuyên để cập nhật những game/app mới nhất nhé!";
		}else if($Android){
		
		echo "Hãy truy cập <b>GAMEHOT.MOBI</b> thường xuyên để cập nhật những game/app mới nhất nhé!";
		
		}else{
		echo "Hãy truy cập <b>mTaiGame.Com</b> thường xuyên để cập nhật những game/app mới nhất nhé!";		}
		
	}
?>

