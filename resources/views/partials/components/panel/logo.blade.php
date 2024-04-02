@if(!empty(growtype_get_panel_logo()['url']))
    <div class="panel-logo-wrapper">
        <a id="panel_logo" href="<?php echo growtype_get_home_url() ?>" class="mainlogo">
            <img class="img-fluid" src="{{growtype_get_panel_logo()['url']}}" alt="panel_logo">
        </a>
    </div>
@endif
