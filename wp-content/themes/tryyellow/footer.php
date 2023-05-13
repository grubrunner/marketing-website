</main>
<?php if (!$GLOBALS['CATAPULTA_TRYYELLOW_THEME']['footer_hide']) { ?>
<footer class="footer default-margin-top">
	<div class="container">
		<div class="main-logo">
			<img src="<?= $GLOBALS['CATAPULTA_TRYYELLOW_THEME']['template_url'] ?>/img/logo-yellow.svg" alt="yellow.com">
		</div>
		<p class="text text-3 --gray-font">
			©&nbsp;Yellow&nbsp;<?=date('Y')?>
		</p>
	</div>
</footer>
<?php /*
<div class="modal-wrapper -hide">
	<div class="modal-block">
		<div class="modal">
			<div class="modal-form">
				<div class="swipe-button --mob"></div>

				<div class="thanks__block">
					<div class="thanks__form">
						<p class="title title-4 -mob-title-3">Contact Us</p>

						<div class="form">
							<form class="feedback_form">
								<input class="langsite" type="hidden" name="langsite" value="EN">
								<input class="name" type="text" name="name" placeholder="Your Name" required>
								<div class="phoneinp">
									<input id="phone" class="phone" type="text" name="phone" placeholder="Your Phone" required>
								</div>
								<input class="email" type="email" name="email" placeholder="Your Email" required>
								<textarea name="requirements" cols="30" rows="4" placeholder="Describe Your Requirements"></textarea>
								<?//<input class="site" type="text" name="site" placeholder="Current Website URL" required>
								<input class="budget --only-number" name="budget" type="text" placeholder="Budget">?>
								<input class="button default-button -yellow -size-s" type="submit" value="Submit">
							</form>
						</div>
					</div>
					<div class="thanks">
						<p class="title title-4 -mob-title-3">
							*Thanks! <br>
							We’ll&nbsp;be&nbsp;in&nbsp;touch with you soon.
						</p>

						<p class="link default-link text-1 -mob-text-1 --underline close-modal">
							Back to the Main page
						</p>
					</div>
				</div>
			</div>
			<div class="modal-close-button close-modal --pc"></div>
		</div>
	</div>
</div>*/ ?>
<?php } ?>
<script>
	window.template_directory_uri="<?= $GLOBALS['CATAPULTA_TRYYELLOW_THEME']['template_url'] ?>";
</script>
<?php wp_footer(); ?>
</body>
</html>