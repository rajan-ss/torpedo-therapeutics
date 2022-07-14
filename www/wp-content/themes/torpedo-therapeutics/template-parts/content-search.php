<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Torpedo_Therapeutics
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php torpedo_therapeutics_posted_on(); torpedo_therapeutics_posted_by(); ?>
		</div>
		<?php endif; ?>
	</header>
	<?php torpedo_therapeutics_post_thumbnail(); ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>
	<footer class="entry-footer">
		<?php torpedo_therapeutics_entry_footer(); ?>
	</footer>
</article>