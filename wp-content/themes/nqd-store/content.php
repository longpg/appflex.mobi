<?php 
	$key_3_values = get_post_meta( get_the_ID(), '_infomation_manufacturers',true );
?>
<div class="col-lg-3 col-xs-12 col-st-6 col-sm-4 col-md-3 app-item">
	<div class="thumbnail-wrapper">
		<a href="<?php the_permalink();?>" class="thumbnail">
			<span class="ribbon ribbon_<?php if(strtotime($post->post_date_gmt)==strtotime($post->post_modified_gmt)) echo 'new'; else echo 'update';?>"></span>
			<img alt="<?php the_title();?>" src="<?php bloginfo('home'); ?>/media/resizer/78x78/r/<?php echo remove_http(catch_that_image($post));?>">
		</a>
		<div class="views">
			<i class="icon-eye-open"></i><?php if(function_exists('the_views')) { the_views(); } ?> <?php _e("views","nqd-store");?>
		</div>
		<div class="install">
			<a rel="nofollow" href="<?php the_permalink();?>" class="btn btn-success btn-install" data-id="<?php echo $post->ID?>">
				<i class="icon-cloud-download"></i><?php _e("Cài đặt","nqd-store");?>
			</a>
		</div>
	</div>
	<div class="details">
		<a href="<?php the_permalink();?>" title="<?php the_title();?>" class="title"><?php the_title();?></a>
		<div class="attribution"> <a rel="nofollow" href="<?php bloginfo('home'); ?>/manufacturers/<?php echo urlencode($key_3_values);?>"><?php echo $key_3_values;?></a> </div>
		<?php $rating = wp_gdsr_rating_article ($post->ID);	?>
		<span class="rating-static rating-<?php echo round($rating->rating)*10;?>"></span>
	</div>
</div>
	