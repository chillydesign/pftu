<?php get_header(); ?>


<!-- section -->
<section class="section  section_two_thirds_one_third">



    <?php if (have_posts()): while (have_posts()) : the_post(); ?>

        <div style="margin: 0 15px;">
            <div class="row">


                <div class=" col-sm-8 bigcol thirdscol">

                    <?php $partage_img = thumbnail_of_post_url($post->ID, 'medium'); ?>
                    <?php $place = get_field('place'); ?>
                    <?php $link = get_field('link'); ?>
                    <?php $description = get_field('description'); ?>
                    <?php $file = get_field('file'); ?>

                    <h1>
                        <?php the_title(); ?>
                        <?php if ($place && $place != '') echo   ', ' . $place ; ?>
                    </h1>
                    <?php if ($description && $description != "") :  ?>
                        <p><?php echo  $description ; ?></p>
                    <?php endif; ?>



                    <?php comments_template(); ?>


                    <?php edit_post_link(); // Always handy to have Edit Post Links available ?>
                </div>


                <div class="col-sm-4 primary smallcol thirdscol">

                    <!-- post thumbnail -->
                    <?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
                        <?php $thumbnail_img = thumbnail_of_post_url( get_the_ID(), 'medium'); ?>
                        <img class="partage_image" src="<?php echo $thumbnail_img; ?>"  alt="" />
                    <?php endif; ?>
                    <!-- /post thumbnail -->
    <?php if ($link && $link != ''){ ?> <a  class="icon_link partage_icon" target="_blank" href="<?php echo add_scheme_to_url($link); ?>"><?php echo $link; ?></a><?php } ?>
    <?php if ($file && $file['url'] != '') { ?><a class="icon_download partage_icon"  target="_blank"  href="<?php echo $file['url']; ?>"> Telecharger </a><?php } ?>

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




<?php get_footer(); ?>
