<?php get_header(); ?>


	<!-- section -->

	<?php if (have_posts()): while (have_posts()) : the_post(); ?>

		<!-- article -->
		<article class="article" id="post-<?php the_ID(); ?>" <?php post_class(); ?>style="padding:0;">

			<section class="section  section_border">
					<div class="border redborder"></div>
			</section>



			<!-- post thumbnail -->
			<?php if ( has_post_thumbnail()) { // Check if Thumbnail exists ?>

				<section class="section  section_two_thirds_one_third">
				<div style="margin: 0 15px;">
					<div class="row">
						<div class="col-sm-8 white bigcol thirdscol">
						 <h1><?php the_title(); ?></h1>
						 <p class="meta"><?php the_time('F j, Y'); ?> </span>
							 <?php the_content(); // Dynamic Content ?>
							 <?php edit_post_link(); // Always handy to have Edit Post Links available ?>

						</div>


						<div class="col-sm-4 primary smallcol thirdscol">
							<?php $thumbnail_img = thumbnail_of_post_url( get_the_ID(), 'large'); ?>
                            <img src="<?php echo $thumbnail_img; ?>" alt="">
						</div>

					</div> <!-- END OF ROW -->

				</div>

					</section>



			<?php } else{ ?>
				<section class="section  section_two_thirds_one_third">
				<div style="margin: 0 15px;">
					<div class="row">
						<div class="col-sm-8 white bigcol thirdscol">
						 <h1><?php the_title(); ?></h1>
						 <p class="meta"><?php the_time('F j, Y'); ?> </span>
							 <?php the_content(); // Dynamic Content ?>
							 <?php edit_post_link(); // Always handy to have Edit Post Links available ?>

						</div>


						<div class="col-sm-4 white smallcol thirdscol">

						</div>

					</div> <!-- END OF ROW -->

				</div>

					</section>

			<?php } ?>

		</article>




	<?php endwhile; ?>

	<?php else: ?>

		<!-- article -->
		<article>

			<h1><?php _e( 'Sorry, nothing to display.', 'webfactor' ); ?></h1>

		</article>
		<!-- /article -->


	<?php endif; ?>


	<section class="section  section_border">
			<div class="border blackborder"></div>
	</section>


<?php get_footer(); ?>
