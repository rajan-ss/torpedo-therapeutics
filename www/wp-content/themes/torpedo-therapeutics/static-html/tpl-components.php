<?php
/* Template Name: Components */

get_header();
?>
<section class="components">
	<div class="container">
		<h1>This Heading One <code>63px</code></h1>
		<h2>This Heading Two <code>55px</code></h2>
		<h3>This Heading Three <code>27px</code></h3>
		<h4>This Heading Four <code>18px</code></h4>
		<h5>This Heading Five <code>17px</code></h5>
		<h6>This Heading Six <code>14px</code></h6>

		<div style="width: 557px">
			<p>Inner Cosmos is a neurotechnology company creating the first FDA-approved "Digital Pill," a brain-computer interface (BCI) with a focus to alleviate cognitive disorders, starting with depression.</p>
			<p>Interface (BCI) with a focus to alleviate cognitive disorders, starting with depression.</p>
			<hr>

			<h3>/.btn.btn-primary</h3>
			<a href="#" class="btn btn-primary">Speak to experts</a>
		</div>
	</div>

	<section class="section-tertiary container">
		<div class="row">
			<div class="col-lg-4 col-md-6 section-tertiary__col">
				<div class="text-icon">
					<div class="img-circle mb-1 mb-lg-2">
						<img src="<?php echo get_template_directory_uri(); ?>/images/icon-protein.svg" alt="Icon Protein">
					</div><!-- /.img-circle -->
					<h3>Targeted Protein</br> Degradation</h3>
				</div><!-- /.text-icon -->
			</div><!-- /.col -->
			<div class="col-lg-4 col-md-6 section-tertiary__col">
				<div class="text-icon">
					<div class="img-circle mb-1 mb-lg-2">
						<img src="<?php echo get_template_directory_uri(); ?>/images/icon-platform.svg" alt="Icon Platform">
					</div><!-- /.img-circle -->
					<h3>C4T TORPEDO®<br> Platform</h3>
				</div><!-- /.text-icon -->
			</div><!-- /.col -->
			<div class="col-lg-4 col-md-6 section-tertiary__col">
				<div class="text-icon">
					<div class="img-circle mb-1 mb-lg-2">
						<img src="<?php echo get_template_directory_uri(); ?>/images/icon-source.svg" alt="Icon Source">
					</div><!-- /.img-circle -->
					<h3>Atag Open Source<br> Program</h3>
				</div><!-- /.text-icon -->
			</div><!-- /.col -->
		</div><!-- /.row -->
	</section> <!-- /.section-tertiary -->

	<section class="section-greeting pt-5 bg-cyan">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="title-block mb-1 mb-lg-2 mb-xl-3">
						<span class="title-fancy title-border text-uppercase">Welcome</span>
						<h2>What Is An Antibody <span>Drug Conjugate?</span></h2>
					</div>
				</div>
				<div class="col-md-6">
					<p>Inner Cosmos is a neurotechnology company creating the first FDA-approved "Digital Pill," a brain-computer interface (BCI) with a focus to alleviate cognitive disorders, starting with depression.</p>
					<p>Interface (BCI) with a focus to alleviate cognitive disorders, starting with depression.</p>
				</div>
			</div>
		</div>
		<div class="img-wrap">
			<img src="<?php echo site_url(); ?>/media/antibody-img.png);" alt="Antibody Img">
		</div>
	</section> <!-- /.section-greeting -->

	<section class="section section-atag container pb-xxl-4 pb-lg-2 pb-1 pt-xxl-7 pt-xl-5 pt-lg-2 pt-1">
		<div class="row align-items-center">
			<div class="col-lg-6 content-block pr-xxl-6 pr-xl-4 pr-lg-2 py-2">
				<div class="title-block mb-1 mb-lg-2 mb-xl-3">
					<span class="title-fancy title-border text-uppercase">ATAG</span>
					<h2>We Developed The <span>Atag System</span></h2>
				</div>
				<p>Inner Cosmos is a neurotechnology company creating the first FDA-approved "Digital Pill," a brain-computer interface (BCI) with a focus to alleviate cognitive disorders, starting with depression.</p>
				<p>Interface (BCI) with a focus to alleviate cognitive disorders, starting with depression.</p>
			</div> <!-- /.content-block -->
			<picture class="col-lg-6 img-block pl-xxl-6 pl-xl-4 pl-lg-2 mb-2 text-lg-right">
				<source srcset="<?php echo site_url(); ?>/media/atag-system-cover-image.webp" type="image/webp">
				<source srcset="<?php echo site_url(); ?>/media/atag-system-cover-image.png" type="image/png">
				<img src="<?php echo site_url(); ?>/media/atag-system-cover-image.png" alt="ATAG System Cover image" width="" height="" loading="lazy">
			</picture> <!-- /.img-block -->
		</div>
	</section> <!-- /.section-atag -->
</section>
<?php
get_footer();
