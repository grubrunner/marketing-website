<?php
/**
 * The template for displaying the footer
 *
 * Contains the opening of the #site-footer div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?>
<footer id="site-footer" class="header-footer-group" >
	<div class="footer-top">
		<div class="footer-logo">
			<a href="/"><img src="<?php echo get_theme_file_uri(); ?>/assets/images/white-logo.svg" alt=""></a>
		</div>
		<div class="footer-nav">
			<div class="footer-nav__col">
				<a href="#" class="footer-nav__link">Privacy Policy</a>
				<a href="#" class="footer-nav__link">Terms and Conditions</a>
				<!-- <a href="/about.php" class="footer-nav__link">About Us</a> -->
			</div>
			<div class="footer-nav__col">
				<!-- <a href="/faq.php" class="footer-nav__link">FAQ</a> -->
				<!-- <a href="#" class="footer-nav__link">Support</a> -->
			</div>
			<div class="footer-nav__col">
				<!-- <a href="/privacy" class="footer-nav__link">Privacy Policy</a>
<a href="/terms" class="footer-nav__link">Terms and Conditions</a> -->
			</div>
		</div>
	</div>
	<div class="content_footer">
		<!-- <div class="links_and_scroll">
<div class="scroll">
<div class="scroll_down">Scroll down</div>
<div class="scroll_up">Back to Start</div>
</div>
</div> -->
		<div class="copyrights">© Text 2 order <?=date('Y')?></div>
		<div class="linkedIn-container">
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
<!-- <script src="<?php echo get_theme_file_uri(); ?>/assets/js/jquery-3.6.0.min.js"></script> -->
<script src="<?php echo get_theme_file_uri(); ?>/assets/js/swiper-bundle.min.js"></script>
<script>
	var mySwiperTeam = new Swiper('.thumb-slider', {
			loop: true,
			speed: 400,
			slidesPerGroup: 2,
			slidesPerView: 2,
			pagination: {
				el: '.swiper-pagination',
				type: 'bullets',
				clickable: true
			},
			spaceBetween: 15,
			on: {
				init: function (sw) {
					$('.swiper-counter').html('1/'+sw.slides.length)
				},
			},
		});
		mySwiperTeam.on('slideChange', function (sw) {
			$('.swiper-counter').html((sw.activeIndex+1)+'/'+sw.slides.length)
		});
	/*var thumb = new Swiper(".thumb-slider", {
			loop: false,
			speed: 400,
			slidesPerGroup: 2,
			slidesPerView: 2,
			pagination: {
				el: '.swiper-pagination',
				type: 'bullets',
				clickable: true
			},
			spaceBetween: 5,
			on: {
				init: function (sw) {
					$('.swiper-counter').html('1/'+sw.slides.length)
				},
			},
		loop: true,
		spaceBetween: 16,
		slidesPerView: 1,
		watchSlidesVisibility: true,
		slideToClickedSlide: true,
		slideToClickedSlide: true,
		centeredSlides: true,
		autoplay:true,
	});*/
	/*var bannerSlider = new Swiper(".main-slider", {
		slidesPerView: 1,
		loop: false,
		spaceBetween: 0,
		speed: 800,
		slideThumbActiveClass: 'swiper-slide-thumb-active',
		thumbs: {
			swiper: thumb,
		},
		autoplay:false,
	});*/
</script>
<script>
	var activeBlock = window.location.hash;
	if (activeBlock != '#main' && activeBlock != '') {
		// document.querySelector('.red_circle_out').classList.add('active');
		document.querySelector('.red_circle').classList.add('hide');
		document.querySelector('body').classList.remove('load');
	}
</script>
</body>
</html>