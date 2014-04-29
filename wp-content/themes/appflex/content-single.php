<?php
/**
 * @package NQD-Store-Smart
 */
?>

<script>
            $(document).ready(function() {
                $("#fastdownid").click(function() {
                    $("#downloadlink").toggle(500);
                });
                $("#videotrailer").click(function() {
                    $("#videoplayer").toggle(500);
                });
            });
        </script>
<div class="title_app">
<ul>
<li class="appdetail">
                    <span class="ribbon_free"></span>
                    <span class="shadown">
                     <img src="<?php bloginfo('home'); ?>/media/resizer/57x57/r/<?php echo remove_http(catch_that_image());?>" title="<?php the_title();?>" alt="<?php the_title();?>"/>
                    </span>
<h1 class="comment"><?php the_title();?></h1>		
<?php
$nhasx = get_post_meta( get_the_ID(), '_infomation_manufacturers',true );
?>
<span class="name"><?php echo $nhasx;?></span>	
<span class="download">
<?php if(function_exists('the_ratings')) { the_ratings(); } ?>
</span>					
<div class="priceItem">
<a class="priceDown" href="#">
<span>Free</span>
</a>
<a id="fastdownid" class="quickDown" href="#">DOWNLOAD</a>
</div>
</li>
</ul>
</div>

<div id="downloadlink" style="color: green; font-weight: bold; display: none;" class="greyBg">
<ul><li>
<?php
			require_once 'Mobile_Detect.php';
			$detect = new Mobile_Detect;
			$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
			$scriptVersion = $detect->getScriptVersion();
			   if($deviceType=="computer"){
				$files = getFileByPostID(get_the_ID());
				foreach($files as $file):
						$file_id = $file->file_id;
						$post_id = $file->post_id;
						$file_name = $file->file_name;
						$file_url = $file->file;
						$file_des = $file->file_des;
						$file_size = formatBytes($file->file_size);
						$file_hits = $file->file_hits;
						$file_date = $file->file_date;
						$file_updated_date = $file->file_updated_date;
						$file_last_downloaded_date=$file->file_last_downloaded_date;
						$file_views = $file->file_views;
					
					$link_name = sanitize_title($file_name);
					$mylink =home_url('/') .'download/'.$file_id.'/'.$link_name;
					if(!isset($_SESSION['file_views'][$file_id])){
						$_SESSION['file_views'][$file_id]=$file_views+1;
						updateFile(array('file_views'=>$file_views+1),array('file_id'=>$file_id));			
					}
						echo'<a class="button" href="'.$mylink.'" rel="nofollow">ANDROID</a>
						<span style="display:inline-block;vertical-align:middle;width:70px;height:70px;background: url("http://chart.apis.google.com/chart?cht=qr&amp;chs=100x100&amp;chl='.$mylink.'") no-repeat center center;margin-left:6px;"></span>
						
						';
						endforeach;
			   }
			   else{
					$Android = stripos($_SERVER['HTTP_USER_AGENT'],"Android");
					if($Android){
					$files = getFileByPostID(get_the_ID());
						foreach($files as $file):
						$file_id = $file->file_id;
						$post_id = $file->post_id;
						$file_name = $file->file_name;
						$file_url = $file->file;
						$file_des = $file->file_des;
						$file_size = formatBytes($file->file_size);
						$file_hits = $file->file_hits;
						$file_date = $file->file_date;
						$file_updated_date = $file->file_updated_date;
						$file_last_downloaded_date=$file->file_last_downloaded_date;
						$file_views = $file->file_views;
					
					$link_name = sanitize_title($file_name);
					$mylink =home_url('/') .'download/'.$file_id.'/'.$link_name;
					if(!isset($_SESSION['file_views'][$file_id])){
						$_SESSION['file_views'][$file_id]=$file_views+1;
						updateFile(array('file_views'=>$file_views+1),array('file_id'=>$file_id));			
					}
						echo'<a class="button" href="'.$mylink.'" rel="nofollow">ANDROID</a>';
						endforeach;

					}else{
						if(get_field('java')){
						?>
						
					<a class="button" href="<?php echo the_field('java'); ?>" rel="nofollow">JAVA</a>
							<?php
						}
					}
					
				}
			?>
</ul></li>
</div>

<div class="app-decs" id="app_desc">
			<?php 
			$key_image_values = get_post_meta( get_the_ID(), '_infomation_link_image',false );
			if(is_array($key_image_values[0])):
			?>
			<div class="flex-container">
				<div class="flexslider">
					<ul class="slides">
						<?php
							foreach($key_image_values[0] as $value):
								?>
								<li>
									<img src="<?=$value;?>" alt="<?=$key_1_values?>" />
								</li>
								<?php 
									endforeach;
								?>
						</ul>
				</div>
			</div>
<?php endif;?>
</div>
<div id="app_desc_w">
	    <div class="app-decs" id="app_desc">
		<?php the_content(); ?>
</div>
</div>
<div class="quangcao">
Hãy sử dụng Opera Mini hoặc Google Chrome để duyệt web tốt hơn.
</div>