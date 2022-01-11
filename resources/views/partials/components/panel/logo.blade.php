<div class="panel-logo-wrapper">
    @if(!empty(get_panel_logo()['url']))
        <a id="panel_logo" href="<?php echo get_home_url_custom() ?>" class="mainlogo">
            <img class="img-fluid" src="{{get_panel_logo()['url']}}" alt="panel_logo">
        </a>
    @endif
</div>
