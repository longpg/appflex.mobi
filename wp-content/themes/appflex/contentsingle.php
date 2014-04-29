<?php
/**
 * @package NQD-Store-Smart
 */
?>

<article id="post-<?php the_ID(); ?>" class="store">
	<div class="info">
		<span class="ribbon ribbon_<?php if(strtotime($post->post_date_gmt)==strtotime($post->post_modified_gmt)) echo 'new'; else echo 'update';?>"></span>
		<span class="shadown"><img alt="<?php the_title();?>" src="<?php bloginfo('home'); ?>/media/resizer/64x64/r/<?php echo remove_http(catch_that_image($post));?>"></span>
		<span class="comment"><a href="<?php the_permalink();?>" title="<?php the_title();?>">
		<?php if ( in_category( '1' )) {
				$url = get_the_title();
				echo'<strong>Tải Game '.$url.'</strong>';
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
</article><!-- #post-## -->
