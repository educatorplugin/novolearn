<?php
/**
 * Template Name: Subpages
 */

$page_id = get_the_ID();
$child_pages_query = new WP_Query( array(
	'post_type'   => 'page',
	'post_status' => array( 'publish', 'private' ),
	'post_parent' => $page_id,
	'order_by'    => 'menu_order',
	'order'       => 'ASC',
) );

// Get image caption settings.
$caption_position = get_post_meta( $page_id, 'image_caption_position', true );
$caption_style = get_post_meta( $page_id, 'image_caption_style', true );
$caption_classes = 'description';

if ( in_array( $caption_position, array( 'left', 'center', 'right' ) ) ) {
	$caption_classes .= ' description_' . $caption_position;
}

if ( in_array( $caption_style, array( 'light', 'dark' ) ) ) {
	$caption_classes .= ' description_' . $caption_style;
}
?>
<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
	<?php if ( has_post_thumbnail() ) : ?>
		<div id="page-featured-image" class="featured-image">
			<div class="container">
				<?php the_post_thumbnail( 'novo_wide' ); ?>

				<div class="<?php echo esc_attr( $caption_classes ); ?>">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	<?php endif; ?>
<?php endwhile; ?>

<?php if ( $child_pages_query->have_posts() ) : ?>
	<?php while ( $child_pages_query->have_posts() ) : $child_pages_query->the_post(); ?>
		<div id="page-section-<?php the_ID(); ?>" class="page-section">
			<div class="container">
				<?php
					$child_page_id = get_the_ID();
					$title = get_post_meta( $child_page_id, 'title', true );

					if ( $title ) {
						$subtitle = get_post_meta( $child_page_id, 'subtitle', true );

						echo '<div class="heading">';
						echo '<h2 class="heading__title">', esc_html( $title ), '</h2>';

						if ( $subtitle ) {
							echo '<div class="heading__subtitle">', esc_html( $subtitle ) ,'</div>';
						}

						echo '</div>';
					}
				?>
				<?php the_content(); ?>
			</div>
		</div>
	<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
