<div class="person-info clearfix">
	<h2 class="person-info__title"><?php _e( 'Author', 'novolearn' ); ?></h2>
	<div class="person-info__image">
		<?php echo get_avatar( get_the_author_meta( 'user_email' ), 96 ); ?>
	</div>
	<div class="person-info__content">
		<h3 class="person-name"><?php echo get_the_author(); ?></h3>
		<div class="person-bio"><?php the_author_meta( 'description' ); ?></div>
		<a class="person-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
			<?php printf( __( 'View profile of %s', 'novolearn' ), get_the_author() ); ?>
		</a>
	</div>
</div>
