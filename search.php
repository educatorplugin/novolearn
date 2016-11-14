<?php
$layout = get_theme_mod( 'posts_layout' );
$template_part = 'template-parts/content';
?>
<?php get_header(); ?>

<div class="page-section page-section_main">
	<div class="container">
		<div class="row">
			<div class="page-content">
				<div class="page-heading">
					<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'novolearn' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h1>
				</div>

				<?php
					if ( have_posts() ) :
						if ( '2col_sidebar' == $layout ) :
							$template_part = 'template-parts/card';
							echo '<div class="posts-grid posts-grid-2">';
						else :
							echo '<div class="posts-list">';
						endif;

						while ( have_posts() ) : the_post();
							get_template_part( $template_part, 'search' );
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
