<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Torpedo_Therapeutics
 */

get_header();

$icon_text = acf_repeater('ss_hp_icon_card_section');
$s2_title = acf_field('ss_hp_s2_title');
$s2_subtitle = acf_field('ss_hp_s2_subtitle');
$s2_desc = acf_field('ss_hp_s2_description');
$s2_image = acf_field('ss_hp_s2_image');
$s3_title = acf_field('ss_hp_s3_title');
$s3_subtitle = acf_field('ss_hp_s3_subtitle');
$s3_desc = acf_field('ss_hp_s3_description');
$s3_image = acf_field('ss_hp_s3_image');

if ($icon_text) {
?>
	<section id="features" class="section-tertiary pt-1 pb-2 py-md-2 pb-xl-0 container">
		<h2 class="hidden">Features</h2>
		<div class="row">
			<?php foreach ($icon_text as $card) {
				$icon = acf_subfield($card, 'icon');
				$text = acf_subfield($card, 'text');
				if ($icon || $text) {
			?>
					<div class="col-lg-4 col-md-6 section-tertiary__col">
						<div class="text-icon">
							<?php if ($icon) {
								$img = wp_get_attachment_image_url($icon, 'full');
								$img_alt = get_post_meta($icon, '_wp_attachment_image_alt', TRUE);
							?>
								<div class="img-circle mb-1 mb-lg-2">
									<img src="<?php echo $img; ?>" width="31" height="32" alt="<?php echo $img_alt; ?>" loading="lazy">
								</div><!-- /.img-circle -->
							<?php }
							if ($text) { ?>
								<h2 class="h3"><?php echo $text; ?></h2>
							<?php } ?>
						</div><!-- /.text-icon -->
					</div><!-- /.col -->
			<?php }
			} ?>
		</div><!-- /.row -->
	</section> <!-- /.section-tertiary -->
<?php }

if ($s2_title || $s2_desc || $s2_image) {
?>
	<?php if ($s2_image) {
		$s2_img = wp_get_attachment_image_url($s2_image, 'full');
		$s2_img_alt = get_post_meta($s2_image, '_wp_attachment_image_alt', TRUE);
	?>
		<section id="about" class="section-greeting pt-3 pt-md-5 pb-md-3 pb-2 bg-cyan bg-cover overlay-light">
			<img src="<?php echo $s2_img; ?>" width="1064" height="508" alt="<?php echo $s2_img_alt; ?>" loading="lazy">
			<div class="container">
				<div class="row text-center text-lg-left">
					<div class="col-lg-6">
						<?php if ($s2_title || $s2_subtitle) { ?>
							<div class="title-block mb-1 mb-lg-2 mb-xl-3">
								<?php if ($s2_subtitle) { ?>
									<span class="title-fancy title-border text-uppercase"><?php echo $s2_subtitle; ?></span>
								<?php }
								if ($s2_title) { ?>
									<h2><?php echo $s2_title; ?></h2>
								<?php } ?>
							</div>
						<?php } ?>
						<?php if ($s2_desc) { ?>
							<?php echo apply_filters('the_content', $s2_desc); ?>
						<?php } ?>
					</div><!-- /.col -->
					<?php /* if ($s2_desc) { ?>
						<div class="col-lg-6">
							<?php echo apply_filters('the_content', $s2_desc); ?>
						</div><!-- /.col -->
					<?php } */?>
				</div><!-- /.row -->
			</div><!-- /.container -->
			<?php /*
			<div class="img-wrap">
				<img src="<?php echo $s2_img; ?>" width="1064" height="508" alt="<?php echo $s2_img_alt; ?>" loading="lazy">
			</div> */ ?>
			<!-- /.img-wrap -->
		<?php } ?>
		</section> <!-- /.section-greeting -->
	<?php }

if ($s3_title || $s3_desc || $s3_image) {
	?>
		<section id="atag" class="section section-atag container pb-xxl-4 pb-lg-2 pb-1 pt-xxl-7 pt-xl-5 pt-lg-2 pt-1">
			<div class="row align-items-center">
				<div class="col-lg-6 text-center text-center text-lg-left pr-xxl-6 pr-xl-4 pr-lg-2 py-2">
					<?php if ($s3_title || $s3_subtitle) { ?>
						<div class="title-block mb-1 mb-lg-2 mb-xl-3">
							<?php if ($s3_subtitle) { ?>
								<span class="title-fancy title-border text-uppercase"><?php echo $s3_subtitle; ?></span>
							<?php }
							if ($s3_title) { ?>
								<h2><?php echo $s3_title; ?></h2>
							<?php } ?>
						</div>
					<?php }
					if ($s3_desc) {
						echo apply_filters('the_content', $s3_desc);
					} ?>
				</div>
				<?php if ($s3_image) {
					echo wp_get_attachment_image($s3_image, array(480, 679), false, ['class' => 'col-lg-6 img-block pl-xxl-6 pl-xl-4 pl-lg-2 mb-2 text-lg-right']);
				} else { ?>
					<picture class="col-lg-6 img-block pl-xxl-6 pl-xl-4 pl-lg-2 mb-2 text-lg-right">
						<img src="<?php echo site_url(); ?>/media/atag-system-cover-image.png" alt="ATAG System Cover image" width="480" height="679" loading="lazy">
					</picture> <!-- /.img-block -->
				<?php } ?>
			</div><!-- /.row -->
		</section> <!-- /.section-atag -->
	<?php }
get_footer();
