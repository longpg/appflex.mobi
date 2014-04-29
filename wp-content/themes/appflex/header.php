<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package NQD-Store-Smart
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<meta name='revisit-after' content='1 days'/>
<meta name="robots" content="index,follow" />
<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js?ver=1.7.2'></script>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?> 
</head>
<body <?php body_class(); ?>>
<div id="wrapper">
<div id="topholder">
<div id="topbar" style="left: 0px;">
<a style="text-align: center;" id="imgLogo" href="http://appflex.mobi/"><img alt="game android" src="http://appflex.mobi/logo.png"></a>
</div>
</div>