<?php get_header(); ?>


	<!-- section -->
	<section class="container min_height_browser flex_container">

	<?php if (have_posts()): while (have_posts()) : the_post(); ?>




		<!-- article -->
		<article class="article" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


			<!-- post thumbnail -->
			<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
				<?php $thumbnail_img = thumbnail_of_post_url( get_the_ID(), 'full'); ?>
				<div class="news_image_large" style="background-image:url(<?php echo $thumbnail_img; ?>);"></div>
			<?php endif; ?>
			<!-- /post thumbnail -->

			<h1><?php the_title(); ?></h1>

			<!-- post details -->
			<p class="meta"><?php the_time('F j, Y'); ?> </span>

			<?php the_content(); // Dynamic Content ?>


			<?php edit_post_link(); // Always handy to have Edit Post Links available ?>

		</article>
		<!-- /article -->




	<?php endwhile; ?>

	<?php else: ?>

		<!-- article -->
		<article>

			<h1><?php _e( 'Sorry, nothing to display.', 'webfactor' ); ?></h1>

		</article>
		<!-- /article -->

	<?php endif; ?>

	</section>
	<!-- /section -->




<?php get_footer(); ?>
