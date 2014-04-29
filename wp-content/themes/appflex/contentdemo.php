<?php
/**
 * @package NQD-Store-Smart
 */
?>
<div class="contentdemo">

<div class="content-items">
					<a href="http://appcent.vn/?app=com.asobimo.avabel_gp_b3"><img src="http://gamehot.mobi/media/resizer/64x64/r/gamehot.mobi/wp-content/uploads/2013/10/0ybeI.png" class="album-img" width="72" height="72"></a>
					<a href="https://play.google.com/store/apps/details?id=com.appcent&amp;hl=en&amp;utm_source=appcent.vn"><img style="float: right; margin:0; padding: 0" src="http://appcent.vn/images/btn2.png" class="album-img" width="50" height="74"></a>
					<h3>ONLINE RPG AVABEL</h3>
					<h4></h4>
					<h4>Asobimo, Inc.</h4>					
					<ul class="info-des">

					</ul>
					<ul class="info-des">
						<li>Phiên bản: 2.0.16</li>
						<li>Lượt tải: 1000</li>
						<li>Dung lượng: 18.4 MBM</li>						
						<li>Đánh giá: 4<img src="http://appcent.vn/images/resources/full.png"><img src="http://appcent.vn/images/resources/full.png"><img src="http://appcent.vn/images/resources/full.png"><img src="http://appcent.vn/images/resources/full.png"><img src="http://appcent.vn/images/resources/full.png"></li>						
					</ul>
					
				</div>
</div>
<article id="post-<?php the_ID(); ?>" class="store">
	<div class="info">
		<span class="ribbon ribbon_<?php if(strtotime($post->post_date_gmt)==strtotime($post->post_modified_gmt)) echo 'new'; else echo 'update';?>"></span>
		<span class="shadown"><img alt="<?php the_title();?>" src="<?php bloginfo('home'); ?>/media/resizer/64x64/r/<?php echo remove_http(catch_that_image($post));?>"></span>
		<span class="comment"><a href="<?php the_permalink();?>" title="<?php the_title();?>">
		<?php if ( in_category( '1' )) {
				$url = get_the_title();
				echo'<strong>'.$url.'</strong>';
				} 
			 else {
				$url = get_the_title();
				echo'<strong>Tải '.$url.'</strong>';
			}?>
		</a></span>
		<span class="post_date"> <?php echo excerpt(35); ?> </span>
		<?php $rating = wp_gdsr_rating_article ($post->ID);	?>
		<span class="rating-static rating-<?php echo round($rating->rating)*10;?>"></span>
		<span class="post_view"><?php if(function_exists('the_views')) { the_views(); } ?></span>
	</div>
</article>
