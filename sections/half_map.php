<div class="container">
<?php  $coordinates = strval(get_sub_field('google_map'));
$google_map = '[chilly_map location="' . $coordinates . '"]'; ?>
<div class="row">
	<?php if(get_sub_field('map_side')=='left'){ ?>
		<div class="col-sm-6">
			<?php echo do_shortcode($google_map); ?>
		</div>
		<div class="col-sm-6">
			<?php echo get_sub_field('address'); ?>
		</div>
	<?php } else { ?>
		<div class="col-sm-6 col-sm-push-6">
			<?php echo do_shortcode($google_map); ?>
		</div>
		<div class="col-sm-6 col-sm-pull-6">
			<?php echo get_sub_field('address'); ?>
		</div>
	<?php } unset($coordinates); unset($google_map); ?>
</div>
