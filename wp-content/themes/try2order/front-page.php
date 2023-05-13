<?php /*Template Name: FrontPage*/ ?>
<?php get_header(); ?>
<?php while (have_posts()) : the_post(); ?>
<!-- <div class="red_circle_out">
<div class="video_js_preload_percent">
<svg xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" width="64px" height="64px" viewBox="0 0 128 128" xml:space="preserve">
<g>
<linearGradient id="linear-gradient">
<stop offset="0%" stop-color="rgba(255,255,255,1)"/>
<stop offset="100%" stop-color="rgba(255,255,255,0)"/>
</linearGradient>
<path d="M63.85 0A63.85 63.85 0 1 1 0 63.85 63.85 63.85 0 0 1 63.85 0zm.65 19.5a44 44 0 1 1-44 44 44 44 0 0 1 44-44z" fill="url(#linear-gradient)" fill-rule="evenodd"/>
<animateTransform attributeName="transform" type="rotate" from="0 64 64" to="360 64 64" dur="1440ms" repeatCount="indefinite"/>
</g>
</svg>
</div>
</div> -->

<div class="hidden_list_block">
  <ul class="hidden_list">
  </ul>
</div>
<div class="line_scrollbar" style="height: 0;">
  <div class="line_grey">
    <div class="line_current_slide"></div>
  </div>
</div>
<div id="pagepiling">
  <div class="section footer_link main_page" data-anchor="page1" id="main" data-page-title="Text2Order: Home">
    <?php
			if (have_rows('banner_section')) :
				while (have_rows('banner_section')) : the_row();
					$content 		= get_sub_field('content');
					$video_link_url 		= get_sub_field('video_link');
					// $video_link_url 	= $video_link['url'];
					// $video_link_url 	= "https://player.vimeo.com/video/809513660?background=1&autoplay=0&loop=1&byline=0&title=0&muted=1";
			?>
	  <!--<video id="merivideo" class="video_bg" autoplay loop muted playsinline webkit-playsinline src="<?php echo $video_link_url; ?>"></video>-->
    <iframe class="video_bg video_iframe video_iframe_main" src="<?php echo $video_link_url; ?>" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen allow="autoplay"></iframe>
    <div class="line_scrollbar"></div>
    <div class="red_circle "></div>
    <div class="section_container section_container__animate-text">
      <div class="left_content_container">
        <div class="text_container"> <?php echo $content; ?> </div>
      </div>
    </div>
    <?php
				endwhile;
			endif; ?>
    <div class="scroll_down_mobile_text">Scroll down</div>
  </div>
  <div class="section footer_link white_section" data-anchor="our_why" id="our_why" data-menuPointActive="our_why" data-page-title="Text2Order: Our Why">
    <div class="section_container">
      <?php
				if (have_rows('our_why')) :
					while (have_rows('our_why')) : the_row();
						$hightlight_text 		= get_sub_field('hightlight_text');
						$title 		= get_sub_field('title');
						$sub_title 		= get_sub_field('sub_title');
						$content 		= get_sub_field('content');
						$image 		= get_sub_field('image');
						$image_url 	= $image['url'];
						$video_link_url 		= get_sub_field('video_link');
						// $video_link_url 	= $video_link['url'];
						// $video_link_url 	= "https://player.vimeo.com/video/800913308?background=1&autoplay=0&loop=0&byline=0&title=0&muted=1";
				?>
      <div class="video_fullscreen">
        <div class="close_video">
          <div></div>
          <div></div>
        </div>
        <div class="video_fullscreen_iframe_container">
          <iframe class="video_fullscreen_iframe" src="<?php echo $video_link_url; ?>" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen allow="autoplay"></iframe>
        </div>
      </div>
      <div class="left_section">
        <div class="text_container">
          <div class="red_bubble_header"><?php echo $hightlight_text; ?></div>
        </div>
        <h2 class="header_title"><?php echo $title; ?></h2>
        <p class="t2o_sub_title"><?php echo $sub_title; ?></p>
        <div class="right_section">
          <div class="video_block video_block_click video_block_grub_bg_full">
            <div class="play_video">
              <div class="play_video_button">
                <svg width="11" height="13" viewBox="0 0 11 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M10.857 6.24296L0.421374 0.0385672C0.334043 -0.0134099 0.226912 -0.0128129 0.140113 0.0401347C0.0533141 0.0930822 -5.40157e-05 0.19039 4.10267e-08 0.295606V12.7044C-5.40157e-05 12.8096 0.0533141 12.9069 0.140113 12.9599C0.226912 13.0128 0.334043 13.0134 0.421374 12.9614L10.857 6.75704C10.9454 6.70458 11 6.6064 11 6.5C11 6.3936 10.9454 6.29542 10.857 6.24296Z" fill="white" />
                </svg>
              </div>
              <div class="stop_video_button">
                <svg width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M50 99.5C22.6619 99.5 0.500004 77.3381 0.500005 50C0.500007 22.6619 22.6619 0.499997 50 0.499998C77.3381 0.499999 99.5 22.6619 99.5 50C99.5 77.3381 77.3381 99.5 50 99.5Z" stroke="white" />
                  <line x1="55" y1="44" x2="55" y2="57" stroke="white" stroke-width="2" />
                  <line x1="47" y1="44" x2="47" y2="57" stroke="white" stroke-width="2" />
                </svg>
              </div>
            </div>
            <img class="video_block_poster" src="<?php echo $image_url; ?>" alt=""> </div>
        </div>
        <p class="subtitle_header"><?php echo $content; ?></p>
      </div>
      <?php
					endwhile;
				endif; ?>
    </div>
  </div>
  <div class="section footer_link white_section" data-anchor="problem" id="problem" data-menuPointActive="problem" data-page-title="Text2Order: The Problem">
    <div class="section_container">
      <?php
				if (have_rows('the_problem')) :
					while (have_rows('the_problem')) : the_row();
						$hightlight_text 		= get_sub_field('hightlight_text');
						$title 		= get_sub_field('title');
						$sub_title 	= get_sub_field('sub_title');
						$content 	= get_sub_field('content');
						$file 		= get_sub_field('file');
						$file_url 	= $file['url'];
				?>
      <div class="left_section">
        <div class="wow rollIn">
          <div class="text_container">
            <div class="red_bubble_header"><?php echo $hightlight_text; ?></div>
          </div>
          <h2 class="header_title"><?php echo $title; ?></h2>
          <p class="t2o_sub_title"><?php echo $sub_title; ?></p>
        </div>
        <div class="right_section wow slideInRight">
          <div class="line-animation-json lottie-animation-json"></div>
        </div>
        <p class="subtitle_header"><?php echo $content; ?></p>
      </div>
      <?php
					endwhile;
				endif; ?>
    </div>
  </div>
  <div class="section footer_link section_menu_right white_section imagine_world" id="solution" data-anchor="solution" data-menuPointActive="solution" data-page-title="Text2Order: The Solution">
    <div class="section_container">
      <?php
				if (have_rows('the_solution')) :
					while (have_rows('the_solution')) : the_row();
						$hightlight_text 		= get_sub_field('hightlight_text');
						$title 		= get_sub_field('title');
						$sub_title 	= get_sub_field('sub_title');
						$content 	= get_sub_field('content');
						$video_link_url 		= get_sub_field('video_link');
						// $file_url 	= $file['url'];
				?>
      <div class="left_section">
        <div class="text_container">
          <div class="red_bubble_header"><?php echo $hightlight_text; ?></div>
        </div>
        <h2 class="header_title"><?php echo $title; ?></h2>
        <p class="t2o_sub_title"><?php echo $sub_title; ?></p>
        <!--<div class="right_section">
								<div class="video_block video_block_why_texting video_block_about_us mobile video_block_dynamical_mobile">
									<iframe class="video-animation video_iframe video_iframe_why_texting_mobile" src="<?php echo $video_link_url; ?>" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen allow="autoplay"></iframe>
								</div>
							</div>-->
        <p class="subtitle_header desktop"><?php echo $content; ?></p>
      </div>
      <!-- New Added -->
      <div class="video_block video_block_why_texting video_block_about_us video_block_dynamical_desktop the_solution_video">
        <video class="desktop" width="100%" height="750" autoplay muted loop playsinline>
          <source src="<?php echo $video_link_url; ?>" type="video/mp4">
        </video>
        <div class="desktop imagine-a-world-animation-json lottie-animation-json"></div>
		<div class="mobile mobile-order-animation-json lottie-animation-json"></div>
      </div>
      <p class="subtitle_header mobile txt-mobile"><?php echo $content; ?></p>
      <?php
					endwhile;
				endif; ?>
      <!--<div class="video_block video_block_why_texting video_block_about_us desktop video_block_dynamical_desktop">
        <iframe class="video-animation video_iframe video_iframe_why_texting_desktop" src="<?php echo $video_link_url; ?>" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen allow="autoplay"></iframe>
      </div>-->
    </div>
  </div>
  <div class="section footer_link section_menu_right white_section" id="benefits" data-anchor="benefits" data-menuPointActive="benefits" data-page-title="Text2Order: Increase F&B Sales">
    <div class="section_container">
      <?php
				if (have_rows('increase_f&b_sales')) :
					while (have_rows('increase_f&b_sales')) : the_row();
						$hightlight_text 		= get_sub_field('hightlight_text');
						$non_hightlight_text 		= get_sub_field('non_hightlight_text');
						$title 		= get_sub_field('title');
						$content 	= get_sub_field('content');
						$video_link_url = get_sub_field('video_link');
				?>
      <div class="left_section">
        <div class="text_container">
          <div class="red_bubble_header"><?php echo $hightlight_text; ?></div>
          <div class="grey_bubble_header"><?php echo $non_hightlight_text; ?></div>
        </div>
        <h2 class="header_title"><?php echo $title; ?></h2>
        <!--<div class="right_section">
								<div class="video_block video_block_why_texting video_block_about_us mobile video_block_dynamical_mobile">
									<iframe class="video-animation video_iframe video_iframe_benefits_mobile" src="<?php echo $video_link_url; ?>" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen allow="autoplay"></iframe>
								</div>
							</div>-->
        <p class="subtitle_header t2o_margin_t_125 desktop"><?php echo $content; ?></p>
      </div>
      <div class="right_section wow slideInRight">
        <div class="graph-animation-json lottie-animation-json"></div>
      </div>
      <p class="subtitle_header mobile txt-mobile"><?php echo $content; ?></p>
      <?php
					endwhile;
				endif; ?>
      <!--<div  class="video_block video_block_why_texting video_block_about_us desktop video_block_dynamical_desktop graph_section">
					<iframe name="iframe1" id="iframe1" class="video-animation video_iframe video_iframe_benefits_desktop" src="<?php echo $video_link_url; ?>" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen allow="autoplay"></iframe>
				</div>--> 
    </div>
  </div>
  <div class="section footer_link section_menu_right white_section" id="cutlines" data-anchor="cutlines" data-menuPointActive="benefits" data-page-title="Text2Order: Cut Lines, Cut Costs">
    <div class="section_container">
      <?php
				if (have_rows('cut_lines')) :
					while (have_rows('cut_lines')) : the_row();
						$hightlight_text 		= get_sub_field('hightlight_text');
						$non_hightlight_text 		= get_sub_field('non_hightlight_text');
						$title 		= get_sub_field('title');
						$content 	= get_sub_field('content');
						$file 		= get_sub_field('file');
						$file_url 	= $file['url'];
						// var_dump($file_url);
				?>
      <div class="left_section">
        <div class="text_container">
          <div class="red_bubble_header"><?php echo $hightlight_text; ?></div>
          <div class="grey_bubble_header"><?php echo $non_hightlight_text; ?></div>
        </div>
        <h2 class="header_title"><?php echo $title; ?></h2>
        <div class="right_section"> <img src="<?php echo $file_url; ?>"> </div>
        <p class="subtitle_header t2o_margin_t_125"><?php echo $content; ?></p>
      </div>
      <?php
					endwhile;
				endif; ?>
    </div>
  </div>
  <div class="section footer_link section_menu_right white_section" id="enhance_fan" data-anchor="enhance_fan" data-menuPointActive="benefits" data-page-title="Text2Order: Enhance the Fan Experience">
    <div class="section_container">
      <?php
				if (have_rows('enhance_the_fan')) :
					while (have_rows('enhance_the_fan')) : the_row();
						$hightlight_text 		= get_sub_field('hightlight_text');
						$non_hightlight_text 		= get_sub_field('non_hightlight_text');
						$title 		= get_sub_field('title');
						$content 	= get_sub_field('content');
						$image 		= get_sub_field('image');
						$image_url 	= $image['url'];
						// var_dump($image_url);
				?>
      <div class="left_section">
        <div class="text_container">
          <div class="red_bubble_header"><?php echo $hightlight_text; ?></div>
          <div class="grey_bubble_header"><?php echo $non_hightlight_text; ?></div>
        </div>
        <h2 class="header_title"><?php echo $title; ?></h2>
        <div class="right_section"> <img src="<?php echo $image_url; ?>"> </div>
        <p class="subtitle_header t2o_margin_t_125"><?php echo $content; ?></p>
      </div>
      <?php
					endwhile;
				endif; ?>
    </div>
  </div>
  <div class="section footer_link section_menu_right white_section" id="engage_fan" data-anchor="engage_fan" data-menuPointActive="benefits" data-page-title="Text2Order: Engage Fans with Experiential Marketing">
    <div class="section_container">
      <?php
				if (have_rows('engage_fan')) :
					while (have_rows('engage_fan')) : the_row();
						$hightlight_text 		= get_sub_field('hightlight_text');
						$non_hightlight_text 		= get_sub_field('non_hightlight_text');
						$title 		= get_sub_field('title');
						$content 	= get_sub_field('content');
						$image 		= get_sub_field('image');
						$image_url 	= $image['url'];
				?>
      <div class="left_section">
        <div class="text_container">
          <div class="red_bubble_header"><?php echo $hightlight_text; ?></div>
          <div class="grey_bubble_header"><?php echo $non_hightlight_text; ?></div>
        </div>
        <h2 class="header_title"><?php echo $title; ?></h2>
        <div class="right_section"> <img src="<?php echo $image_url; ?>"> </div>
        <p class="subtitle_header t2o_margin_t_125"><?php echo $content; ?></p>
      </div>
      <?php
					endwhile;
				endif; ?>
    </div>
  </div>
  <div class="section footer_link section_menu_right white_section" id="identify_profile" data-anchor="identify_profile" data-menuPointActive="benefits" data-page-title="Text2Order: Identify & Profile Your Customers">
    <div class="section_container">
      <?php
				if (have_rows('identify_profile')) :
					while (have_rows('identify_profile')) : the_row();
						$hightlight_text 		= get_sub_field('hightlight_text');
						$non_hightlight_text 		= get_sub_field('non_hightlight_text');
						$title 		= get_sub_field('title');
						$content 	= get_sub_field('content');
						$image 		= get_sub_field('image');
						$image_url 	= $image['url'];
				?>
      <div class="left_section">
        <div class="text_container">
          <div class="red_bubble_header"><?php echo $hightlight_text; ?></div>
          <div class="grey_bubble_header"><?php echo $non_hightlight_text; ?></div>
        </div>
        <h2 class="header_title"><?php echo $title; ?></h2>
        <div class="right_section"> <img src="<?php echo $image_url; ?>"> </div>
        <p class="subtitle_header t2o_margin_t_125"><?php echo $content; ?></p>
      </div>
      <?php
					endwhile;
				endif; ?>
    </div>
  </div>
  <div class="section footer_link section_menu_right white_section" id="drive_revenue" data-anchor="drive_revenue" data-menuPointActive="benefits" data-page-title="Text2Order: Drive Revenue with Precise Retargeting">
    <div class="section_container">
      <?php
				if (have_rows('drive_revenue')) :
					while (have_rows('drive_revenue')) : the_row();
						$hightlight_text 		= get_sub_field('hightlight_text');
						$non_hightlight_text 		= get_sub_field('non_hightlight_text');
						$title 		= get_sub_field('title');
						$content 	= get_sub_field('content');
						$image 		= get_sub_field('image');
						$image_url 	= $image['url'];
				?>
      <div class="left_section">
        <div class="text_container">
          <div class="red_bubble_header"><?php echo $hightlight_text; ?></div>
          <div class="grey_bubble_header"><?php echo $non_hightlight_text; ?></div>
        </div>
        <h2 class="header_title"><?php echo $title; ?></h2>
        <div class="right_section"> <img src="<?php echo $image_url; ?>"> </div>
        <p class="subtitle_header t2o_margin_t_125"><?php echo $content; ?></p>
      </div>
      <?php
					endwhile;
				endif; ?>
    </div>
  </div>
  <div class="section footer_link section_menu_right white_section how_it_Works" id="how_it_Works" data-anchor="how_it_Works" data-menuPointActive="how_it_Works" data-page-title="Text2Order: How It Works">
    <div class="section_container">
      <?php
				if (have_rows('how_it_works')) :
					while (have_rows('how_it_works')) : the_row();
						$hightlight_text 		= get_sub_field('hightlight_text');
						$title 		= get_sub_field('title');
						// $sub_title 	= get_sub_field('sub_title');
						$content 	= get_sub_field('content');
						$content_image 		= get_sub_field('content_image');
						$content_image_url 	= $content_image['url'];
						$video_link_url 		= get_sub_field('video_link');
						// $file_url 	= $file['url'];
				?>
      <div class="left_section">
        <div class="text_container">
          <div class="red_bubble_header"><?php echo $hightlight_text; ?></div>
        </div>
        <h2 class="header_title"><?php echo $title; ?></h2>
        <!--<div class="right_section">
          <div class="video_block video_block_why_texting video_block_about_us mobile video_block_dynamical_mobile">
            <iframe class="video-animation video_iframe video_iframe_how_it_works_mobile" src="<?php echo $video_link_url; ?>&autoplay=1&muted=1" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen allow="autoplay"></iframe>
          </div>
        </div>-->
        		<p class="subtitle_header t2o_margin_t_125 desktop"><?php echo $content; ?></p>
        		<img class="desktop" src="<?php echo $content_image_url; ?>" alt="" style="margin-top: 5%;"> </div>
		<div class="right_section wow slideInRight">
        	<div class="simple-like-animation-json lottie-animation-json"></div>
      	</div>
			<p class="subtitle_header t2o_margin_t_125 txt-mobile mobile"><?php echo $content; ?></p>
        	<img class="mobile" src="<?php echo $content_image_url; ?>" alt="" style="margin-top: 5%;">
      <?php
					endwhile;
				endif; ?>
    </div>
    <!--<div class="video_block video_block_why_texting video_block_about_us desktop video_block_dynamical_desktop">
      <iframe class="video-animation video_iframe video_iframe_how_it_works_desktop" src="<?php echo $video_link_url; ?>" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen allow="autoplay"></iframe>
    </div>-->
  </div>
  <div class="section footer_link white_section the_platform hello" id="the_platform" data-anchor="the_platform" data-menuPointActive="the_platform" data-page-title="Text2Order: The Platform">
    <?php
			if (have_rows('the_platform')) :
				while (have_rows('the_platform')) : the_row();
					$hightlight_text 		= get_sub_field('hightlight_text');
					$title 		= get_sub_field('title');
					$sub_title 	= get_sub_field('sub_title');
					$content 	= get_sub_field('content');
					$image_url 		= get_sub_field('image');
					$mob_image_url 		= get_sub_field('mobile_image');
					// $image_url 	= $image['url'];
			?>
    <div class="section_container">
      <div class="left_section">
        <div class="text_container">
          <div class="red_bubble_header"><?php echo $hightlight_text; ?></div>
        </div>
        <h2 class="header_title"><?php echo $title; ?></h2>
        <p class="t2o_sub_title"><?php echo $sub_title; ?></p>
        <div class="right_section mob-only"> <img src="<?php echo $mob_image_url; ?>"> </div>
        <p class="subtitle_header"><?php echo $content; ?></p>
      </div>
    </div>
    <div class="right_section desk-only"> <img src="<?php echo $image_url; ?>"> </div>
    <?php
				endwhile;
			endif; ?>
  </div>
  <div class="section footer_link white_section the_platform" id="team" data-anchor="team" data-menuPointActive="team" data-page-title="Text2Order: The Team">
    <div class="section_container">
      <?php
				if (have_rows('the_team')) :
					while (have_rows('the_team')) : the_row();
						$hightlight_text 		= get_sub_field('hightlight_text');
						$title 		= get_sub_field('title');
						$content 	= get_sub_field('content');
				?>
      <div class="left_section">
        <div class="text_container">
          <div class="red_bubble_header"><?php echo $hightlight_text; ?></div>
        </div>
        <h2 class="header_title"><?php echo $title; ?></h2>
        <div class="right_section">
          <ul class="team-list desk-only">
            <?php
									if (have_rows('team_')) :
										while (have_rows('team_')) : the_row();
											$image 		= get_sub_field('image');
											$image_url 	= $image['url'];
											$details    = get_sub_field('details');
									?>
            <li> <a href="javascript:void(0)"> <img src="<?php echo $image_url; ?>" /> </a> </li>
            <div class="member-info"> <?php echo $details ?> </div>
            <?php
										endwhile;
									endif; ?>
          </ul>
        </div>
        <p class="subtitle_header t2o_margin_t_125 desktop"><?php echo $content; ?></p>
      </div>
      <?php
					endwhile;
				endif; ?>
    </div>
    <div class="team-sliders mob-only">
      <div class="swiper thumb-slider">
        <div class="swiper-wrapper">
          <?php
						if (have_rows('the_team')) :
							while (have_rows('the_team')) : the_row();
								if (have_rows('team_')) :
									while (have_rows('team_')) : the_row();
										$image 		= get_sub_field('image');
										$image_url 	= $image['url'];
										$details    = get_sub_field('details');
						?>
          <div class="swiper-slide">
            <div class="img-box"><img src="<?php echo $image_url; ?>" alt=""></div>
			  <?php echo $details; ?>
          </div>
          <?php
									endwhile;
								endif;
							endwhile;
						endif; ?>
        </div>
      </div>
      <!--<div class="main-slider-wrapper">
        <div class="swiper main-slider">
          <div class="swiper-wrapper">
            <?php
							if (have_rows('the_team')) :
								while (have_rows('the_team')) : the_row();
									if (have_rows('team_')) :
										while (have_rows('team_')) : the_row();
											$details    = get_sub_field('details');
							?>
            <div class="swiper-slide"> <?php echo $details; ?> </div>
            <?php
										endwhile;
									endif;
								endwhile;
							endif; ?>
          </div>
        </div>
      </div>-->
    </div>
    <div class="section_container mob-only">
      <?php if (have_rows('the_team')) :
				while (have_rows('the_team')) : the_row();
					$content 	= get_sub_field('content'); ?>
      <div class="left_section">
        <p class="subtitle_header t2o_margin_t_125 mob_m_0"><?php echo $content; ?></p>
      </div>
      <?php
      			endwhile;
			endif; 
	?>
    </div>
  </div>
  <div class="section footer_link footer_link black_section pricing" data-anchor="pricing" id="pricing" data-menuPointActive="pricing" data-page-title="Text2Order: Want to learn more?">
    <div class="section_container">
      <div class="left_section">
        <h2>Want to Learn More?</h2>
        <P>Click the "Get Started" button below</P>
        <a class="button_start" href="#">Get Started</a> </div>
    </div>
    <div class="right_section"> <img src="<?php echo get_theme_file_uri(); ?>/assets/images/learn-more.png"> </div>
  </div>
</div>
<ul class="menu menu_right" id="menu">
  <li data-menuachor="our_why"><a href="#our_why"> <span></span></a></li>
  <li data-menuachor="problem"><a href="#problem"><span></span></a></li>
  <li data-menuachor="solution"><a href="#solution"><span></span></a></li>
  <li data-menuachor="benefits"><a href="#benefits"><span></span></a></li>
  <li data-menuachor="cutlines"><a href="#cutlines"><span></span></a></li>
  <li data-menuachor="enhance_fan"><a href="#enhance_fan"><span></span></a></li>
  <li data-menuachor="engage_fan"><a href="#engage_fan"><span></span></a></li>
  <li data-menuachor="identify_profile"><a href="#identify_profile"><span></span></a></li>
  <li data-menuachor="drive_revenue"><a href="#drive_revenue"><span></span></a></li>
  <li data-menuachor="how_it_Works"><a href="#how_it_Works"><span></span></a></li>
  <!-- <li data-menuachor="the_platform"><a href="#the_platform"><span></span></a></li> --> 
  <!-- <li data-menuachor="how_it_Works"><a href="#how_it_Works"><span></span></a></li>
<li data-menuachor="how_it_Works"><a href="#how_it_Works"><span></span></a></li> -->
</ul>
<?php endwhile; ?>
<?php get_footer(); ?>
