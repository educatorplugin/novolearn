<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php novolearn_post_thumb(); ?>

	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		<?php
			$meta = novolearn_get_post_meta();

			if ( $meta ) {
				echo '<div class="entry-meta entry-meta_inline">', $meta, '</div>';
			}
		?>
	</header>

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>
</article>
