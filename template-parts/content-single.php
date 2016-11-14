<?php
$post_type = get_post_type();
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'hentry_single' ); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<?php
			$meta_html = novolearn_get_post_meta();

			if ( $meta_html ) {
				echo '<div class="entry-meta entry-meta_inline">', $meta_html, '</div>';
			}
		?>
	</header>

	<?php novolearn_post_thumb( '100vw_66vw', false ); ?>

	<div class="entry-content">
		<?php
			the_content( null, true );

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'novolearn' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'novolearn' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );

			if ( novolearn_educator_enabled() && EDR_PT_COURSE == $post_type ) {
				get_template_part( 'template-parts/lecturer-info' );
			} elseif ( 'post' == $post_type ) {
				get_template_part( 'template-parts/author-info' );
			}
		?>
	</div>
</article>
