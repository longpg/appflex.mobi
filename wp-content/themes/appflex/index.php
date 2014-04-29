<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *

 * @package NQD-Store-Smart
 */
 
global $NHP_Options;
get_header(); ?>
<div id="tabmenu">
    <ul class="individual">
        <li class="selected"><a href="http://appflex.mobi/"><span>Mới nhất</span></a></li>
        <li><a href="http://appflex.mobi/top-views"><span>Hot nhất</span></a></li>
        <li><a href="http://appflex.mobi/top-downloads"><span>Tải nhiều</span></a></li>
    </ul>
</div>

<div class="list-app">
	<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>
	<?php
		get_template_part( 'content', get_post_format() );
	?>
	<?php endwhile; ?>
	<div class='show-pagination'>
	<?php wp_pagenavi(); ?>
	</div>
	
	<?php else : ?>
	<?php get_template_part( 'no-results', 'index' ); ?>
	<?php endif; ?>
</div>
</div>

<?php get_footer(); ?>