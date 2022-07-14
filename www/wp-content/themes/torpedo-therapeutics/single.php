<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Torpedo_Therapeutics
 */
get_header();
?>
<div class="container">
	<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			the_post_navigation();

			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile;
	?>
</div>
<?php
get_sidebar();
get_footer();