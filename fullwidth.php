<?php
/**
 * Template name: Full Width
 */
?>
<?php get_header(); ?>

<div class="page-section">
	<div class="container">
		<?php
			while ( have_posts() ) : the_post();
				get_template_part( 'template-parts/content', 'page' );

				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
			endwhile;
		?>
	</div>
</div>

<?php get_footer(); ?>
