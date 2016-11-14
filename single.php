<?php get_header(); ?>

<div class="page-section page-section_main">
	<div class="container">
		<div class="row">
			<div class="page-content">
				<?php
					while ( have_posts() ) : the_post();
						get_template_part( 'template-parts/content', 'single' );

						if ( comments_open() || get_comments_number() ) {
							comments_template();
						}

						the_post_navigation( array(
							'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'novolearn' ) . '</span> ' .
								'<span class="screen-reader-text">' . __( 'Next post:', 'novolearn' ) . '</span> ' .
								'<span class="post-title">%title</span>',
							'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'novolearn' ) . '</span> ' .
								'<span class="screen-reader-text">' . __( 'Previous post:', 'novolearn' ) . '</span> ' .
								'<span class="post-title">%title</span>',
						) );
					endwhile;
				?>
			</div>

			<?php get_sidebar(); ?>
		</div>
	</div>
</div>

<?php get_footer(); ?>
