<?php

?><!DOCTYPE html>
<html lang="en">
	<head>
		<script async src="https://www.googletagmanager.com/gtag/js?id=G-G0KKG7HGX0"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());
			gtag('config', 'G-G0KKG7HGX0');
		</script>
		<meta charset="utf-8">
		<!-- Yandex.Metrika counter -->
		<script type="text/javascript" >
			(function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
			m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
			(window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");
			ym(86916983, "init", {
				clickmap:true,
				trackLinks:true,
				accurateTrackBounce:true,
				webvisor:true
			});
		</script>
		<noscript><div><img src="https://mc.yandex.ru/watch/86916983" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
		<!-- /Yandex.Metrika counter -->
		<?php
			wp_head();
		?>
		<?php //<meta name="title" content="yellow - Enjoy the Limelight"> ?>
		<?php //<meta name="description" content="We Create Dynamic, Eye Catching, Modern Websites for Your Brand"> ?>
		
		<link rel="canonical" href="https://yellow.com/">

		<!-- Mobile -->
		<meta name="viewport" content="width=device-width">
		<meta name="format-detection" content="telephone=no">

		<!--	Favicon	-->
		<link rel="apple-touch-icon" sizes="180x180" href="<?=$GLOBALS['CATAPULTA_TRYYELLOW_THEME']['template_url']?>/img/favicon/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="<?=$GLOBALS['CATAPULTA_TRYYELLOW_THEME']['template_url']?>/img/favicon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="<?=$GLOBALS['CATAPULTA_TRYYELLOW_THEME']['template_url']?>/img/favicon/favicon-16x16.png">
		<!--		<link rel="manifest" href="/site.webmanifest">-->
		<link rel="mask-icon" href="<?=$GLOBALS['CATAPULTA_TRYYELLOW_THEME']['template_url']?>/img/favicon/safari-pinned-tab.svg" color="#fedd00">
		<meta name="msapplication-TileColor" content="#fedd00">
		<meta name="theme-color" content="#fedd00">

		<!-- Opengraph -->
		<?php
			$og_sitename = 'yellow - Enjoy the Limelight';
			$og_url = get_permalink();
			$og_title = get_the_title();
			$og_img = $GLOBALS['CATAPULTA_TRYYELLOW_THEME']['template_url'] . '/img/opengraph.png';
		?>
		<meta name="twitter:card" content="summary_large_image">
		<meta property="og:type" content="website">
		<meta property="og:image:type" content="images/png">
		<meta property="og:image:width" content="1200">
		<meta property="og:image:height" content="630">
		<meta property="og:url" content="<?=$og_url?>" />
		<meta property="og:site_name" content="<?=$og_sitename?>">
		<meta property="og:title" content="<?=$og_title?>" />
		<meta property="og:description" content="We Create Dynamic, Eye Catching, Modern Websites for Your Brand">
		<meta property="og:image" content="<?=$og_img?>" />
		
		<script src="//code.tidio.co/ps8smo2h5zm2nbpuqfsgmuchiyyrhrgj.js" async></script>
		<!-- TrustBox script -->
		<script type="text/javascript" src="//widget.trustpilot.com/bootstrap/v5/tp.widget.bootstrap.min.js" async></script>
		<!-- End TrustBox script -->
	</head>

	<body class="<?= $GLOBALS['CATAPULTA_TRYYELLOW_THEME']['header_body_class'] ?>">
		<?php if (!custom_class_check()) { ?>
			<section class="yel_timer_section">
				<div class="container animation">
					<div class="yel_hurry_up_wrp">
						<?php echo do_shortcode('[hurrytimer id="310"]'); ?>
						<?php //echo do_shortcode( '[ec id="1"]' ); ?>
					</div>	
				</div>
			</section>
		<?php } ?>
		<header class="header <?= $GLOBALS['CATAPULTA_TRYYELLOW_THEME']['header_header_class'] ?>">
			<div class="container">
				<a href="/" class="main-logo">
					<img src="<?=$GLOBALS['CATAPULTA_TRYYELLOW_THEME']['template_url']?>/img/logo.svg" alt="yellow.com">
				</a>
			</div>
		</header>
		<?php
		// Check if the cookie is set
		/*$timer = "";
		echo "<pre>";
		var_dump($_COOKIE['countdown1']);
		echo "</pre>";
		
		$cookie_name = "countdown1";

		if(isset($_COOKIE[$cookie_name])) {
		// Get the current time in seconds
		$current_time = time();
		var_dump($current_time);
		// Get the time the cookie was set in seconds
		$cookie_time = $_COOKIE[$cookie_name];

		// Calculate the difference between the two times in seconds
		$time_difference = $current_time - $cookie_time;

		// Calculate the time in days, hours, minutes, and seconds
		$days = floor($time_difference / 86400);
		$hours = floor(($time_difference % 86400) / 3600);
		$minutes = floor(($time_difference % 3600) / 60);
		$seconds = $time_difference % 60;

		$timer = "Cookie has been set for $days days, $hours hours, $minutes minutes, and $seconds seconds.";
		} else {
		$timer = "Cookie not set.";
		}*/

		?>
		<!-- <div style="height: 50px; width: 100%; background-color: black; position: static; top: 0; left: 0;color: #fff;">
			<p>Hurry up and get the offer end in <span id="yel_timer"><?php echo $timer; ?></span></p>
		</div> -->

		<main class="<?= $GLOBALS['CATAPULTA_TRYYELLOW_THEME']['header_main_class'] ?>">