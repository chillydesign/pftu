<?php if (have_posts()): while (have_posts()) : the_post(); ?>
		<div class="flex_container">
	<!-- article -->
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>



		<h3>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
		</h3>


		<!-- <p class="meta"><?php the_time('F j, Y'); ?></p> -->

		<?php html5wp_excerpt('html5wp_index'); // Build your custom callback length in functions.php ?>

		<?php edit_post_link(); ?>

	</article>
	<!-- /article -->




			</div>

<?php endwhile; ?>

<?php else: ?>

	<!-- article -->
	<!-- 	<article>
	<h2><?php _e( 'Sorry, nothing to display.', 'webfactor' ); ?></h2>
	</article> -->
	<!-- /article -->

<?php endif; ?>
