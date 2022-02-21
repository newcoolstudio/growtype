<div class="general-404">
    <div class="img-wrapper">
        <img src="{!! get_parent_template_public_path() .'/images/404/content.png' !!}" alt="" class="img-fluid">
    </div>
    <p class="e-title">{!! __('No content found','growtype') !!}</p>
    <p>{!! __('Unfortunately no content was found.','growtype') !!}</p>
    @if(isset($cta))
        {!! $cta !!}
    @endif
</div>
