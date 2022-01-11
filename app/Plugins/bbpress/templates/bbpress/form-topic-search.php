<?php

/**
 * Search
 *
 * @package bbPress
 * @subpackage Theme
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( bbp_allow_search() ) : ?>

	<div class="bbp-search-form">
		<form role="search" method="get" id="bbp-topic-search-form">
			<div class="row">
                <div class="bbp-search-input-wrapper mb-2 mb-md-0 col-12 col-md-6 col-xl-8">
                    <label class="screen-reader-text hidden" for="ts"><?php esc_html_e( 'Search topics:', 'bbpress' ); ?></label>
                    <input type="text" class="form-control" value="<?php bbp_search_terms(); ?>" name="ts" id="ts" placeholder="<?php esc_attr_e( 'Search', 'bbpress' ); ?>" />
                </div>
                <div class="col-12 col-md-6 d-block d-grid gap-2 col-xl-4">
                    <button class="btn btn-primary" type="submit" id="bbp_search_submit"><?php esc_html_e( 'Search', 'bbpress' ); ?></button>
                </div>
			</div>
		</form>
	</div>

	<?php
endif;
