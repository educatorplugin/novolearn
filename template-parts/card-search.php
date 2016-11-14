<?php
$post_type = get_post_type();
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php novolearn_post_thumb(); ?>

	<header class="entry-header">
		<?php if ( 'post' == $post_type ) : ?>
			<div class="entry-meta">
				<?php
					$categories_html = novolearn_get_post_categories();

					if ( $categories_html ) {
						echo $categories_html;
					}

					$date_html = novolearn_get_post_date();

					if ( $date_html ) {
						echo $date_html;
					}
				?>
			</div>
		<?php endif; ?>

		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	</header>

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>

	<div class="entry-footer">
		<?php
			if ( 'post' == $post_type ) {
				$comments_link = novolearn_get_comments_link();

				if ( $comments_link ) {
					echo $comments_link;
				}
			}
		?>
		<a class="more-link" href="<?php the_permalink(); ?>"><?php _e( 'Read more', 'novolearn' ); ?></a>
	</div>
</article>
