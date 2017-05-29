<h2>Actualites</h2>


<div id="news_outer">
  <ul id="news_slider" class="bxslider">

    <?php $news = get_posts( array('post_type' => 'post', 'posts_per_page'=> -1 )); ?>

    <?php foreach ( $news as $post ) :
      setup_postdata( $post );
      $news_date = get_field('date') ;
      $news_img = thumbnail_of_post_url($post->ID, 'square');
      ?>

      <li>
        <article>
          <h3>	<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
          <?php if ($news_date !=''): ?><p class="meta"><?php echo  date_i18n(  get_option( 'date_format' ), strtotime( $news_date)); ?></p><?php endif; ?>
          <p class="summary"><?php echo get_the_excerpt(); ?></p>
        </article>
        	<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="news_image" style="background-image:url(<?php echo $news_img; ?>);"></a>
      </li>
    <?php endforeach; wp_reset_postdata();?>


  </ul>
</div>
