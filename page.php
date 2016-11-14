<?php get_header(); ?>

<div class="page-section page-section_main">
	<div class="container">
		<div class="row">
			<div class="page-content">
				<?php
					while ( have_posts() ) : the_post();
						get_template_part( 'template-parts/content', 'page' );

						if ( comments_open() || get_comments_number() ) {
							comments_template();
						}
					endwhile;
				?>
			</div>

			<?php get_sidebar(); ?>
		</div>
	</div>
</div>

<?php get_footer(); ?>
