<?php get_header(); ?>


		<!-- section -->
		<section class="container min_height_browser">

			<h2><?php _e( 'Archives', 'webfactor' ); ?></h2>

			<?php get_template_part('loop'); ?>

			<?php get_template_part('pagination'); ?>

		</section>
		<!-- /section -->




<?php get_footer(); ?>
