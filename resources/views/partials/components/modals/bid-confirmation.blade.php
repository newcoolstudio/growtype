<div class="modal modal-confirmation fade" id="modal-bid-confirmation" tabindex="-1" aria-labelledby="modal-bid-confirmation-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-confirmation-label">{!! __('Bid confirmation', 'growtype') !!}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="b-value">
                    <div class="e-value b-bid-current">$0</div>
                    <div class="e-label">{!! __('Your bid','growtype') !!}</div>
                </div>
                <div class="b-value">
                    <div class="e-value woocommerce-Price-amount">$0</div>
                    <div class="e-label">{!! __("Price inc. buyer’s premium",'growtype') !!}</div>
                </div>
                <div class="b-value">
                    <div class="e-value woocommerce-Price-amount">$0</div>
                    <div class="e-label">{!! __('Total price','growtype') !!}</div>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{!! __('Reject','growtype') !!}</button>
                <button type="button" class="btn btn-primary" data-submit="true">{!! __('Confirm','growtype') !!}</button>
            </div>
        </div>
    </div>
</div>
