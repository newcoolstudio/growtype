@if(!empty(get_panel_logo()['url']))
    <div class="panel-logo-wrapper">
        <a id="panel_logo" href="<?php echo get_home_url_custom() ?>" class="mainlogo">
            <img class="img-fluid" src="{{get_panel_logo()['url']}}" alt="panel_logo">
        </a>
    </div>
@endif
