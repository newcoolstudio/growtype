<?php do_action('growtype_footer_before_open'); ?>

@if(growtype_footer_is_enabled())
    <footer id="site-footer" class="site-footer site-footer-{{growtype_get_footer_type()}}" role="contentinfo">
        <div class="container footer-inner">
            @if(growtype_get_footer_type() === 'type-1')
                @include('partials.sections.footer.type-1')
            @elseif(growtype_get_footer_type() === 'type-2')
                @include('partials.sections.footer.type-2')
            @elseif(growtype_get_footer_type() === 'type-3')
                @include('partials.sections.footer.type-3')
            @endif
        </div>
    </footer>
@endif
