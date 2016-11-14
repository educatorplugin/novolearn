<?php
$post_id = get_the_ID();
$is_course = ( novolearn_educator_enabled() && EDR_PT_COURSE == get_post_type() );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php novolearn_post_thumb(); ?>

	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		<?php
			$meta = novolearn_get_post_meta();

			if ( $meta ) {
				echo '<div class="entry-meta entry-meta_inline">', $meta, '</div>';
			}

			if ( $is_course ) {
				$obj_courses = Edr_Courses::get_instance();
				$price = $obj_courses->get_course_price( $post_id );

				if ( $price > 0 ) {
					echo '<div class="price">', edr_format_price( $price ), '</div>';
				} else {
					echo '<div class="price">', _x( 'Free', 'price', 'novolearn' ), '</div>';
				}
			}
		?>
	</header>

	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */
			the_content( sprintf(
				__( 'Read more<span class="screen-reader-text"> "%s"</span>', 'novolearn' ),
				get_the_title()
			) );

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'novolearn' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'novolearn' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		?>
	</div>
</article>
