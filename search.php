<?php get_header(); ?>


		<!-- section -->
		<section class="min_height_browser container">
            <br />
            <br />
			<h1>Recherche </h1>
            <p>
                <?php echo sprintf( __( '%s Search Results for ', 'webfactor' ), $wp_query->found_posts ); echo '"' . get_search_query() . '"'; ?>
            </p>

			<?php get_template_part('loop'); ?>

			<?php get_template_part('pagination'); ?>

		</section>
		<!-- /section -->




<?php get_footer(); ?>
