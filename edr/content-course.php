<?php
$post_id = get_the_ID();
$obj_courses = Edr_Courses::get_instance();
$price = $obj_courses->get_course_price( $post_id );
$price_str = ( $price > 0 ) ? edr_format_price( $price ) : _x( 'Free', 'price', 'novolearn' );
?>
<article id="course-<?php the_ID(); ?>" class="edr-course">
	<?php novolearn_post_thumb( '100vw_33vw' ); ?>

	<header class="edr-course__header">
		<?php
			$meta_html = edr_get_course_categories_html( $post_id );
			$meta_html .= edr_get_course_difficulty_html( $post_id );

			if ( $meta_html ) {
				echo '<div class="edr-course__meta">', $meta_html ,'</div>';
			}
		?>
		<h2 class="edr-course__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	</header>

	<div class="edr-course__summary">
		<?php the_excerpt(); ?>
	</div>

	<div class="edr-course__footer">
		<span class="price"><?php echo $price_str; ?></span>
		<a class="more-link" href="<?php the_permalink(); ?>"><?php _e( 'Read more', 'novolearn' ); ?></a>
	</div>
</article>
