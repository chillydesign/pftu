<?php $small_position = get_sub_field('small_position'); ?> 
<?php $bg_small = get_sub_field('bg_small');?>
<?php $bg_big = get_sub_field('bg_big');?>
<?php  $classes = ($small_position == 'right') ?  [ 'col-sm-8' ,'col-sm-4', ]  :  ['col-sm-8 col-sm-push-4', 'col-sm-4 col-sm-pull-8']  ; ?> 

<div style="margin: 0 15px;">
	<div class="row">


		<div class="<?php echo $classes[0] . ' ' . $bg_big; ?> bigcol">
		<?php echo get_sub_field('two_thirds_content'); ?>
		</div>


		<div class="<?php echo $classes[1] . ' ' . $bg_small; ?> smallcol">
			<?php echo get_sub_field('one_third_content'); ?>
		</div>

	</div> <!-- END OF ROW -->

</div>
