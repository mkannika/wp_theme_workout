<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wptheme04
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'wptheme04' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="container">
			<div id="nav-bar" class="d-md-flex justify-content-between">
				<div class="site-branding">
					<?php
					the_custom_logo();
					if ( is_front_page() && is_home() ) :
						?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php
					else :
						?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php
					endif;
					$wptheme04_description = get_bloginfo( 'description', 'display' );
					if ( $wptheme04_description || is_customize_preview() ) :
						?>
						<h1 class="site-title"><?php echo $wptheme04_description; /* WPCS: xss ok. */ ?></h1>
					<?php endif; ?>
				</div><!-- .site-branding -->

				<nav id="site-navigation" class="main-navigation">

					<?php if((get_theme_mod('wptheme04_telephone') != "") || (get_theme_mod('wptheme04_fax') != "")): ?>
					<div class="group-numbers">
					<?php if(get_theme_mod('wptheme04_fax') != ""): ?>
					<div class="head-fax">
						<div class="fax-number">
							<?php echo get_theme_mod('wptheme04_fax'); ?>
						</div>
					</div>
					<?php endif; ?>

					<?php if(get_theme_mod('wptheme04_telephone') != ""): ?>
					<div class="head-telephone">
						<?php if(get_theme_mod('wptheme04_telephone') != ""): ?>
						<div class="tel-number">
							<?php echo get_theme_mod('wptheme04_telephone'); ?>
							<?php if(get_theme_mod('wptheme04_text_time') != ""): ?>
							<div class="text-time"><?php echo get_theme_mod('wptheme04_text_time'); ?></div>
							<?php endif; ?>
						</div>
						<?php endif; ?>
					</div>
					<?php endif; ?>
					</div>
					<?php endif; ?>

					<?php
					wp_nav_menu( array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
					) );
					?>
				</nav><!-- #site-navigation -->
			</div>

			<div id="toggle-menu" class="menu-toggle">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</div>

			<?php if(get_header_image() != ""): ?>
				<div class="main-image"><img src="<?php echo( get_header_image() ); ?>" alt="<?php echo( get_bloginfo( 'title' ) ); ?>" /></div>
			<?php endif; ?>

		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
