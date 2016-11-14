<?php

/**
 * Check if the Educator plugin is enabled.
 *
 * @return boolean
 */
function novolearn_educator_enabled () {
	return defined( 'EDR_VERSION' );
}
