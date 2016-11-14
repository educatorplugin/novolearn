<?php

/**
 * Get post meta HTML.
 *
 * @return string
 */
function novolearn_get_post_meta() {
	$html = '';
	$post_type = get_post_type();

	if ( 'post' == $post_type ) {
		// Author.
		$html .= novolearn_get_post_author();

		// Date.
		$html .= novolearn_get_post_date();

		// Categories.
		$html .= novolearn_get_post_categories();

		// Tags.
		$html .= novolearn_get_post_tags();
	}

	// Comments.
	$html .= novolearn_get_comments_link();

	return $html;
}

/**
 * Get post tags HTML.
 *
 * @return string
 */
function novolearn_get_post_tags() {
	$tags = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'novolearn' ) );

	if ( $tags ) {
		return sprintf( '<span class="tags-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
			_x( 'Tags', 'Used before tag names.', 'novolearn' ),
			$tags
		);
	}

	return '';
}

/**
 * Get post author HTML.
 *
 * @return string
 */
function novolearn_get_post_author() {
	return sprintf( '<span class="byline"><span class="author vcard"><span class="screen-reader-text">%1$s </span><a class="url fn n" href="%2$s">%3$s</a></span></span>',
		_x( 'Author', 'Used before post author name.', 'novolearn' ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		get_the_author()
	);
}

/**
 * Get post date HTML.
 *
 * @return string
 */
function novolearn_get_post_date() {
	$html = '';

	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$html = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	} else {
		$html = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	}

	$html = sprintf( $html,
		esc_attr( get_the_date( 'c' ) ),
		get_the_date(),
		esc_attr( get_the_modified_date( 'c' ) ),
		get_the_modified_date()
	);

	return sprintf( '<span class="posted-on"><span class="screen-reader-text">%1$s </span><a href="%2$s" rel="bookmark">%3$s</a></span>',
		_x( 'Posted on', 'Used before publish date.', 'novolearn' ),
		esc_url( get_permalink() ),
		$html
	);
}

/**
 * Get post categories HTML.
 *
 * @return string
 */
function novolearn_get_post_categories() {
	$categories = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'novolearn' ) );

	if ( $categories ) {
		return sprintf( '<span class="cat-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
			_x( 'Categories', 'Used before category names.', 'novolearn' ),
			$categories
		);
	}

	return '';
}

/**
 * Get comments link HTML.
 *
 * @return string
 */
function novolearn_get_comments_link() {
	$html = '';

	if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		$html .= '<span class="comments-link">';
		ob_start();
		comments_popup_link( sprintf( __( 'Leave a comment<span class="screen-reader-text"> on %s</span>', 'novolearn' ), get_the_title() ) );
		$html .= ob_get_clean();
		$html .= '</span>';
	}

	return $html;
}

/**
 * Get social links list HTML.
 *
 * @return string
 */
function novolearn_get_social_links() {
	$links = array(
		'facebook'    => array(
			'url'   => get_theme_mod( 'facebook_url', '' ),
			'label' => __( 'Facebook', 'novolearn' ),
		),
		'google-plus' => array(
			'url'   => get_theme_mod( 'google_plus_url', '' ),
			'label' => __( 'Google+', 'novolearn' ),
		),
		'twitter'     => array(
			'url'   => get_theme_mod( 'twitter_url', '' ),
			'label' => __( 'Twitter', 'novolearn' ),
		),
		'linkedin'    => array(
			'url'   => get_theme_mod( 'linkedin_url', '' ),
			'label' => __( 'Linkedin', 'novolearn' ),
		),
	);

	$html = '';

	foreach ( $links as $link_key => $link ) {
		if ( $link['url'] ) {
			$html .= '<li class="' . esc_attr( $link_key ) . '"><a href="' . esc_url( $link['url'] )
				. '" title="' . esc_attr( $link['label'] ) . '" target="_blank"><span class="fa fa-' .
				esc_attr( $link_key ) . '"></span></a></li>';
		}
	}

	if ( $html ) {
		$html = '<ul class="social-links">' . $html . '</ul>';
	}

	return $html;
}

/**
 * Display post thumbnail.
 *
 * @param string $type
 * @param boolean $link
 */
function novolearn_post_thumb( $type = '', $link = true ) {
	if ( has_post_thumbnail() ) {
		$attachment_id = get_post_thumbnail_id();

		if ( ! $type ) {
			$layout = get_theme_mod( 'posts_layout' );
			$type = ( '2col_sidebar' == $layout ) ? '100vw_33vw' : '100vw_66vw';
		}

		echo '<div class="post-thumbnail">';

		if ( $link ) {
			echo '<a href="' . esc_url( get_permalink() ) . '">';
		}

		if ( '100vw_66vw' == $type ) {
			$src_small = wp_get_attachment_image_src( $attachment_id, 'novo_small' );
			$src_content = wp_get_attachment_image_src( $attachment_id, 'novo_content' );
			$src_full = wp_get_attachment_image_src( $attachment_id, 'full' );

			echo '<img src="' . esc_url( $src_content[0] ) . '" srcset="';
			echo esc_url( $src_content[0] ) . ' ' . intval( $src_content[1] ) . 'w, ';
			echo esc_url( $src_small[0] ) . ' ' . intval( $src_small[1] ) . 'w,';
			echo esc_url( $src_full[0] ) . ' ' . intval( $src_full[1] ) . 'w';
			echo '" sizes="(min-width: 761px) 730px, calc(100vw - 30px)">';
		} elseif ( '100vw_33vw' == $type ) {
			$src_small = wp_get_attachment_image_src( $attachment_id, 'novo_small' );
			$src_content = wp_get_attachment_image_src( $attachment_id, 'novo_content' );
			$src_large = wp_get_attachment_image_src( $attachment_id, 'novo_large' );

			echo '<img src="' . esc_url( $src_small[0] ) . '" srcset="';
			echo esc_url( $src_content[0] ) . ' ' . intval( $src_content[1] ) . 'w,';
			echo esc_url( $src_small[0] ) . ' ' . intval( $src_small[1] ) . 'w,';
			echo esc_url( $src_large[0] ) . ' ' . intval( $src_large[1] ) . 'w';
			echo '" sizes="(min-width: 768px) 350px, (min-width: 761px) 730px, calc(100vw - 30px)">';
		}

		if ( $link ) {
			echo '</a>';
		}

		echo '</div>';
	}
}
