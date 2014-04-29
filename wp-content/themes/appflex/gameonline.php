<?php

require_once 'Mobile_Detect.php';
$detect = new Mobile_Detect;
$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
$scriptVersion = $detect->getScriptVersion();
   if($deviceType=="computer"){
   		echo'
		<div class="nav">
		Game Online đang HOT
		</div>
		<style>.sangame-container{margin-left:0;margin-right:0;padding-top:1px;padding-bottom:1px;font-family:arial,sans-serif;font-size:13px}.sangame-container .sg-header{font-weight:700;background:#edeff4;border-bottom:1px solid #d8dfea;padding:5px}.sangame-container .sg-more{font-size:11px;font-weight:700;background:#edeff4;padding:5px}.sangame-container .sg-more a{color:#12c}.sangame-container .sg-list .sg-ads{padding:5px}.sangame-container .sg-list .sg-ads:nth-child(odd){background-color:#fff8e7}.sangame-container .sg-list .sg-ads:nth-child(even){background-color:#fff}.sangame-container .sg-list .sg-ads .images{float:left;padding-right:5px;max-width:32px;max-height:32px}.sangame-container .sg-list .sg-ads h3{margin:0;padding:0;border:0;display:inline}.sangame-container .sg-list .sg-ads h3 a{color:#12c;font-weight:400;cursor:pointer;font-size:13px}.sangame-container .sg-list .sg-ads .desc{color:#666}.sangame-container em{font-weight:700;font-style:normal}.sg-default{display:none}</style>
		<div class="sangame-container">
		<div class="sg-list">
		<div class="sg-ads">    <div class="images">        <img src="http://image.sangame.net/images/2013/08/21/BAL7Q.jpg" alt="#bigkool">    </div>    <h3><a href="http://gamehot.mobi/game/tai-game-bigkool.html"><em>BigKool</em> - Game bài <em>Android siêu mượt</em> </a></h3>    <div class="desc">Mang đến <em>Casino 5 sao </em> - <em>Las Vegas đích thực</em>  trên di động. <em>Đã có thêm đánh chắn !</em></div></div>
		<div class="sg-ads">    <div class="images">        <img src="https://static.mwork.vn/thumbs/unsafe/32x32/static.mwork.vn/data/images/apps/phongvantruyenky.png" alt="#phong-van">    </div>    <h3><a href="http://gamehot.mobi/game/phong-van-truyen-ky.html"><em>Phong vân truyền kỳ</em></a></h3>    <div class="desc">Game nhập vai, đánh theo lượt kết hợp đông - tây, hàng triệu Game thủ đã nhập cuộc. </div></div>
		<div class="sg-ads">    <div class="images">        <img src="http://image.sangame.net/images/2013/12/23/QXDIk.png" alt="#au-mobile">    </div>    <h3><a href="http://gamehot.mobi/game/tai-game-iwin.html"><em>iWin</em> - Đánh bài Online </a></h3>    <div class="desc">Tặng ngay 40.000 Win giúp bạn chơi không giới hạn với giờ vàng khuyến mại ngay tối nay!</div></div>
		<div class="sg-ads">    <div class="images">        <img src="http://image.sangame.net/images/2013/10/24/cCwLE.png" alt="#tay-du-ki">    </div>    <h3><a href="http://gamehot.mobi/game/tay-du-ky-online.html"><em>Tây Du Ký Online</em> - Hỏa Diệm Sơn </a></h3>    <div class="desc">Game nhập vai Online hấp dẫn, skill khủng. Trở thành Tôn Ngộ Không đại phá Hỏa Diệm Sơn.</div></div>
		</div>
		</div>
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
		<div class="nav">
		Game Online đang HOT
		</div>
		<style>.sangame-container{margin-left:0;margin-right:0;padding-top:1px;padding-bottom:1px;font-family:arial,sans-serif;font-size:13px}.sangame-container .sg-header{font-weight:700;background:#edeff4;border-bottom:1px solid #d8dfea;padding:5px}.sangame-container .sg-more{font-size:11px;font-weight:700;background:#edeff4;padding:5px}.sangame-container .sg-more a{color:#12c}.sangame-container .sg-list .sg-ads{padding:5px}.sangame-container .sg-list .sg-ads:nth-child(odd){background-color:#fff8e7}.sangame-container .sg-list .sg-ads:nth-child(even){background-color:#fff}.sangame-container .sg-list .sg-ads .images{float:left;padding-right:5px;max-width:32px;max-height:32px}.sangame-container .sg-list .sg-ads h3{margin:0;padding:0;border:0;display:inline}.sangame-container .sg-list .sg-ads h3 a{color:#12c;font-weight:400;cursor:pointer;font-size:13px}.sangame-container .sg-list .sg-ads .desc{color:#666}.sangame-container em{font-weight:700;font-style:normal}.sg-default{display:none}</style>
		<div class="sangame-container">
		<div class="sg-list">
		<div class="sg-ads">    <div class="images">        <img src="http://image.sangame.net/images/2013/08/21/BAL7Q.jpg" alt="#bigkool">    </div>    <h3><a href="http://gamehot.mobi/game/tai-game-bigkool.html"><em>BigKool</em> - Game bài <em>Android siêu mượt</em> </a></h3>    <div class="desc">Mang đến <em>Casino 5 sao </em> - <em>Las Vegas đích thực</em>  trên di động. <em>Đã có thêm đánh chắn !</em></div></div>
		<div class="sg-ads">    <div class="images">        <img src="https://static.mwork.vn/thumbs/unsafe/32x32/static.mwork.vn/data/images/apps/phongvantruyenky.png" alt="#phong-van">    </div>    <h3><a href="http://gamehot.mobi/game/phong-van-truyen-ky.html"><em>Phong vân truyền kỳ</em></a></h3>    <div class="desc">Game nhập vai, đánh theo lượt kết hợp đông - tây, hàng triệu Game thủ đã nhập cuộc. </div></div>
		<div class="sg-ads">    <div class="images">        <img src="http://image.sangame.net/images/2013/12/23/QXDIk.png" alt="#au-mobile">    </div>    <h3><a href="http://gamehot.mobi/game/tai-game-iwin.html"><em>iWin</em> - Đánh bài Online </a></h3>    <div class="desc">Tặng ngay 40.000 Win giúp bạn chơi không giới hạn với giờ vàng khuyến mại ngay tối nay!</div></div>
		<div class="sg-ads">    <div class="images">        <img src="http://image.sangame.net/images/2013/10/24/cCwLE.png" alt="#tay-du-ki">    </div>    <h3><a href="http://gamehot.mobi/game/tay-du-ky-online.html"><em>Tây Du Ký Online</em> - Hỏa Diệm Sơn </a></h3>    <div class="desc">Game nhập vai Online hấp dẫn, skill khủng. Trở thành Tôn Ngộ Không đại phá Hỏa Diệm Sơn.</div></div>
		</div>
		</div>
		';
		}else{
		echo'
		<div class="nav">
		Game Online đang HOT
		</div>
		<style>.sangame-container{margin-left:0;margin-right:0;padding-top:1px;padding-bottom:1px;font-family:arial,sans-serif;font-size:13px}.sangame-container .sg-header{font-weight:700;background:#edeff4;border-bottom:1px solid #d8dfea;padding:5px}.sangame-container .sg-more{font-size:11px;font-weight:700;background:#edeff4;padding:5px}.sangame-container .sg-more a{color:#12c}.sangame-container .sg-list .sg-ads{padding:5px}.sangame-container .sg-list .sg-ads:nth-child(odd){background-color:#fff8e7}.sangame-container .sg-list .sg-ads:nth-child(even){background-color:#fff}.sangame-container .sg-list .sg-ads .images{float:left;padding-right:5px;max-width:32px;max-height:32px}.sangame-container .sg-list .sg-ads h3{margin:0;padding:0;border:0;display:inline}.sangame-container .sg-list .sg-ads h3 a{color:#12c;font-weight:400;cursor:pointer;font-size:13px}.sangame-container .sg-list .sg-ads .desc{color:#666}.sangame-container em{font-weight:700;font-style:normal}.sg-default{display:none}</style>
		<div class="sangame-container">
		<div class="sg-list">
		<div class="sg-ads">    <div class="images">        <img src="https://static.mwork.vn/thumbs/unsafe/32x32/static.mwork.vn/data/images/apps/phongvantruyenky.png" alt="#phong-van">    </div>    <h3><a href="http://gamehot.mobi/game/phong-van-truyen-ky.html"><em>Phong vân truyền kỳ</em></a></h3>    <div class="desc">Game nhập vai, đánh theo lượt kết hợp đông - tây, hàng triệu Game thủ đã nhập cuộc. </div></div>
		<div class="sg-ads">    <div class="images">        <img src="http://image.sangame.net/images/2013/12/23/QXDIk.png" alt="#au-mobile">    </div>    <h3><a href="http://gamehot.mobi/game/tai-game-iwin.html"><em>iWin</em> - Đánh bài Online </a></h3>    <div class="desc">Tặng ngay 40.000 Win giúp bạn chơi không giới hạn với giờ vàng khuyến mại ngay tối nay!</div></div>
		<div class="sg-ads">    <div class="images">        <img src="http://image.sangame.net/images/2013/10/24/cCwLE.png" alt="#tay-du-ki">    </div>    <h3><a href="http://gamehot.mobi/game/tay-du-ky-online.html"><em>Tây Du Ký Online</em> - Hỏa Diệm Sơn </a></h3>    <div class="desc">Game nhập vai Online hấp dẫn, skill khủng. Trở thành Tôn Ngộ Không đại phá Hỏa Diệm Sơn.</div></div>
		</div>
		</div>';
		}
		
	}
?>
