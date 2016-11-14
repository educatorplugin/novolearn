<?php
$layout = get_theme_mod( 'posts_layout' );
$template_part = 'template-parts/content';
?>
<?php get_header(); ?>

<div class="page-section page-section_main">
	<div class="container">
		<div class="row">
			<div class="page-content">
				<?php if ( is_home() && ! is_front_page() ) : ?>
					<div class="page-heading">
						<h1 class="page-title"><?php single_post_title(); ?></h1>
					</div>
				<?php endif; ?>

				<?php
					if ( have_posts() ) :
						if ( '2col_sidebar' == $layout ) :
							$template_part = 'template-parts/card';
							echo '<div class="posts-grid posts-grid-2">';
						else :
							echo '<div class="posts-list">';
						endif;

						while ( have_posts() ) : the_post();
							get_template_part( $template_part, get_post_format() );
						endwhile;

						echo '</div>';

						the_posts_pagination( array(
							'prev_text'          => __( 'Previous page', 'novolearn' ),
							'next_text'          => __( 'Next page', 'novolearn' ),
							'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'novolearn' ) . ' </span>',
						) );
					else :
						get_template_part( 'template-parts/content', 'none' );
					endif;
				?>
			</div>

			<?php get_sidebar(); ?>
		</div>
	</div>
</div>

<?php get_footer(); ?>
