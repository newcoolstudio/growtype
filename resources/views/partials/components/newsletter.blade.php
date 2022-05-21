<form class="form-newsletter" action="{!! isset($action) ? $action : '' !!}" method="post">
    <div class="mb-3">
        <label for="newsletter_email" class="form-label">{!! __('Email','growtype') !!}</label>
        <input id="newsletter_email" name="newsletter_email" type="email" class="form-control" placeholder="{!! isset($email_placeholder) ? $email_placeholder : __('Your email','growtype') !!}" required>
    </div>
    <button type="submit" class="btn btn-primary">{!! isset($submit_label) ? $submit_label : __('Submit','growtype') !!}</button>
    <div class="status-message mt-3 alert" role="alert" style="display:none;"></div>
</form>

@push('footerScripts')
    <script>
        $('.form-newsletter').submit(function () {
            event.preventDefault();

            let form = $(this);
            let formData = form.serializeArray();
            formData.push({name: "action", value: 'newsletter_submission'});

            form.find('.status-message').fadeOut().promise().done(function () {
                $(this).removeClass('alert-danger alert-success');
            })

            var formUrl = $(this).attr('action');

            $.ajax({
                type: "POST",
                url: formUrl.length > 0 ? formUrl : window.ajax_object.ajaxurl,
                data: formData,
                success: function (data) {
                    form.find('.status-message')
                        .html(data.message)
                        .addClass('alert-success')
                        .fadeIn();
                },
                error: function (data) {
                    form.find('.status-message')
                        .html(data.responseJSON.message)
                        .addClass('alert-danger')
                        .fadeIn();
                }
            });
        });
    </script>
@endpush
