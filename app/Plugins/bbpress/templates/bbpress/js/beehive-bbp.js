'use strict';

(function($) {
	
	const body = $('body');
		 
	// Flex menu on bbp profile nav
	if(body.hasClass('bbp-user-page') || body.hasClass('bbp-user-edit')) {
		$('#bbp-user-navigation > ul').flexMenu({
			showOnHover: false,
			cutoff: 0,
			popupClass: "dropdown-menu-right",
			linkText: '<i class="uil-ellipsis-h"></i>',
			hOverflow: true,
			shouldApply: function () {
				if(window.innerWidth < 991.98) {
					return true;
				} else {
					return false;
				}
			},
		});
	}

	// Truncate forum content text
	$('#bbpress-forums ul.type-forum .bbp-forum-content').shorten({
		showChars: 65,
		moreText: beehive_data.read_more,
		lessText: beehive_data.read_close
	});
	$('#bbpress-forums ul.bbp-search-results .bbp-forum-content').shorten({
		showChars: 200,
		moreText: beehive_data.read_more,
		lessText: beehive_data.read_close
	});
	
})( jQuery );

