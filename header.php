<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
		<link href="//www.google-analytics.com" rel="dns-prefetch">
		<link href="https://fonts.googleapis.com/css?family=Montserrat:300,600" rel="stylesheet">
        <?php $tdu =  get_template_directory_uri(); ?>
        <link rel="apple-touch-icon" sizes="57x57" href="<?php echo $tdu; ?>/img/favicon/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="<?php echo $tdu; ?>/img/favicon/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo $tdu; ?>/img/favicon/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo $tdu; ?>/img/favicon/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo $tdu; ?>/img/favicon/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo $tdu; ?>/img/favicon/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="<?php echo $tdu; ?>/img/favicon/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo $tdu; ?>/img/favicon/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $tdu; ?>/img/favicon/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo $tdu; ?>/img/favicon/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $tdu; ?>/img/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="<?php echo $tdu; ?>/img/favicon/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $tdu; ?>/img/favicon/favicon-16x16.png">
        <link rel="manifest" href="<?php echo $tdu; ?>/img/favicon/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="<?php echo $tdu; ?>/img/favicon/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">

		<?php $smp = social_meta_properties(); ?>
<!-- Open Graph -->
<meta property="og:url" content="<?php echo $smp->url; ?>">
<meta property="og:type" content="article" />
<meta property="og:site_name" content="<?php bloginfo('name'); ?>"/>
<meta property="og:title" content="<?php echo $smp->title; ?>">
<meta property="og:description" content="<?php echo $smp->description; ?>">
<meta property="og:image" content="<?php echo $smp->image; ?>" />
<meta property="og:img" content="<?php echo $smp->image; ?>" />
<meta property="fb:admins" content="333554090408777" />

<!-- TWITTER -->
<meta name="twitter:card" value="<?php echo $smp->description; ?>">
<meta name="twitter:title" content="<?php echo $smp->title; ?>">
<meta name="twitter:description" content="<?php echo $smp->description; ?>">
<meta name="twitter:image" content="<?php echo $smp->image; ?>">
<!-- GOOGLE -->
<meta itemprop="name" content="<?php echo $smp->title; ?>">
<meta itemprop="description" content="<?php echo $smp->description; ?>">
<meta itemprop="image" content="<?php echo $smp->image; ?>">


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
