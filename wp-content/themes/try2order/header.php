<?php
/**
 * Header file for the Twenty Twenty WordPress default theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?><!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

	<head>

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" >

		<link rel="profile" href="https://gmpg.org/xfn/11">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
		<link rel="stylesheet" id="twentytwenty-style-css" href="<?php echo get_theme_file_uri(); ?>/assets/css/swiper-bundle.min.css">
		<?php wp_head(); ?>

	</head>

	<body class="load" >

		<?php
		wp_body_open();
		?>
		<header>
			<a class="logo" href="#main" data-menuachor="main">
				<div class="white_logo" >
					<img src="<?php echo get_theme_file_uri(); ?>/assets/images/white-logo.svg" alt="" class="new_white_logo" style="display:none">
					<img src="<?php echo get_theme_file_uri(); ?>/assets/images/logo-new.svg" alt="" class="new_green_logo">
				</div>
				<div class="black_logo">
					<img src="<?php echo get_theme_file_uri(); ?>/assets/images/green-logo.svg" alt="">
				</div>
				<!--  <div class="new_green_logo" >
					<img src="<?php echo get_theme_file_uri(); ?>/assets/images/logo-new.svg" alt="">
				</div> -->
		
			</a>
			<div class="menu_container_mobile">
				<nav class="menu menu_header">
					<li data-menuachor="our_why">
						<a href="#our_why"> Our Why</a>
					</li>
					<li data-menuachor="problem">
						<a href="#problem"> Problem </a>
					</li>
					<li data-menuachor="solution">
						<a href="#solution"> Solution </a>
					</li>
					<li data-menuachor="benefits">
						<a href="#benefits"> Benefits</a>
					</li>
					<li data-menuachor="how_it_Works">
						<a href="#how_it_Works"> How It Works </a>
					</li>
					<li data-menuachor="the_platform">
						<a href="#the_platform"> Platform </a>
					</li>
					<li data-menuachor="team">
						<a href="#team"> Team </a>
					</li>

					<a class="button_start" href="#">Contact Us</a>
				</nav>
			</div>
			<!-- <a class="button_start button_start_mobile" href="#">Get Started</a> -->
			<div class="menu_open menu_open_click">
				<div></div>
				<div></div>
			</div>
		</header>