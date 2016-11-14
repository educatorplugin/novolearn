<?php
$post_id = get_the_ID();
$is_course = novolearn_educator_enabled() && EDR_PT_COURSE == get_post_type();
?>
<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
<?php endif; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php novolearn_post_thumb(); ?>

	<?php
		$meta_html = '';

		if ( 'post' == get_post_type() ) {
			$meta_html = novolearn_get_post_categories();
			$meta_html .= novolearn_get_post_date();
		} elseif ( $is_course ) {
			$meta_html = edr_get_course_categories_html( $post_id );
			$meta_html .= edr_get_course_difficulty_html( $post_id );
		}

		$title = get_the_title();

		if ( $title || $meta_html ) {
			echo '<header class="entry-header">';

			if ( $meta_html ) {
				echo '<div class="entry-meta">', $meta_html, '</div>';
			}

			if ( $title ) {
				echo '<h2 class="entry-title"><a href="', esc_url( get_permalink() ), '" rel="bookmark">', $title, '</a></h2>';
			}

			echo '</header>';
		}
	?>

	<div class="entry-summary">
		<?php the_content( '' ); ?>
	</div>

	<div class="entry-footer">
		<?php
			$comments_link = novolearn_get_comments_link();

			if ( $comments_link ) {
				echo $comments_link;
			}

			if ( $is_course ) {
				$obj_courses = Edr_Courses::get_instance();
				$price = $obj_courses->get_course_price( $post_id );

				if ( $price > 0 ) {
					echo '<span class="price">', edr_format_price( $price ), '</span>';
				} else {
					echo '<span class="price">', _x( 'Free', 'price', 'novolearn' ), '</span>';
				}
			}
		?>
		<a class="more-link" href="<?php the_permalink(); ?>"><?php _e( 'Read more', 'novolearn' ); ?></a>
	</div>
</article>
