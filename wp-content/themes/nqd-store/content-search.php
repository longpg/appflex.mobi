				<ul class="nav nav-tabs">
				  <li class="active"><a href="#home" data-toggle="tab">Tìm kiếm</a></li>
				</ul>
				<div class="tab-content">
				  <div class="tab-pane active" id="home">
					<div class="list-app">
					<?php if ( have_posts() ) : ?>
						<?php while ( have_posts() ) : the_post(); ?>
						<?php
						get_template_part( 'content', get_post_format() );
						?>
						<?php endwhile;?>
						<?php pagination();?>
					<?php endif;?>
						<div class="clearfix"></div>
					</div>
				  </div>
				</div>