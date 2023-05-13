<?php /* Template Name: Thank you */
$GLOBALS['CATAPULTA_TRYYELLOW_THEME']['header_header_class']='-yellow';
$GLOBALS['CATAPULTA_TRYYELLOW_THEME']['header_body_class']='thank-you-page-body';
get_header();
?>
<section class="thank-you-page">
	<div class="container">
		<div class="thank-you-page-content">
			<div class="thank-you-page-title">
				<?= get_field('thank_you_title') ?>
			</div>
			<div class="thank-you-page-text">
				<?= get_field('thank_you_description') ?>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>