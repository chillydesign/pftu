<h3>Partenaires</h3>
<ul id="partners_slider" class="bxslider">

	<?php $partenaires = get_posts( array('post_type' => 'partenaire', 'posts_per_page'=> -1 )); ?>

	<?php foreach ( $partenaires as $post ) :
		setup_postdata( $post );
		$partenaire_link = get_field('lien') ;
		$partenaire_img = thumbnail_of_post_url($post->ID, 'full');
		?>

		<li>
			<?php if ($partenaire_link !=''): ?><a target="_blank" href="<?php echo $partenaire_link; ?>"><?php endif; ?>
				<div class="partenaire_inner" style="background-image:url(<?php echo $partenaire_img; ?>);"></div>
				<?php if ($partenaire_link !=''): ?></a><?php endif; ?>
			</li>
		<?php endforeach; wp_reset_postdata();?>


	</ul>
