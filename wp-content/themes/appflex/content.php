<?php
/**
 * @package NQD-Store-Smart
 */
?>
<ul>
	<li>
	
	<div class="app-logo">
	<a href="<?php the_permalink();?>" title="<?php the_title();?>">
	<span class="ribbon ribbon_free"></span>
	<img alt="<?php the_title();?>" src="<?php bloginfo('home'); ?>/media/resizer/64x64/r/<?php echo remove_http(catch_that_image($post));?>"></a>
	</div>
	<div class="app-info">
		<h2><a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_title();?></a></h2>
	</div>
			<?php
	$key_2_values = get_post_meta( get_the_ID(), '_infomation_manufacturers',true );
?>
	<div class="app_vendor">
	<?php echo $key_2_values;?>
	</div>
	<div class="app_dl">
	<a class="btn btn-down" href="<?php the_permalink();?>" title="tải về máy">
	Cài đặt</a>
	</div>
	<div class="rating">
		<img src="http://141.apk.vn/images/rating/4.5.png" border="0">&nbsp; <img src="http://141.apk.vn/images/icons/down.png" alt="67588 download"> <?php if(function_exists('the_views')) { the_views(); } ?>
	</div>
	<div class="ribbon ribbon_new"></div>
	<div class="clear"></div>
	</a>
	</li>
</ul>
