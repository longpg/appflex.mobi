<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package NQD-Store-Smart
 */

get_header(); ?>
		<?php if ( have_posts() ) : ?>
		<div class="list-app">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php
					get_template_part( 'content', get_post_format() );
				?>
			<?php endwhile; ?>
		<div class='show-pagination'>
		<?php wp_pagenavi(); ?>
		</div>
		<?php else : ?>
		<?php get_template_part( 'no-results', 'archive' ); ?>
		</div>
		<?php endif; ?>
<?php get_footer(); ?>
