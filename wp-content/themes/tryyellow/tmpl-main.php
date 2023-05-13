<?php /* Template Name: Main page */
// $GLOBALS['CATAPULTA_TRYYELLOW_THEME']['use']['jqtouchswipe']=true;
$GLOBALS['CATAPULTA_TRYYELLOW_THEME']['use']['swiper']=true;
// $GLOBALS['CATAPULTA_TRYYELLOW_THEME']['use']['intltelinput']=true;
$GLOBALS['CATAPULTA_TRYYELLOW_THEME']['use']['jqanimnum']=true;
$GLOBALS['CATAPULTA_TRYYELLOW_THEME']['use']['lottie']=true;
get_header();
$arSlides=Array();
$arSlideInfo=Array();
$hero_slider = pods( 'hero_slider', Array('limit' => 99) );
while ( $hero_slider->fetch() ) {
	$arSlides[]=Array(
		'title' => $hero_slider->display('hero_slide_title'),
		'subtitle' => $hero_slider->display('hero_slide_subtitle'),
		'button_text' => $hero_slider->display('hero_slide_button_text'),
		'button_link' => $hero_slider->display('hero_slide_button_link'),
		'sort' => intval($hero_slider->display('hero_slide_sort')),
	);
}
usort($arSlides, function($a,$b) {return $a['sort']>$b['sort'];});
foreach ($arSlides as $arSlide) {
	$arSlideInfo=$arSlide;
	break;
}

?>
<section class="main-section">
	<div class="container">
		<div class="title-block animation">
			<h1 class="title title-1 -lexend-font -mob-title-1">
				<?php foreach ($arSlides as $arSlide) { ?>
					<li><?= $arSlide['title'] ?></li>
				<?php } ?>
			</h1>
			<p class="text description-2 -mob-text-1 --medium"><?= $arSlideInfo['subtitle'] ?></p>
			<a href="<?= $arSlideInfo['button_link'] ?>" class="button default-button -arrow"><?= $arSlideInfo['button_text'] ?></a>
		</div>
	</div>
</section>

<?php

$asSeenOn=Array();
$asSeenOnLogos = pods( 'as_seen_on', Array('limit' => 99) );
while ( $asSeenOnLogos->fetch() ) {
	$asSeenOn[]=Array(
		'title' => $asSeenOnLogos->display('title'),
		'logo' => $asSeenOnLogos->display('logo'),
		'sort' => intval($asSeenOnLogos->display('item_sort')),
	);
}
usort($asSeenOn, function($a,$b) {return $a['sort']>$b['sort'];});

?>
<section class="step-section default-margin-top">
	<div class="container animation">
		<div class="title-box">
			<h2 class="title title-2 -mob-title-2 -lexend-font">
				<?= get_field('mainpage_as_seen_on') ?>
			</h2>
		</div>

		<ul class="clients-list">
			<?php foreach ($asSeenOn as $arClient) { ?>
			<li class="clients-list-item">
				<div class="clients-list-item-bg">
					<img src="<?= $arClient['logo'] ?>" alt="<?= $arClient['title'] ?> - yellow.com">
				</div>
			</li>
			<?php } ?>
		</ul>
	</div>
</section>
<section class="section_we_create">
	<div class="container animation">
		<div class="title-box">
			<h2 class="title title-2 -mob-title-1 -lexend-font">
				<?= get_field('mainpage_section_we_create_title') ?>
			</h2>
		</div>
		<div class="section_we_create_subtitle">
			<?= get_field('mainpage_section_we_create_subtitle') ?>
		</div>
	</div>
</section>
<?php

$arHubspotItems=Array();
$hubspotitems = pods( 'hubspot_percent_item', Array('limit' => 99) );
while ( $hubspotitems->fetch() ) {
	$arHubspotItems[]=Array(
		'title' => $hubspotitems->display('hubspot_percent_item_title'),
		'subtitle' => $hubspotitems->display('hubspot_percent_item_subtitle'),
		'sort' => intval($hubspotitems->display('hubspot_percent_item_sort')),
	);
}
usort($arHubspotItems, function($a,$b) {return $a['sort']>$b['sort'];});

?>
<section class="section_hubspot">
	<div class="container animation">
		<div class="title-box">
			<h2 class="title title-2 -mob-title-1 -lexend-font">
				<?= get_field('mainpage_hubspot_block_title') ?>
			</h2>
			<!-- <div class="section_hubspot_subtitle">
				<?php //get_field('mainpage_hubspot_block_subtitle') ?>
			</div> -->
		</div>
		<div class="section_hubspot_items">
			<?php foreach ($arHubspotItems as $arItem) { ?>
				<div class="section_hubspot_item">
					<div class="section_hubspot_item_title anim_number_percent">
						<?= $arItem['title'] ?>
					</div>
					<div class="section_hubspot_item_description">
						<?= $arItem['subtitle'] ?>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</section>
<?php

$arVideosWeMake=Array();
$videoswemake = pods( 'videos_we_make_items', Array('limit' => 99) );
while ( $videoswemake->fetch() ) {
	$arVideosWeMake[]=Array(
		'title' => $videoswemake->display('videos_we_make_item_title'),
		'description' => $videoswemake->display('videos_we_make_item_description'),
		'sort' => intval($videoswemake->display('videos_we_make_item_sort')),
		'icon' => $videoswemake->display('videos_we_make_item_icon'),
		'image' => $videoswemake->display('videos_we_make_item_image'),
	);
}
usort($arVideosWeMake, function($a,$b) {return $a['sort']>$b['sort'];});

?>
<section class="proposal-section default-margin-top">
	<div class="container animation">
		<div class="title-box">
			<h2 class="title title-2 -mob-title-1 -lexend-font">
				<strong><?= get_field('mainpage_videos_we_make_title') ?></strong>
			</h2>
		</div>
		<ul class="proposal-list animation-list">
			<?php foreach ($arVideosWeMake as $arVideo) { ?>
			<li>
				<div class="icon">
					<img src="<?= $arVideo['icon'] ?>" alt="<?= $arVideo['title'] ?> - yellow.com">
				</div>
				<h4 class="title title-4 -mob-title-3"><?= $arVideo['title'] ?></h4>
				<p class="text text-1 -mob-text-1 --gray-font">
					<?= $arVideo['description'] ?>
				</p>
				<div class="image">
					<img src="<?= $arVideo['image'] ?>" alt="<?= $arVideo['title'] ?> Image - yellow.com">
				</div>
			</li>
			<?php } ?>
		</ul>
	</div>
</section>
<section class="portfolio-section default-margin-top">
	<div class="container animation">
		<div class="title-box">
			<h2 class="title title-2 -mob-title-1 -lexend-font"><?= get_field('mainpage_watch_our_showreel_title') ?></h2>
		</div>
		<div class="portfolio-video border-block -dark">
			<video class="video-element-item" data-src="<?= get_field('mainpage_watch_our_showreel_video')['url'] ?>" src="" poster="<?= get_field('mainpage_watch_our_showreel_preview')['url'] ?>" data-volume="0.2"></video>
			<?php //<p class="text --white-font">Watch the Showreel</p> ?>
			<a href="<?= get_field('mainpage_watch_our_showreel_button')['url'] ?>" class="button default-button -yellow -arrow -size-s"><?= get_field('mainpage_watch_our_showreel_button')['title'] ?></a>
			<div class="play-button video-play-button"></div>
		</div>
	</div>
</section>
<section class="our-portfolio default-margin-top">
	<div class="container animation">
		<div class="title-box">
			<h2 class="title title-2 -mob-title-2 -lexend-font">
				<?= get_field('mainpage_our_portfolio_title') ?>
			</h2>
		</div>
		<?= do_shortcode('[ess_grid alias="main_page_portfolio"][/ess_grid]') ?>
	</div>
</section>
<?php

$arOurClients=Array();
$ourclients = pods( 'our_clients_items', Array('limit' => 99) );
while ( $ourclients->fetch() ) {
	$arOurClients[]=Array(
		'title' => $ourclients->display('title'),
		'logo' => $ourclients->display('our_clients_item_logo'),
		'sort' => intval($ourclients->display('our_clients_item_sort')),
	);
}
usort($arOurClients, function($a,$b) {return $a['sort']>$b['sort'];});

?>
<section class="clients-section default-margin-top">
	<div class="container animation">
		<div class="title-box">
			<h2 class="title title-2 -mob-title-2 -lexend-font">
				<?= get_field('mainpage_our_clients_title') ?>
			</h2>
		</div>

		<ul class="clients-list">
			<?php foreach ($arOurClients as $arClient) { ?>
			<li class="clients-list-item">
				<div class="clients-list-item-bg">
					<img src="<?= $arClient['logo'] ?>" alt="<?= $arClient['title'] ?> - yellow.com">
				</div>
			</li>
			<?php } ?>
		</ul>
	</div>
</section>
<section class="clients-section default-margin-top">
	<div class="container animation">
		<!-- TrustBox widget - Micro Review Count -->
		<div class="trustpilot-widget" data-locale="en-US" data-template-id="5419b6a8b0d04a076446a9ad" data-businessunit-id="63677e58e587d7e508b5e5ce" data-style-height="24px" data-style-width="100%" data-theme="light" data-min-review-count="10" data-style-alignment="center">
		  <a href="https://www.trustpilot.com/review/tryyellow.com" target="_blank" rel="noopener">Trustpilot</a>
		</div>
		<!-- End TrustBox widget -->
		<div class="yel_testimonial_wrp">
			<?php echo do_shortcode( '[rt-testimonial id="330" title="home"]' ) ?>
		</div>
	</div>
</section>
<?php

$arTestimonialVideos=Array();
$testimonialvideos = pods( 'testimonial_videos', Array('limit' => 99) );
while ( $testimonialvideos->fetch() ) {
	$arTestimonialVideos[]=Array(
		'src' => $testimonialvideos->display('testimonial_video_file'),
		'poster' => $testimonialvideos->display('testimonial_video_preview'),
		'sort' => intval($testimonialvideos->display('testimonial_video_sort')),
	);
}
usort($arTestimonialVideos, function($a,$b) {return $a['sort']>$b['sort'];});

?>
<section class="testimonial-videos default-margin-top">
	<div class="container animation">
		<div class="title-box">
			<h2 class="title title-2 -mob-title-1 -lexend-font"><?= get_field('mainpage_testimonial_video_title') ?></h2>
		</div>
		<div class="testimonial-videos-slider">
			<div class="swiper-wrapper">
			<?php foreach ($arTestimonialVideos as $arVideo) { ?>
				<div class="swiper-slide testimonial-videos-slide">
					<div class=" testimonial-videos-slide-border">
						<video class="video-element-item" data-src="<?= $arVideo['src'] ?>" src="" poster="<?= $arVideo['poster'] ?>" ></video>
						<div class="play-button video-play-button"></div>
					</div>
				</div>
			<?php } ?>
			</div>
			<div class="testimonial-videos-pagination"></div>
		</div>
	</section>
</section>
<?php

$arOurAccomplishments=Array();
$ouraccomplishments = pods( 'our_accomplishments', Array('limit' => 99) );
while ( $ouraccomplishments->fetch() ) {
	$arOurAccomplishments[]=Array(
		'title' => $ouraccomplishments->display('title'),
		'logo' => $ouraccomplishments->display('our_accomplishments_item_logo'),
		'sort' => intval($ouraccomplishments->display('our_accomplishments_item_sort')),
	);
}
usort($arOurAccomplishments, function($a,$b) {return $a['sort']>$b['sort'];});

?>
<section class="accomplishments-section default-margin-top">
	<div class="container animation">
		<div class="title-box">
			<h2 class="title title-2 -mob-title-2 -lexend-font">
				<?= get_field('mainpage_accomplishments_title') ?>
			</h2>
		</div>
		<ul class="accomplishments-list">
			<?php foreach ($arOurAccomplishments as $arAccomplishment) { ?>
			<li class="accomplishments-list-item">
				<div class="accomplishments-list-item-bg">
					<img src="<?= $arAccomplishment['logo'] ?>" alt="<?= $arAccomplishment['title'] ?> - yellow.com">
				</div>
			</li>
			<?php } ?>
		</ul>
	</div>
</section>

<section class="step-section default-margin-top">
	<div class="container animation">
		<div class="title-box">
			<h2 class="title title-2 -mob-title-1 -lexend-font">
				<?= get_field('mainpage_section_123_title') ?>
			</h2>
		</div>
		<?php

		$ar123Slides=Array();
		$_123slider = pods( 'section_123_items', Array('limit' => 99) );
		while ( $_123slider->fetch() ) {
			$ar123Slides[]=Array(
				'title' => $_123slider->display('section_123_item_title'),
				'subtitle' => $_123slider->display('section_123_item_subtitle'),
				'button_text' => $_123slider->display('section_123_item_button_text'),
				'button_link' => $_123slider->display('section_123_item_button_link'),
				'sort' => intval($_123slider->display('section_123_item_sort')),
			);
		}
		usort($ar123Slides, function($a,$b) {return $a['sort']>$b['sort'];});

		?>
		<div class="swiper">
			<div class="swiper-wrapper step-list">
			<?php foreach ($ar123Slides as $arSlide) { ?>
				<div class="swiper-slide">
					<div class="step --medium">
						<div class="img">
							<div class="json-animation"></div>
							<a href="<?= $arSlide['button_link'] ?>" class="button default-button -arrow -size-s"><?= $arSlide['button_text'] ?></a>
						</div>
						<h3 class="title description-1 -mob-description-1">
							<?= $arSlide['title'] ?>
						</h3>
						<p class="text text-1 -mob-text-1 --gray-font">
							<?= $arSlide['subtitle'] ?>
						</p>
					</div>
				</div>
			<?php } ?>
			</div>
		</div>
	</div>
</section>

<?php

$arOurTeam=Array();
$ourteam = pods( 'our_team_items', Array('limit' => 99) );
while ( $ourteam->fetch() ) {
	$arOurTeam[]=Array(
		'name' => $ourteam->display('our_team_item_name'),
		'post' => $ourteam->display('our_team_item_post'),
		'sort' => intval($ourteam->display('our_team_item_sort')),
		'photo' => $ourteam->display('our_team_item_photo'),
	);
}
usort($arOurTeam, function($a,$b) {return $a['sort']>$b['sort'];});

?>
<section class="about-section default-margin-top">
	<div class="container animation">
		<div class="title-box">
			<h2 class="title title-2 -mob-title-1 -lexend-font"><?= get_field('mainpage_out_team_title') ?></h2>
		</div>
		<div class="border-block about-block">
			<h2 class="title title-2 -mob-title-1 -lexend-font --mob">
				<?= get_field('mainpage_out_team_title') ?>
			</h2>
			<div class="team_swiper">
				<div class="swiper-wrapper">
					<?php foreach ($arOurTeam as $arTeamItem) { ?>
					<div class="swiper-slide">
						<img src="<?= $arTeamItem['photo'] ?>" alt="<?= $arTeamItem['name'] ?>" class="team_img">
						<div class="team_info">
							<h4 class="description-1"><?= $arTeamItem['name'] ?></h4>
							<p class="text-1 --gray-font"><?= $arTeamItem['post'] ?></p>
						</div>
					</div>
				<?php } ?>
				</div>
				<div class="swiper-pagination"></div>
				<div class="swiper-counter text-1 --gray-font"></div>
			</div>
			<div class="text-block">
				<div class="text text-1 -mob-text-1">
					<p>
						<?= get_field('mainpage_out_team_description') ?>
					</p>
				</div>
				<p class="author text-1 -mob-text-1"><?= get_field('mainpage_out_team_footer_text') ?></p>
				<a href="<?= get_field('mainpage_out_team_button')['url'] ?>" class="button default-button -yellow -arrow"><?= get_field('mainpage_out_team_button')['title'] ?></a>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>