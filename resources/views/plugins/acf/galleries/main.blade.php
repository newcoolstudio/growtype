<section class="section s-gallery">
    <div class="container">

        @if (isset($intro_content) && trim(str_replace('&nbsp;','',strip_tags($intro_content))) !== '')
            <div class="b-intro-content">
                {!! $intro_content !!}
            </div>
        @endif

        <div class="s-gallery-inner">
            @if ($images)
                @foreach ($images as $image)
                    <div class="e-image">
                        <a data-fancybox="gallery" class="fancybox img" href="{{$image['url']}}" rel="{{$image['alt']}}"
                           alt="{{$image['alt']}}" title="{{$image['caption']}}"
                           style="background: url(<?php echo $image['sizes']['medium']; ?>);background-position: center;background-size: cover;">
                            @if(isset($image['iframe']) && $image['iframe'])
                                <iframe style="pointer-events: none;" width="100%" height="" src="{!! $image['url'] !!}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
                            @else
                                <div class="overlay">
                                    @if (!empty($image['caption']))
                                        <h2>{{$image['caption']}}</h2>
                                    @else
                                        <div class="icon">
                                            <span class="dashicons dashicons-search"></span>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
