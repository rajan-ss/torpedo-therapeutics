<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Torpedo_Therapeutics
 */
get_header();
?>
<section class="error-404 not-found text-center">
	<div class="error-404-wrap">
		<header class="page-header">
			<h2 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'torpedo-therapeutics' ); ?></h2>
		</header>
		<div class="page-content">
			<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'torpedo-therapeutics' ); ?></p>

			<?php
			get_search_form();

			//the_widget( 'WP_Widget_Recent_Posts' );
			?>

			<?php /* <div class="widget widget_categories">
				<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'torpedo-therapeutics' ); ?></h2>
				<ul>
					<?php
					wp_list_categories( array(
						'orderby'    => 'count',
						'order'      => 'DESC',
						'show_count' => 1,
						'title_li'   => '',
						'number'     => 10,
					) );
					?>
				</ul>
			</div> */ ?>
			<div class="btn-wrap mb-4">
				<a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">Back to Homepage</a>
			</div>

			<?php
			/* $torpedo_therapeutics_archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'torpedo-therapeutics' ), convert_smilies( ':)' ) ) . '</p>';
			the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$torpedo_therapeutics_archive_content" );

			the_widget( 'WP_Widget_Tag_Cloud' ); */ ?>
		</div>
	</div>
</section>
<?php
get_footer();