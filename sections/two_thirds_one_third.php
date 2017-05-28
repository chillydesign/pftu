<?php $small_position = get_sub_field('big_position'); ?> 
<?php  $classes = ($small_position == 'right') ?  [ 'col-sm-4 col-sm-push-8' ,'col-sm-8 col-sm-pull-4', ]  :  ['col-sm-8', 'col-sm-4']  ; ?> 


	<div class="row">


		<div class="<?php echo $classes[0]; ?>">
		<?php echo get_sub_field('two_thirds_content'); ?>
		</div>


		<div class="<?php echo $classes[1]; ?>">
			<?php echo get_sub_field('one_third_content'); ?>
		</div>

	</div> <!-- END OF ROW -->


