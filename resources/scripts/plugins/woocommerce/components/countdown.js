function countdown() {

    document.addEventListener('filterProductsByOrder', initCountdown)

    function initCountdown() {
        if ($(".auction-time-countdown").length > 0 && $.SAcountdown !== 'undefined') {
            $(".auction-time-countdown").each(function (index) {
                var time = $(this).data('time');
                var format = $(this).data('format');
                var compact = false;

                if (format == '') {
                    format = 'yowdHMS';
                }

                if (data.compact_counter == 'yes') {
                    compact = true;
                } else {
                    compact = false;
                }

                var etext = '';
                if ($(this).hasClass('future')) {
                    var etext = '<div class="started">' + data.started + '</div>';
                } else {
                    var etext = '<div class="over">' + data.checking + '</div>';
                }

                if (!$(' body').hasClass('logged-in')) {
                    time = $.SAcountdown.UTCDate(-(new Date().getTimezoneOffset()), new Date(time * 1000));
                }

                $(this).SAcountdown({
                    until: time,
                    format: format,
                    compact: compact,
                    expiryText: etext
                });
            });
        }
    }
}

export {countdown};





