		<footer class="footer">
			<div class="container">
				<div class="row">
					<div class="footer-copy">
						<p>
							<?php
								$footer_text = get_theme_mod( 'footer_text', '' );
								echo $footer_text;
							?>
						</p>
					</div>

					<?php
						wp_nav_menu( array(
							'theme_location' => 'footer',
							'container'      => false,
						) );
					?>
				</div>
			</div>
		</footer>
	</div>

	<div id="js-mobile-nav" class="super-nav" data-trigger="#js-nav-trigger">
		<div class="super-nav__block">
			<div class="super-nav__block__header"><?php _e( 'Menu', 'novolearn' ); ?></div>
			<?php
				wp_nav_menu( array(
					'theme_location' => 'mobile',
					'container'      => false,
				) );
			?>
		</div>

		<div class="super-nav__block super-nav__block_search">
			<?php get_template_part( 'searchform' ); ?>
		</div>

		<a href="#" class="super-nav__close"></a>
	</div>
	<div id="js-super-nav-overlay" class="super-nav-overlay"></div>

<?php wp_footer(); ?>
</body>
</html>
