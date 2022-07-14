<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the .flex-shrink-0 div and all after .content div.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Torpedo_Therapeutics
 */

$bg_img = acf_option('ss_f_bg_img');
$title = acf_option('ss_f_title');
$cta = acf_option('ss_f_cta');
$copyright_content = acf_option('ss_f_copyright_content');
$popup_form_heading = acf_option('ss_pop-up_form_heading');
$popup_form_id = acf_option('ss_pop-up_form_id');
?>
</main>

<!-- Popup Form Modal -->
<div class="modal fade request-form" id="ssPopupForm" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ssPopupFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <?php if($popup_form_heading) { ?>
                <h3 class="modal-title" id="quoteModalLabel"><?php echo $popup_form_heading; ?></h3>
                <?php } ?>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo do_shortcode('[gravityform id='. $popup_form_id . ' title=false description=false ajax=true]') ?>
            </div>
            <!--/.modal-body -->
        </div>
    </div>
</div>
<!--/.modal -->

<footer class="site-footer mt-auto bg-cover">
	<?php if ($bg_img) {
		$img = wp_get_attachment_image_url($bg_img, 'full');
		$img_alt = get_post_meta($bg_img, '_wp_attachment_image_alt', TRUE);
	?>
		<img src="<?php echo $img; ?>" alt="<?php echo $img_alt; ?>" width="1440" height="900" loading="lazy">
	<?php } else { ?>
		<img src="<?php echo site_url(); ?>/media/footer-bg.jpg" alt="Footer background image" width="" height="" loading="lazy">
	<?php } ?>
	<div class="container">
		<div class="d-flex flex-column align-items-center justify-content-between text-center mh-xl mh-xxl text-white inner">
			<?php if ($title || $cta) { ?>
				<div class="content-wrap">
					<?php if ($title) { ?>
						<h2 class="text-capitalize h1 mb-1 mb-lg-2 mb-xl-3"><?php echo $title; ?></h2>
					<?php }
					if ($cta) { ?>
						<a href="javascript:void(0);" data-toggle="modal" data-target="#ssPopupForm" class="btn btn-primary"><?php echo $cta['title']; ?></a>
					<?php } ?>
				</div><!-- /.content-wrap -->
			<?php } ?>
			<div class="legal text-white text-center pt-2 pt-md-4 pt-lg-6 pb-1 mt-auto">
				<p>&copy; <?php echo date('Y'); ?> <?php echo $copyright_content; ?></p>
			</div><!-- /.legal -->
		</div>
	</div>
</footer><!-- /.site-footer -->
</div>
<?php wp_footer(); ?>
</body>

</html>