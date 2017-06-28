<?php /* Template Name: Partners Template */  get_header(); ?>




<!-- section -->
<section >

	<!-- <h1 class="container"><?php the_title(); ?></h1> -->

	<?php if (have_posts()): while (have_posts()) : the_post(); ?>

		<!-- article -->
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <?php include('section-loop.php'); ?>


				<div class="container">
				<ul class="partners_container">

					<?php $partenaires = get_posts( array('post_type' => 'partenaire', 'posts_per_page'=> -1 )); $p = 0; ?>
					<?php foreach ( $partenaires as $post ) :
						setup_postdata( $post );
						$partenaire_link = get_field('lien') ;
						$partenaire_img = thumbnail_of_post_url($post->ID, 'full');
						$classes = ($p % 2 == 0) ? ['col-sm-7 text-align-right', 'col-sm-5'] : ['col-sm-7 col-sm-push-5', 'col-sm-5 col-sm-pull-7']
						?>

					<li class="single_partner">
						<div class="row">
							<div class="<?php echo $classes[0]; ?>">
									<h3>
										<?php if ($partenaire_link !=''): ?><a target="_blank" href="<?php echo $partenaire_link; ?>"><?php endif; ?>
												<?php echo get_the_title(); ?>
										<?php if ($partenaire_link !=''): ?></a><?php endif; ?>
									</h3>
									<p>
										<?php echo get_the_content(); ?>
									</p>

							</div>
							<div class="<?php echo $classes[1]; ?>">
									<div class="partner_image" style="background-image:url(<?php echo $partenaire_img; ?>);"></div>
							</div>
						</div>
					</li>

					<?php $p++; endforeach; wp_reset_postdata();?>

				</ul>
				</div>




			<div class="container">
				<?php the_content(); ?>
				<?php // comments_template( '', true ); // Remove if you don't want comments ?>
				<?php // edit_post_link(); ?>
			</div>



		</article>
		<!-- /article -->

	<?php endwhile; ?>

<?php else: ?>

	<!-- article -->
	<article class="container">

		<h2><?php _e( 'Sorry, nothing to display.', 'webfactor' ); ?></h2>

	</article>
	<!-- /article -->

<?php endif; ?>

</section>
<!-- /section -->




<?php get_footer(); ?>
