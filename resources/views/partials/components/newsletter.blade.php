@push('pageStyles')
    <style>
        .form-newsletter .form-check {
            margin-top: 20px;
            margin-bottom: 20px;
        }
    </style>
@endpush

<form class="form-newsletter" action="{!! isset($action) ? $action : '' !!}" method="post">
    <div class="form-newsletter-content">
        <div class="input-wrapper">
            <label for="newsletter_email" class="form-label">{!! __('Email','growtype') !!}</label>
            <input id="newsletter_email" name="newsletter_email" type="email" class="form-control" placeholder="{!! isset($email_placeholder) ? $email_placeholder : __('Your email','growtype') !!}" required>
        </div>

        <div class="form-check">
            <input id="newsletterTermsAndConditions" type="checkbox" name="terms_and_conditions" class="form-check-input" required>
            <label class="form-check-label" for="newsletterTermsAndConditions">{!! isset($terms_label) ? $terms_label : __('I agree with terms and conditions','growtype') !!}</label>
        </div>

        <button type="submit" class="btn btn-primary">{!! isset($submit_label) ? $submit_label : __('Submit','growtype') !!}</button>
    </div>
    <div class="status-message mt-3 alert" role="alert" style="display:none;"></div>
</form>

@push('footerScripts')
    <script>
        $('.form-newsletter').submit(function () {
            event.preventDefault();

            let form = $(this);
            let formData = form.serializeArray();
            let submitBtn = $(this).find('button[type="submit"]');

            formData.push({name: "action", value: 'newsletter_submission'});

            form.find('.status-message').fadeOut().promise().done(function () {
                $(this).removeClass('alert-danger alert-success');
            });

            var formUrl = $(this).attr('action');

            submitBtn.attr('disabled', true);

            $.ajax({
                type: "POST",
                url: formUrl.length > 0 ? formUrl : window.ajax_object.ajaxurl,
                data: formData,
                success: function (data) {
                    form.find('.status-message')
                        .html(data.message)
                        .addClass('alert-success')
                        .fadeIn();

                    submitBtn.attr('disabled', false);

                    setTimeout(function () {
                        form.find('.status-message').fadeOut();
                    }, 1500)
                },
                error: function (data) {
                    form.find('.status-message')
                        .html(data.responseJSON.message)
                        .addClass('alert-danger')
                        .fadeIn();

                    submitBtn.attr('disabled', false);

                    setTimeout(function () {
                        form.find('.status-message').fadeOut();
                    }, 1500)
                }
            });
        });
    </script>
@endpush
