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
				<?php if ( in_category( '1' )) {
				echo'<h1 class="banner-title" itemprop="name">Tải Game '.$key_1_values.' miễn phí</h1>';
				} 
			 else {
				echo'<h1 class="banner-title" itemprop="name">Tải '.$key_1_values.' miễn phí</h1>';
					}
					?>
					
					<a rel="nofollow" class="header-link" href="<?php bloginfo('home'); ?>/manufacturers/<?php echo htmlentities($key_3_values);?>" itemprop="author"><?php echo $key_3_values;?></a> 
				</div>
				<div class="download-container">
					<a rel="nofollow" href="<?php bloginfo('home'); ?>/detail/<?php echo $post->ID?>" id="link-download" class="btn btn-success" ><i class="icon-cloud-download"></i> Tải về</a>
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


	<div id="site-main-content" class="col-lg-12">
		<div id="site-breadcrumbs">
			<?php NQD_breadcrumbs();?>
		</div>
		<ul class="nav nav-tabs" id="myTab">
		  <li class="active"><a href="#overview" data-toggle="tab">Giới thiệu</a></li>
		  <li><a href="#tab-comments" data-toggle="tab">Bình luận</a></li>
		</ul>

		<div class="tab-content">
		  <div class="tab-pane active" id="overview">
			<?php
			$key_image_values = get_post_meta( get_the_ID(), '_infomation_link_image',false );
			if(!empty($key_image_values)):
			?>
			<div class="overview-screenshots">
				<div class="overview-title">
					<h3>Screenshot</h3>
				</div>
				<div id="slider" class="carousel slide">
					<ol class="carousel-indicators">
						<?php 
						$i=0;
						foreach($key_image_values[0] as $value):
						?>
							<li data-target="#slider" data-slide-to="<?php echo $i;?>"></li>
					  <?php $i++; endforeach;?>
					</ol>
					<div class="carousel-inner">
						<?php 
						$j=0;
						foreach($key_image_values[0] as $value):
						?>
						 <div class="item <?php echo ($j==0)?'active':'';?> text-center">
							<img src="<?=$value;?>" alt="<?=$key_1_values?>"/>
						  </div>
						<?php 
							$j++ ;endforeach;
						?>
					</div>
					<a class="left carousel-control" href="#slider" data-slide="prev">
					  <span class="icon-prev"></span>
					</a>
					<a class="right carousel-control" href="#slider" data-slide="next">
					  <span class="icon-next"></span>
					</a>
			  </div>
			</div>
			<?php endif;?>

			<div class="overview-description">
				<div class="overview-title">
					<h3>Mô tả</h3>
				</div>
				<div class="overview-description-content">
				<?php if ( in_category( '1' )) {
				echo'<h2>Tải Game '.$key_1_values.' cho điện thoại Android</h2>';
				} 
			 else {
				echo'<h2>Tải '.$key_1_values.' cho điện thoại Android</h2>';
					}
					?>
					<?php the_content();?> 
				</div>
			</div>

						<div id="sameCategory">
				<div class="overview-title">
					<h3>Cùng chuyên mục</h3>
				</div>
				<div>
			<?php 
				$category = get_the_category($post->ID);
				$category = $category[0]->cat_ID;
				$args1 = array(
							'posts_per_page' => 4,
							'offset' => 0, 
							'category__in' => array($category), 
							'post__not_in' => array($post->ID),
							'post_status'=>'publish'
						);
				$my_query = new WP_Query($args1);
				$i=0;
				while ($my_query->have_posts()): 
					$my_query->the_post();
					$do_not_duplicate = $post->ID;
					$key_1_values = get_post_meta( $post->ID, '_infomation_name',true );
					$key_2_values = get_post_meta( $post->ID, '_infomation_version',true );
					$key_3_values = get_post_meta( $post->ID, '_infomation_manufacturers',true );
				?>
					<div class="col-lg-3 app-item">
							<div class="thumbnail-wrapper">
								<a href="<?php the_permalink();?>" class="thumbnail">
									<span class="ribbon ribbon_<?php if(strtotime($post->post_date_gmt)==strtotime($post->post_modified_gmt)) echo 'new'; else echo 'update';?>"></span>
									<img alt="<?php the_title();?>" src="<?php bloginfo('home'); ?>/media/resizer/78x78/r/<?php echo remove_http(catch_that_image($post));?>">
								</a>
								<div class="views">
									<i class="icon-eye-open"></i><?php if(function_exists('the_views')) { the_views(); } ?> views
								</div>
								<div class="install">
									<a href="<?php bloginfo('home'); ?>/detail/<?php echo $post->ID?>" class="btn btn-success btn-install" data-id="<?php echo $post->ID?>">
										<i class="icon-cloud-download"></i>Cài đặt
									</a>
								</div>
							</div>
							<div class="details">
								<a href="<?php the_permalink();?>" title="" class="title"><?php the_title();?></a>
								<div class="attribution"> <a href="<?php bloginfo('home'); ?>/manufacturers/<?php echo $key_3_values;?>"><?php echo $key_3_values;?></a> </div>
								<?php $rating = wp_gdsr_rating_article ($post->ID);	?>
								<span class="rating-static rating-<?php echo round($rating->rating)*10;?>"></span>
							</div>
					</div>
					<?php $i++;
				endwhile;
				wp_reset_query();
				?>
				<div class="clearfix"></div>
				</div>
			</div>
			
			<div class="overview-comment">
				<div class="overview-title">
					<h3>Bình luận</h3>
				</div>
				<div class="overview-comments-content">
					<?php
					$args = array(
						'number' => '5',
						'post_id' =>  $post->ID

					);
					$comments = get_comments($args);
					foreach($comments as $comment) :
					?>
					<div class="list-comments">
						<div class="comment-author vcard">
							<?php echo get_avatar( $comment, 50 ); ?>
							<?php printf( __( '%s <span class="says">says:</span>', 'nqd-store' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
						</div><!-- .comment-author -->
						<div class="comment-content">
							<?php echo $comment->comment_content;?>
						</div>
					</div>						
					<?php
					endforeach;
					?>
					<div id="view-all-comment">
						<a  href="#comments" title="Xem tất cả">Xem tất cả</a>
					</div>
				</div>
			</div>
		  </div>
		  <div class="tab-pane" id="tab-comments">
			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() )
					comments_template();
			?>
		  </div>
		  <div class="tab-pane" id="messages">...</div>
		</div>
	</div>
	<div class="clearfix"></div>

