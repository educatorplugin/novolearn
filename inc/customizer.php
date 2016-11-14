<?php

/**
 * Get layout choices.
 *
 * @return array
 */
function novolearn_get_layout_choices() {
	return array(
		'list'         => __( 'List', 'novolearn' ),
		'2col_sidebar' => __( 'Grid with sidebar', 'novolearn' ),
	);
}

/**
 * Sanitize font name.
 *
 * @param string $font_name
 * @return string
 */
function novolearn_sanitize_font_name( $font_name ) {
	if ( preg_match( '/^[a-z0-9 ]+$/i', $font_name ) ) {
		return $font_name;
	}

	return '';
}

/**
 * Sanitize layout choice.
 *
 * @param string $layout
 * @return string
 */
function novolearn_sanitize_layout_choice( $layout ) {
	$choices = novolearn_get_layout_choices();

	if ( ! array_key_exists( $layout, $choices ) ) {
		$layout = 'list';
	}

	return $layout;
}

/**
 * Sanitize font weight value.
 *
 * @param string $font_weight
 * @return string
 */
function novolearn_sanitize_font_weight( $font_weight ) {
	switch ( $font_weight ) {
		case '100':
		case '200':
		case '300':
		case '400':
		case '500':
		case '600':
		case '700':
		case '800':
		case '900':
			return $font_weight;
	}

	return '';
}

/**
 * Sanitize color value.
 *
 * @param string $color
 * @return string
 */
function novolearn_sanitize_color( $color ) {
	if ( preg_match( '|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
		return $color;
	}

	return '';
}

/**
 * Sanitize text to allow only a limited amount of HTML tags.
 *
 * @param string $text
 * @return string
 */
function novolearn_sanitize_simple_text( $text ) {
	return wp_kses( $text, array(
		'a' => array(
			'href'  => array(),
			'title' => array(),
		),
	) );
}

/**
 * Register theme settings in Customizer.
 *
 * @param WP_Customize $wp_customize
 */
function novolearn_customize_register( $wp_customize ) {
	// Logo 2x.
	$wp_customize->add_setting( 'logo_2x', array(
		'type'              => 'theme_mod',
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control(
		$wp_customize,
		'logo_2x',
		array(
			'label'       => __( 'Logo (2x)', 'novolearn' ),
			'section'     => 'title_tagline',
			'priority'    => 9,
			'flex_height' => true,
			'flex_width'  => true,
		)
	) );

	// Header.
	$wp_customize->add_section( 'novolearn_header', array(
		'title' => __( 'Header', 'novolearn' ),
	) );

	$wp_customize->add_setting( 'fixed_header', array(
		'type'              => 'theme_mod',
		'default'           => '1',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 'fixed_header', array(
		'label'   => __( 'Fixed Header', 'novolearn' ),
		'section' => 'novolearn_header',
		'type'    => 'checkbox',
	) );

	$wp_customize->add_setting( 'toolbar_text', array(
		'type'              => 'theme_mod',
		'default'           => '',
		'sanitize_callback' => 'novolearn_sanitize_simple_text',
	) );

	$wp_customize->add_control( 'toolbar_text', array(
		'label'   => __( 'Toolbar Text', 'novolearn' ),
		'section' => 'novolearn_header',
		'type'    => 'text',
	) );

	// Font settings.
	$fonts = novolearn_get_fonts();
	$body_fonts = array();

	foreach ( $fonts as $font_name => $font ) {
		$body_fonts[ $font_name ] = $font_name;
	}

	$wp_customize->add_section( 'novolearn_font', array(
		'title' => __( 'Font', 'novolearn' ),
	) );

	$wp_customize->add_setting( 'body_font', array(
		'type'              => 'theme_mod',
		'default'           => 'Open Sans',
		'sanitize_callback' => 'novolearn_sanitize_font_name',
	) );

	$wp_customize->add_control( 'body_font', array(
		'label'   => __( 'Body Font', 'novolearn' ),
		'section' => 'novolearn_font',
		'type'    => 'select',
		'choices' => $body_fonts,
	) );

	$wp_customize->add_setting( 'bold_font_weight', array(
		'type'              => 'theme_mod',
		'default'           => '700',
		'sanitize_callback' => 'novolearn_sanitize_font_weight',
	) );

	$wp_customize->add_control( 'bold_font_weight', array(
		'label'   => __( 'Bold Font Weight', 'novolearn' ),
		'section' => 'novolearn_font',
		'type'    => 'select',
		'choices' => array(
			'400' => __( '400 (Normal)', 'novolearn' ),
			'500' => '500',
			'600' => '600',
			'700' => __( '700 (Bold)', 'novolearn' ),
			'800' => '800',
			'900' => '900',
		),
	) );

	$wp_customize->add_setting( 'headings_font_weight', array(
		'type'              => 'theme_mod',
		'default'           => '700',
		'sanitize_callback' => 'novolearn_sanitize_font_weight',
	) );

	$wp_customize->add_control( 'headings_font_weight', array(
		'label'   => __( 'Headings Font Weight', 'novolearn' ),
		'section' => 'novolearn_font',
		'type'    => 'select',
		'choices' => array(
			'100' => '100',
			'200' => '200',
			'300' => '300',
			'400' => __( '400 (Normal)', 'novolearn' ),
			'500' => '500',
			'600' => '600',
			'700' => __( '700 (Bold)', 'novolearn' ),
			'800' => '800',
			'900' => '900',
		),
	) );

	// Color.
	$wp_customize->add_setting( 'main_color', array(
		'default'           => '#02b3e4',
		'type'              => 'theme_mod',
		'sanitize_callback' => 'novolearn_sanitize_color',
	) );

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'main_color',
			array(
				'label'    => __( 'Main Color', 'novolearn' ),
				'section'  => 'colors',
				'priority' => 0,
			)
		)
	);

	$wp_customize->add_setting( 'hover_color', array(
		'default'           => '#007898',
		'type'              => 'theme_mod',
		'sanitize_callback' => 'novolearn_sanitize_color',
	) );

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'hover_color',
			array(
				'label'    => __( 'Hover Color', 'novolearn' ),
				'section'  => 'colors',
				'priority' => 1,
			)
		)
	);

	$wp_customize->add_setting( 'body_color', array(
		'default'           => '#555',
		'type'              => 'theme_mod',
		'sanitize_callback' => 'novolearn_sanitize_color',
	) );

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'body_color',
			array(
				'label'    => __( 'Body Color', 'novolearn' ),
				'section'  => 'colors',
				'priority' => 2,
			)
		)
	);

	$wp_customize->add_setting( 'headings_color', array(
		'default'           => '#222',
		'type'              => 'theme_mod',
		'sanitize_callback' => 'novolearn_sanitize_color',
	) );

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'headings_color',
			array(
				'label'    => __( 'Headings Color', 'novolearn' ),
				'section'  => 'colors',
				'priority' => 3,
			)
		)
	);

	// Posts layout.
	$wp_customize->add_section( 'novolearn_layout', array(
		'title' => __( 'Layout', 'novolearn' ),
	) );

	$wp_customize->add_setting( 'posts_layout', array(
		'type'              => 'theme_mod',
		'default'           => 'list',
		'sanitize_callback' => 'novolearn_sanitize_layout_choice',
	) );

	$wp_customize->add_control( 'posts_layout', array(
		'label'   => __( 'Posts Layout', 'novolearn' ),
		'section' => 'novolearn_layout',
		'type'    => 'select',
		'choices' => novolearn_get_layout_choices(),
	) );

	// Social.
	$wp_customize->add_section( 'novolearn_social', array(
		'title' => __( 'Social', 'novolearn' ),
	) );

	$wp_customize->add_setting( 'facebook_url', array(
		'type'              => 'theme_mod',
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( 'facebook_url', array(
		'label'   => __( 'Facebook URL', 'novolearn' ),
		'section' => 'novolearn_social',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'google_plus_url', array(
		'type'              => 'theme_mod',
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( 'google_plus_url', array(
		'label'   => __( 'Google+ URL', 'novolearn' ),
		'section' => 'novolearn_social',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'twitter_url', array(
		'type'              => 'theme_mod',
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( 'twitter_url', array(
		'label'   => __( 'Twitter URL', 'novolearn' ),
		'section' => 'novolearn_social',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'linkedin_url', array(
		'type'              => 'theme_mod',
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( 'linkedin_url', array(
		'label'   => __( 'Linkedin URL', 'novolearn' ),
		'section' => 'novolearn_social',
		'type'    => 'text',
	) );

	// Footer.
	$wp_customize->add_section( 'novolearn_footer', array(
		'title' => __( 'Footer', 'novolearn' ),
	) );

	$wp_customize->add_setting( 'footer_text', array(
		'type'              => 'theme_mod',
		'default'           => '',
		'sanitize_callback' => 'novolearn_sanitize_simple_text',
	) );

	$wp_customize->add_control( 'footer_text', array(
		'label'   => __( 'Footer Text', 'novolearn' ),
		'section' => 'novolearn_footer',
		'type'    => 'text',
	) );
}
add_action( 'customize_register', 'novolearn_customize_register' );
