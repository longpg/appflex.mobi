<?php

require_once 'Mobile_Detect.php';
$detect = new Mobile_Detect;
$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
$scriptVersion = $detect->getScriptVersion();
   if($deviceType=="computer"){
   		echo'
		';
   }
   else{
		$iPod    = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
		$iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
		$iPad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
		$Android = stripos($_SERVER['HTTP_USER_AGENT'],"Android");
		$webOS   = stripos($_SERVER['HTTP_USER_AGENT'],"webOS");
		//do something with this information
		if( $iPod || $iPhone ){
			echo '';
		}
		else if($Android){
		echo'
		<div class="sangame-container">
		<div class="sg-list">
		<div class="sg-ads">    <div class="images">        <img src="https://static.mwork.vn/thumbs/unsafe/32x32/static.mwork.vn/data/images/apps/phongvantruyenky.png" alt="#phong-van">    </div>    <h3><a href="http://gamehot.mobi/game/phong-van-truyen-ky.html"><em>Phong vân truyền kỳ</em></a></h3>    <div class="desc">Game nhập vai, đánh theo lượt kết hợp đông - tây, hàng triệu Game thủ đã nhập cuộc. </div></div>
		<div class="sg-ads">    <div class="images">        <img src="http://image.sangame.net/images/2013/12/23/QXDIk.png" alt="#au-mobile">    </div>    <h3><a href="http://gamehot.mobi/game/tai-game-iwin.html"><em>iWin</em> - Đánh bài Online </a></h3>    <div class="desc">Tặng ngay 40.000 Win giúp bạn chơi không giới hạn với giờ vàng khuyến mại ngay tối nay!</div></div>
		</div>
		</div>
		';
		}else{
		echo'
		<div class="sangame-container">
		<div class="sg-list">
		<div class="sg-ads">    <div class="images">        <img src="https://static.mwork.vn/thumbs/unsafe/32x32/static.mwork.vn/data/images/apps/phongvantruyenky.png" alt="#phong-van">    </div>    <h3><a href="http://gamehot.mobi/game/phong-van-truyen-ky.html"><em>Phong vân truyền kỳ</em></a></h3>    <div class="desc">Game nhập vai, đánh theo lượt kết hợp đông - tây, hàng triệu Game thủ đã nhập cuộc. </div></div>
		<div class="sg-ads">    <div class="images">        <img src="http://image.sangame.net/images/2013/12/23/QXDIk.png" alt="#au-mobile">    </div>    <h3><a href="http://gamehot.mobi/game/tai-game-iwin.html"><em>iWin</em> - Đánh bài Online </a></h3>    <div class="desc">Tặng ngay 40.000 Win giúp bạn chơi không giới hạn với giờ vàng khuyến mại ngay tối nay!</div></div>
		</div>
		</div>';
		}
		
	}
?>
