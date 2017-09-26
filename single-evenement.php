<?php get_header(); ?>
<section class="section  section_border">
    <div class="border redborder"></div>
</section>


<!-- section -->
<section class="section  section_two_thirds_one_third">



    <?php if (have_posts()): while (have_posts()) : the_post(); ?>

        <div style="margin: 0 15px;">
            <div class="row">


                <div class=" col-sm-8 bigcol thirdscol">

                    <?php $evenement_img = thumbnail_of_post_url($post->ID, 'medium'); ?>
                    <?php $place = get_field('place'); ?>
                    <?php $link = get_field('link'); ?>
                    <?php $description = get_field('description'); ?>
                    <?php $file = get_field('file'); ?>
                    <?php $start_date = get_field('start_date'); ?>
                    <?php $end_date = get_field('end_date'); ?>
                    <?php $location = get_field('location'); ?>


                    <?php $custom_text = get_field('custom_text'); ?>

                    <?php $number_of_possible_applicants = get_field('number_of_possible_applicants'); ?>



                    <h1>
                        <?php the_title(); ?>
                    </h1>

							<div class="details">
								<?php if($start_date){ ?>
									<p><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo $start_date; ?>
									<?php if($end_date){?> - <?php echo $end_date; } ?></p>
								<?php } ?>
									<?php if($location & $location != '' ){ ?>
									<p><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $location; ?> </p>
								<?php } ?>

							</div>

                    <?php if ($description && $description != "") :  ?>
                        <p><?php echo  $description ; ?></p>
                    <?php endif; ?>
		





                    <?php if( 1 <  $number_of_possible_applicants  ) : ?>
                        <?php  get_template_part('inscription-form');    // INSCRIPTION FORM ?>
                    <?php endif; ?>


                    <?php edit_post_link(); // Always handy to have Edit Post Links available ?>
                </div>


                <div class="col-sm-4 primary smallcol thirdscol">
                    <?php if (get_field('practical')){ echo '<h3>Informations pratiques</h3>' . get_field('practical');} ?>

                    <!-- post thumbnail -->
                    <?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
                        <?php $thumbnail_img = thumbnail_of_post_url( get_the_ID(), 'medium'); ?>
                        <img class="partage_image" src="<?php echo $thumbnail_img; ?>"  alt="" />
                    <?php endif; ?>
                    <!-- /post thumbnail -->
    <?php if ($link && $link != ''){ ?> <a  class="icon_link evenement_icon" target="_blank" href="<?php echo add_scheme_to_url($link); ?>"><?php echo $link; ?></a><?php } ?>
    <?php if ($file && $file['url'] != '') { ?><a class="icon_download partage_icon"  target="_blank"  href="<?php echo $file['url']; ?>"> Telecharger la brochure </a><?php } ?>


                </div>

            </div> <!-- END OF ROW -->

        </div>




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



<section class="section  section_border">
    <div class="border redborder"></div>
</section>
<?php get_footer(); ?>
