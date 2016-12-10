<?php
$user = wp_get_current_user();
$header_class = 'header';
$fixed_header = get_theme_mod( 'fixed_header', 1 );

if ( is_front_page() && ! is_home() && has_post_thumbnail() ) {
	$header_class .= ' header_home';
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div class="page-container">
		<?php if ( get_theme_mod( 'enable_toolbar', 0 ) ) : ?>
		<div id="js-top-toolbar" class="top-toolbar">
			<div class="container">
				<div class="top-toolbar__item left">
					<div class="toolbar-text">
						<?php
							$toolbar_text = get_theme_mod( 'toolbar_text' );
							echo $toolbar_text;
						?>
					</div>
				</div>

				<div class="top-toolbar__item top-toolbar__item_auth right">
					<?php if ( 0 != $user->ID ) : ?>
						<div class="novo-dropdown novo-dropdown_user">
							<a class="novo-dropdown__label js-nd-label" href="#"><span class="fa fa-user"></span> <?php echo esc_html( $user->display_name ); ?></a>
							<ul class="menu">
								<?php
									wp_nav_menu( array(
										'theme_location' => 'auth',
										'container'      => false,
										'fallback_cb'    => false,
										'items_wrap'     => '%3$s',
									) );
								?>
								<li><a href="<?php echo esc_url( wp_logout_url() ); ?>"><?php _e( 'Logout', 'novolearn' ); ?></a></li>
							</ul>
						</div>
					<?php else : ?>
						<a class="login-link" href="<?php echo esc_url( wp_login_url() ); ?>" title="<?php esc_attr_e( 'Login', 'novolearn' ); ?>"><span class="fa fa-unlock-alt"></span> <?php _e( 'Login', 'novolearn' ); ?></a>
						<a class="register-link" href="<?php echo esc_url( wp_registration_url() ); ?>" title="<?php esc_attr_e( 'Register', 'novolearn' ); ?>"><span class="fa fa-pencil"></span> <?php _e( 'Register', 'novolearn' ); ?></a>
					<?php endif; ?>
				</div>

				<?php $social_links = novolearn_get_social_links(); ?>
				<?php if ( $social_links ) : ?>
					<div class="top-toolbar__item top-toolbar__item_social right">
						<?php echo $social_links; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<?php endif; ?>

		<header id="js-header" class="<?php echo esc_attr( $header_class ); ?>" data-fixed="<?php echo intval( $fixed_header ); ?>">
			<div class="header__fixed">
				<div class="header__content">
					<div class="header__logo">
						<?php
							$logo1x_id = get_theme_mod( 'custom_logo' );

							if ( $logo1x_id && ( $logo1x = wp_get_attachment_image_src( $logo1x_id, 'full' ) ) ) {
								$logo_img = '<img src="' . esc_url( $logo1x[0] ) . '" srcset="' . esc_url( $logo1x[0] ) . ' 1x';

								// Add 2x logo for high resolution screens.
								$logo2x_src = get_theme_mod( 'logo_2x' );

								if ( $logo2x_src ) {
									$logo_img .= ', ' . esc_url( $logo2x_src ) . ' 2x';
								}

								$logo_img .= '" width="' . intval( $logo1x[1] ) . '" height="' . intval( $logo1x[2] ) . '" alt="">';

								printf( '<a class="custom-logo-link" href="%1$s" rel="home">%2$s</a>',
									esc_url( home_url( '/' ) ),
									$logo_img
								);
							} else {
								printf( '<div class="site-title"><a href="%1$s" rel="home">%2$s</a></div>',
									esc_url( home_url( '/' ) ),
									get_bloginfo( 'name', 'display' )
								);

								$description = get_bloginfo( 'description', 'display' );

								if ( $description ) {
									echo '<div class="site-description">', $description, '</div>';
								}
							}
						?>
					</div>

					<?php if ( get_theme_mod( 'header_search_button', 1 ) ) : ?>
					<div class="search-trigger-wrap">
						<a id="js-search-trigger" class="search-trigger" href="#" title="<?php _e( 'Search', 'novolearn' ); ?>"><span class="fa fa-search"></span></a>
					</div>

					<div id="js-header-search" class="header-search">
						<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
							<input type="search" name="s" value="" placeholder="<?php _e( 'Search...', 'novolearn' ); ?>" required>
							<button type="submit"><span class="fa fa-search"></span></button>
						</form>
					</div>
					<?php endif; ?>

					<nav class="main-nav">
						<?php
							wp_nav_menu( array(
								'theme_location' => 'primary',
								'container'      => false,
								'fallback_cb'    => false,
							) );
						?>
					</nav>

					<a id="js-nav-trigger" class="nav-trigger" href="#" title="<?php _e( 'Menu', 'novolearn' ); ?>">
						<span class="bar1"></span>
						<span class="bar2"></span>
						<span class="bar3"></span>
					</a>
				</div>
			</div>
		</header>
