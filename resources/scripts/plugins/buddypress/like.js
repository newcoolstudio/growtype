let id, type;

(function($){
	
	"use strict";

	$('body').on('click', '.btn-like .like, .btn-like .unlike', function () {
		
        id = $(this).attr('id');

        type = $(this).attr('class')
            .replace('bp-primary-action ','')
            .replace('button', 'activity_update')
            .trim();

        $(this).addClass('loading');

        $.post(buddypress_data.ajaxurl, {
            action: 'activity_like',
            'type': type,
            'id': id
        },
		function( data ) {
			$('#' + id).fadeOut(100, function() {
				$(this).html(data).removeClass('loading').fadeIn(100);
			});

			// may only need one if and else if
			// if (like) {} else if (unlike) {} else {oops()}
			// leave for now as may need something for messages
			if (type == 'activity_update like') {

				$('#' + id).removeClass('like')
					.addClass('unlike')
					.attr('title', buddypress_data.unlike_msg)
					.attr('id', id.replace("like", "unlike") );

			} else if (type == 'activity_update unlike') {

				$('#' + id).removeClass('unlike')
					.addClass('like')
					.attr('title', buddypress_data.like_msg)
					.attr('id', id.replace("unlike", "like"));

			} else {
				console.log('Opps. Something went wrong');
				console.log('type: ' + type );
				console.log('id: ' + id );
			}
		});

        return false;
    });
})( jQuery );
