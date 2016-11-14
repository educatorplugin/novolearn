<?php
$search_query = get_search_query();
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php _e( 'Search for:', 'novolearn' ); ?></span>
		<input class="search-field" placeholder="<?php _e( 'Search ...', 'novolearn' ); ?>" value="<?php echo esc_attr( $search_query ); ?>" name="s" type="search" required>
	</label>
	<button class="search-submit" type="submit"><i class="fa fa-search"></i></button>
</form>
