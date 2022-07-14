<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Torpedo_Therapeutics
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
	<?php wp_head(); ?>
</head>

<body <?php body_class(''); ?>>
	<div class="site-wrapper">
		<header class="site-header">
			<nav class="navbar navbar-expand-xl navbar-light">
				<div class="container">
					<?php the_brand(); ?>

					<!--<div class="navbar-overlay"></div>-->
					<?php
					wp_nav_menu(array(
						'theme_location'  => 'nav-pri',
						'depth'	          => 3, // 1 = no dropdowns, 2 = with dropdowns.
						'container'       => 'div',
						'container_class' => 'collapse navbar-collapse offset',
						'container_id'    => 'nav-pri',
						'menu_class'      => 'nav navbar-nav justify-content-center ml-auto',
						'walker'         => new WP_Bootstrap_Navwalker(),
						'fallback_cb'    => 'WP_Bootstrap_Navwalker::fallback',
					));
					?>
					<div class="site-header__actions">
						<button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#nav-pri" aria-controls="nav-pri" aria-expanded="false" aria-label="Toggle Navigation">
							<span></span>
							<span></span>
							<span></span>
						</button>
						<?php
						$header_cta = acf_option('ss_h_header_cta');
						if($header_cta) {
						?>
						<a href="javascript:void(0);" data-toggle="modal" data-target="#ssPopupForm" class="btn btn-tertiary"><?php echo $header_cta['title']; ?></a>
						<?php } ?>
					</div>
				</div>
			</nav>
		</header>
		<?php
		$bg_img = acf_field('ss_hp_banner_image');
		$banner_title = acf_field('ss_hp_title');
		$banner_subtitle = acf_field('ss_hp_subtitle');
		$banner_cta = acf_field('ss_hp_banner_cta');
		?>
		<main class="site-content">
			<section class="banner bg-cover overlay-dark">
				<?php if ($bg_img) {
					$img = wp_get_attachment_image_url($bg_img, 'full');
					$img_alt = get_post_meta($bg_img, '_wp_attachment_image_alt', TRUE);
				?>
					<img src="<?php echo $img; ?>" alt="<?php echo $img_alt; ?>">
				<?php } else { ?>
					<img src="<?php echo site_url(); ?>/media/banner-bg.jpg" alt="Banner">
				<?php } ?>
				<div class="container">
					<div class="d-table">
							<div class="banner-content d-table-cell align-middle">
								<?php if ($banner_subtitle) { ?>
									<small><?php echo $banner_subtitle; ?></small>
								<?php }
								if ($banner_title) { ?>
									<h1><?php echo $banner_title; ?></h1>
								<?php }
								if ($banner_cta) { ?>
									<a href="javascript:void(0);" data-toggle="modal" data-target="#ssPopupForm" class="btn btn-primary"><?php echo $banner_cta['title']; ?></a>
								<?php } ?>
							</div><!-- /.banner-content -->
					</div><!-- /.d-table -->
				</div><!-- /.container -->
			</section><!-- /.banner -->