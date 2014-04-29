<?php
/*
Template Name: Download Detail
*/
?>
<?php
	$post_id = get_query_var('post_id');
	$files = getFileByPostID($post_id);
	$post = get_post($post_id);
	//echo "<pre>";var_dump($post);exit;
	global $download_post_name;
	$download_post_name = $post->post_title;
	$key_1_values = get_post_meta( get_the_ID(), '_infomation_name',true );
	$key_2_values = get_post_meta( get_the_ID(), '_infomation_version',true );
	$key_3_values = get_post_meta( get_the_ID(), '_infomation_manufacturers',true );	
?>
<?php 
	get_header();
?>
<div class="site-download">
	<div id="site-breadcrumbs">
		<?php NQD_breadcrumbs();?>
	</div>
		<div class="post-container">
			<div class="post-info" itemscope itemtype="http://data-vocabulary.org/Recipe">
				<div class="post_thumb">
					<img itemprop="photo" src="<?php bloginfo('home'); ?>/media/resizer/57x57/r/<?php echo remove_http(catch_that_image());?>" title="<?php the_title();?>">
				</div>
				<h1 itemprop="name"><?php the_title();?></h1>
				<div class="info">
					<span class="post_date"><?php echo time_stamp(get_post_time('U', true)); ?></span>
				</div>
				<div class="stats">
					<span class="post_view"><?php if(function_exists('the_views')) { the_views(); } ?></span>
					<span class="post_comment"><?php comments_number('0','1','%');?></span>
				</div>
				<div class="clearfix"></div>
				<div class="rating" itemprop="review" itemscope itemtype="http://schema.org/AggregateRating" >
					<?php $rating = wp_gdsr_rating_article ($post->ID);	?>
					<span class="rating-static rating-<?php echo round($rating->rating)*10;?>"></span>
					<div class="rating-itemprop">
						<span class="rating-value" itemprop="rating"><?php echo $rating->rating;?></span> / <span >5</span> (<span class="rating-count" itemprop="count"><?php echo $rating->user_votes+$rating->visitor_votes;?></span> bình chọn)
					</div>
					<div class="clear"></div>
				</div>
			</div>
			<div class="download">
		<?php
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
		?>
			<div class="download-link">
				<a  href="<?=$mylink ?>" title="<?=$file_des;?>" rel="nofollow">
					<span class="text-bold">Tải về <?=$file_name?></span> [ <?=$file_size?> - <?=$file_hits?> lượt ]
				</a>
			</div>
		<?php endforeach;?>
		</div>
		</div>
		
</div>
<?php get_footer();?>