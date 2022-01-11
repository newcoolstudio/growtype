<?php

/**
 * Pagination for pages of search results
 *
 * @package bbPress
 * @subpackage Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<?php do_action( 'bbp_template_before_pagination_loop' ); ?>

<div class="bbp-pagination beehive-pagination">
	<div class="bbp-pagination-links">

		<?php bbp_search_pagination_links(); ?>

	</div>
</div>

<?php do_action( 'bbp_template_after_pagination_loop' ); ?>
