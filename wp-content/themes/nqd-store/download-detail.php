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
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>"/>
<meta name="viewport" content="width=device-width"/>
<meta name="description" content="<?php echo substr(strip_tags($post->post_content),0,160);?>" />
<title><?php $post->post_title.' '.wp_title( '|', true, 'right' ); ?></title>
<meta name="keywords" content="<?php echo $post->post_title;?>,tai game android,tai game android mien phi" />
<meta property="og:type" content="article" />
<meta property="og:title" content="<?php echo $post->post_title;?>" />
<meta property="og:description" content="<?php echo substr(strip_tags($post->post_content),0,160);?>" />
<meta property="og:url" content="<?php bloginfo('home'); ?>/detail/<?php echo $post_id;?>" />
<meta property="og:image" content="<?php bloginfo('home'); ?>/media/resizer/70x70/r/<?php echo remove_http(catch_that_image($post));?>" />
<meta property="article:published_time" content="<?php echo get_the_time('d-m-Y', $post->ID); ?>" />
<meta property="article:modified_time" content="<?php echo get_the_modified_date( 'd-m-Y' ); ?>" />
<meta property="article:author" content="<?php echo get_author_posts_url( $post->post_author); ?>" />
<meta property="og:site_name" content="<?php bloginfo('name');?>" />
<meta name="twitter:card" content="summary" />
<link rel="profile" href="http://gmpg.org/xfn/11"/>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"/>
<link media="all" type="text/css" href="<?php bloginfo( 'stylesheet_url' ); ?>" id="nqd-store-style-css" rel="stylesheet"/>
</head>
<?php echo get_the_author_meta( 'ID' );?>
<body <?php body_class(); ?>>
<div class="site-download">
	<div id="site-breadcrumbs">
		<?php NQD_breadcrumbs();?>
	</div>
	<div class="site-download-content">
		<?php
	$key_1_values = get_post_meta( get_the_ID(), '_infomation_name',true );
	$key_2_values = get_post_meta( get_the_ID(), '_infomation_version',true );
	$key_3_values = get_post_meta( get_the_ID(), '_infomation_manufacturers',true );
?>
	<div id="site-detail" itemscope itemtype="http://data-vocabulary.org/Recipe">
		<div class="col-lg-10">
			<div class="col-lg-3 col-sm-12 thumbnail-container text-center">
				<img itemprop="photo" src="<?php bloginfo('home'); ?>/media/resizer/124x124/r/<?php echo remove_http(catch_that_image());?>">
			</div>
			<div class="col-lg-9 col-sm-12">
				<div class="col-lg-7">
					<div class="title-container">
						<h1 class="banner-title" itemprop="name"><?php echo $key_1_values;?></h1>
						<a class="header-link" href="<?php bloginfo('home'); ?>/manufacturers/<?php echo htmlentities($key_3_values);?>" itemprop="author"><?php echo $key_3_values;?></a> 
					</div>
				</div>
				<div class="col-lg-5 visible-lg">
					<div class="metadata-list">
					<ul itemprop="review" itemscope itemtype="http://data-vocabulary.org/Review-aggregate">
						<li><span>Thời gian cập nhật:</span> <?php the_time( 'd.m.Y' ); ?> </li>
						<li><span>Phiên bản:</span> <?php echo $key_2_values;?></li>
						<?php $rating = wp_gdsr_rating_article ($post->ID);	
							
						?>
						<li><span>Đánh giá bởi người dùng</span>: <span class="white" itemprop="rating"><?php echo $rating->rating;?></span></li>
						<li><span>Chuyên mục:</span> <?php the_category(', ');?></li>
						<li><span>Lượt xem:</span><span class="white" itemprop="count" ><?php if(function_exists('the_views')) { the_views(); } ?></span> views</li>
						<li><span>Kích thước:</span> <?php echo formatBytes(getFileSizeByPostID($post->ID));?></li>
					</ul>
				</div>
				</div>
			</div>
		</div>
		<div class="col-lg-2 visible-lg">
			<div class="qrcodes text-center">
				<?php 
						$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'phpqrcode'.DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
						if (!file_exists($PNG_TEMP_DIR))
							mkdir($PNG_TEMP_DIR);
							
						$filename = $PNG_TEMP_DIR. $post->ID .'.png';
						if(file_exists($filename)){
							$imgurl= get_template_directory_uri() ."/lib/phpqrcode/temp/" . $post->ID . ".png";
						}else{
							QRcode::png(get_permalink(),$filename,QR_ECLEVEL_L,2);
							$imgurl= get_template_directory_uri() ."/lib/phpqrcode/temp/" . $post->ID . ".png";
						}
						?>
				<img src="<?php echo $imgurl; ?>" alt="<?php echo get_the_title($post->ID);?>"/>
			</div>
		</div>
		<div class="clearfix">
		</div>
	</div>
	
	</div>
	<div id="site-download-link">
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
		<div class="download_link">
			<a  href="<?=$mylink ?>" title="<?=$file_des;?>" rel="nofollow">
				<div class="btn btn-warning">
					<i class="icon-download-alt"></i> 
				</div>	
				<span class="text-bold"><?=$file_name?></span> [ <?=$file_size?> - <?=$file_hits?> lượt ]
			</a>
		</div>
	<?php endforeach;?>
	</div>
</div>
</body>
</html>