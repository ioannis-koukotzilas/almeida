<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body>
	<?php wp_body_open(); ?>
	
	<div class="site">

		<header class="site-header">

			<a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
				<!-- <span class="screen-reader-text"><?php bloginfo('name'); ?></span> -->
				<?php bloginfo('name'); ?>
			</a>

			<?php wp_nav_menu(['theme_location' => 'menu-1', 'menu_id' => 'primary-menu', 'menu_class' => 'primary-menu', 'container' => '']); ?>
		</header>