<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <main id="main">
 *
 * @package NQD Store
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="shortcut icon" href="http://gamehot.mobi/favicon.ico" type="image/x-icon" />
<link rel="author" href="https://plus.google.com/105385279061093594423"/>
<meta name='revisit-after' content='1 days' />
<meta name="robots" content="index,follow" />
<meta name="dcterms.rightsHolder" content="Copyright 2013 GameHot.Mobi">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
 <div class="container" id="site-container">
		<div class="col-lg-12" id="site-navigation">
			<nav class="navbar navbar-default" role="navigation">
					<nav class="navbar navbar-default" role="navigation">
						 <!-- Brand and toggle get grouped for better mobile display -->
						  <div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
							  <span class="sr-only">Toggle navigation</span>
							  <span class="icon-bar"></span>
							  <span class="icon-bar"></span>
							  <span class="icon-bar"></span>
							</button>
<?php
if ( is_home() ) {
    echo'<h1 class="navbar-h1"><a class="navbar-brand" href="http://gamehot.mobi/" title="game android">Game Android</a></h1>';
} else {
   echo'<div class="navbar-h1"><a class="navbar-brand" href="http://gamehot.mobi/" title="game android">Game Android</a></div>';
}
?>


						  </div>
						  <!-- Collect the nav links, forms, and other content for toggling -->
						  <div class="collapse navbar-collapse navbar-ex1-collapse">
							  		<?php
										$args = array(
											'theme_location' => 'primary',
											'depth'		 => 0,
											'container'	 => false,
											'menu_class'	 => 'nav',
											'items_wrap' => '<ul class="nav navbar-nav">%3$s</ul>',
											'walker'	 => new BootstrapNavMenuWalker()
										);
										wp_nav_menu($args);
									?>
					
							<form class="navbar-form navbar-right" role="search">
							  <div class="form-group">
								<input type="text" class="form-control" placeholder="Tìm kiếm" name="s">
							  </div>
							</form>
							
						  </div><!-- /.navbar-collapse -->
					</nav>
			</nav>
		</div>