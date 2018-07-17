

<div class="container">


<?php if( have_rows('group') ):

 	// loop through the rows of data
    while ( have_rows('group') ) : the_row(); ?>

       <div class="grey_box">
       		<h5><?php the_sub_field('title'); ?></h5>
       		<?php while ( have_rows('travaux') ) : the_row(); ?>
       			<a class="downld" href="<?php the_sub_field('file'); ?>" target="_blank">
	       			<h6><?php the_sub_field('doc_title'); ?></h6>
	       			<p class="author"><?php the_sub_field('author'); ?></p>
       			</a>
       		 <?php endwhile; ?>

       </div>

    <?php endwhile; ?>
<?php endif; ?>


</div>
