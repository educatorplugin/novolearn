<?php

/**
 * Get the list of available web fonts.
 *
 * @return array
 */
function novolearn_get_fonts() {
	$fonts = array(
		'Open Sans' => array(
			'styles' => '400,600,700,400italic,600italic,700italic',
		),
		'Roboto' => array(
			'styles' => '300,400,700,300italic,400italic,700italic',
		),
	);

	return apply_filters( 'novolearn_get_fonts', $fonts );
}

/**
 * Sanitize font subset (a comma separated list).
 *
 * @return string
 */
function novolearn_sanitize_font_subset( $subset ) {
	if ( preg_match( '/^[a-zA-Z0-9\-,]+$/', $subset ) ) {
		return $subset;
	}

	return '';
}

/**
 * Get the url to load fonts from.
 *
 * @return string
 */
function novolearn_get_fonts_url() {
	$body_font = get_theme_mod( 'body_font', 'Open Sans' );
	$font_names = array( $body_font );
	$all_fonts = novolearn_get_fonts();
	$include_fonts = array();

	foreach ( $font_names as $font_name ) {
		if ( ! isset( $include_fonts[ $font_name ] ) && isset( $all_fonts[ $font_name ] ) ) {
			$font = $all_fonts[ $font_name ];
			$include_fonts[ $font_name ] = urlencode( $font_name );

			if ( ! empty( $font['styles'] ) ) {
				$include_fonts[ $font_name ] .= ':' . $font['styles'];
			}
		}
	}

	if ( ! empty( $include_fonts ) ) {
		$url_args = array();
		$url_args['family'] = implode( '|', $include_fonts );

		$font_subset = get_theme_mod( 'font_subset', 'latin,latin-ext' );

		if ( ! empty( $font_subset ) ) {
			$url_args['subset'] = novolearn_sanitize_font_subset( $font_subset );
		}

		return add_query_arg( $url_args, '//fonts.googleapis.com/css' );
	}

	return '';
}
