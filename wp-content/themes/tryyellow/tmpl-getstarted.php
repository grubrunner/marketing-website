<?php /* Template Name: Get started */
$GLOBALS['CATAPULTA_TRYYELLOW_THEME']['header_header_class']='-yellow';
get_header();?>
<?php if ( function_exists('custom_class_check') ) {
	$check_expire = custom_class_check();
	// var_dump($check_expire);
	$url = get_the_permalink(242);
	$current_id = get_the_ID();
	if (!custom_class_check() && $current_id != 242 ) { ?>
		<script>
			window.location.href = "<?php echo $url; ?>";
		</script>
		<?php
	} elseif (custom_class_check() && $current_id == 242) {
		$url = get_the_permalink(11);
		 ?>
		<script>
			window.location.href = "<?php echo $url; ?>";
		</script>
		<?php
	}

} ?>
<?php
$arInfo=Array(
	'items' => Array(),
	'money_back_limit' => get_field('get_started_money_back_limit'),
	'money_back_text' => get_field('get_started_money_back_text'),
	'have_questions_link' => get_field('get_started_have_questions_link'),
	'footer_image_1' => get_field('get_started_footer_image_1'),
	'footer_image_2' => get_field('get_started_footer_image_2'),
);
for($i=1;$i<=3; $i++) {
	$arItem=get_field('get_started_tariff_'.$i.'_group');
	$arInfo['items'][$i]=Array();//get_started_tariff_3_button
	foreach(Array('name','price','sale_price','time','bullets','button_color','button') as $n) {
		if (is_string($arItem['get_started_tariff_'.$i.'_'.$n])) {;
			$arInfo['items'][$i][$n]=trim($arItem['get_started_tariff_'.$i.'_'.$n]);
		} else {
			$arInfo['items'][$i][$n]=$arItem['get_started_tariff_'.$i.'_'.$n];
		}
	}
	$arBullets=explode("\n",$arInfo['items'][$i]['bullets']);
	if ($arInfo['items'][$i]['button_color']=='black') {
		$arInfo['items'][$i]['button_color']='-black';
	} else {
		$arInfo['items'][$i]['button_color']='-white';
	}
	$arInfo['items'][$i]['bullets']=Array(
		'bullets' => Array(),
		'other' => Array(),
	);
	foreach ($arBullets as $bullet) {
		$bullet=trim($bullet);
		if (!empty($bullet)) {
			if (mb_substr($bullet,0,mb_strlen('•'))=='•') {
				$bullet=trim(mb_substr($bullet,mb_strlen('•')));
				$arInfo['items'][$i]['bullets']['bullets'][]=$bullet;
			} else {
				$arInfo['items'][$i]['bullets']['other'][]=$bullet;
			}
		}
	}
}
?>

<section class="getstarted">
	<div class="container">
		<?php //var_dump($arInfo) ?>
		<div class="gs-tariffs">
			<?php foreach ($arInfo['items'] as $arItem) { ?>
			<div class="gs-tariff">
				<div class="gs-tariff-bg">
					<div class="gs-tariff-header">
						<div class="gs-tariff-title"><?= $arItem['name'] ?></div>
						<div class="gs-tariff-price"><span><?= $arItem['price'] ?><?php
						if (!empty($arItem['sale_price'])) {
							?><span><?= $arItem['sale_price'] ?></span><?php
						}
						?></span></div>
						<div class="gs-tariff-time"><?= $arItem['time'] ?></div>
						<?php if (!empty($arItem['bullets']['bullets'])) { ?>
						<div class="gs-tariff-list">
							<ul>
								<?php foreach ($arItem['bullets']['bullets'] as $bullet) { ?>
								<li><img src="<?= $GLOBALS['CATAPULTA_TRYYELLOW_THEME']['template_url'] ?>/img/icons/ico-gs-list.svg" alt="Checked Checkbox - tryyellow.com"><?= $bullet ?></li>
								<?php } ?>
							</ul>
						</div>
						<?php } ?>
						<?php foreach ($arItem['bullets']['other'] as $bullet) {
							if ($bullet[0]=='_') {
								?><div class="gs-tariff-line"></div><?php
							} else {
								?><div class="gs-tariff-other"><?= $bullet ?></div><?php
							}
						} ?>
					</div>
					<div class="gs-tariff-footer">
						<div class="gs-tariff-select">
							<a class="gs-tariff-select-link button default-button -arrow <?=$arItem['button_color']?>" href="<?= $arItem['button']['url'] ?>"><?= html_entity_decode($arItem['button']['title']) ?></a>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
		<div class="money-back-badge">
			<div class="money-back-badge-icon"><?= $arInfo['money_back_limit'] ?></div>
			<div class="money-back-badge-text"><?= $arInfo['money_back_text'] ?></div>
		</div>
		<a class="gs-questions" href="<?= $arInfo['have_questions_link']['url'] ?>"><?= html_entity_decode($arInfo['have_questions_link']['title']) ?></a>
		<div class="gs-footer-images">
			<div class="gs-footer-image">
				<img src="<?= $arInfo['footer_image_1']['url'] ?>" alt="<?= $arInfo['footer_image_1']['title'] ?>">
			</div>
			<div class="gs-footer-image">
				<img src="<?= $arInfo['footer_image_2']['url'] ?>" alt="<?= $arInfo['footer_image_1']['title'] ?>">
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>