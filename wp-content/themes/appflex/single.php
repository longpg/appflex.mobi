<?php
/**
 * The Template for displaying all single posts.
 *
 * @package NQD-Store-Smart
 */

get_header(); ?>

<div class="pathbar path">
<div class="leftpath"> 
<span id="breadcrumbs"><a href="http://appflex.mobi/"></a>  <?php the_category(' '); ?>  </span>            
</div>
</div>
<?php /** <div class="breadcrumb" id="crumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
<span typeof="v:Breadcrumb"> <a rel="v:url" property="v:title" href="<?php bloginfo('home'); ?>">Trang chủ</a></span> <?php the_category(' '); ?>

</div> */?>

			
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'content', 'single' ); ?>
		<?php endwhile;  ?>

<?php get_footer(); ?>