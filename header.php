<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
		<link href="https://fonts.googleapis.com/css?family=Montserrat:300,600" rel="stylesheet">
				<link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">

		<?php wp_head(); ?>


	</head>
	<body <?php body_class(); ?>>


			<header id="header">


				<a id="logo" href="<?php echo home_url(); ?>">
				PFTU - Plateforme de Formation Transfrontalière en Développement Urbain
				</a>



				<a href="#" id="search_opener"></a>
				<?php  get_template_part('searchform'); ?>

			</header>


					<!-- nav -->
					<nav id="nav" role="navigation">

							<a href="#" id="mobile_nav_button">Menu</a>
							<?php webfactor_nav(); ?>
					</nav>
					<!-- /nav -->
