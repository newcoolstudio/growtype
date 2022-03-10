<div class="general-404">
    <div class="img-wrapper">
        <img src="{!! get_parent_template_public_path() .'/images/404/content.png' !!}" alt="" class="img-fluid">
    </div>
    <p class="e-title">{!! $title ?? __('No content found','growtype') !!}</p>
    <p>{!! $subtitle ?? __('Unfortunately no content was found.','growtype') !!}</p>
    @if(isset($cta) && !empty($cta))
        {!! $cta !!}
    @endif
</div>
