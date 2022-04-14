@if(class_exists('ACF') )

    @php
        $gallery = $gallery ?? get_field('gallery');
    @endphp

    <section class="s-gallery">
        <div class="s-gallery-inner">

            <div class="b-gallery b-gallery-grouped">
                @foreach($gallery as $index => $image)
                    @if($index === 0)
                        <div class="img-wrapper img-full e-image">
                            <a data-fancybox="gallery" class="fancybox img img-inner" href="{{$image['url']}}" rel="{{$image['alt']}}"
                               alt="{{$image['alt']}}" title="{{$image['caption']}}"
                               style="background: url(<?php echo $image['sizes']['medium']; ?>);background-position: center;background-size: cover;">
                                <div class="overlay">
                                    @if (!empty($image['caption']))
                                        <h2>{{$image['caption']}}</h2>
                                    @else
                                        <div class="icon" style="max-width: 50px">
                                            <span class="dashicons dashicons-search"></span>
                                        </div>
                                    @endif
                                </div>
                            </a>
                        </div>
                    @elseif($index > 0 && $index < 5)
                        @if($index === 1)
                            <div class="img-group">
                                @endif
                                @if($index > 0 && $index < 5)
                                    <div class="img-wrapper img-half e-image {!! $index === 4 ? 'img-last' : '' !!}">
                                        <a data-fancybox="gallery" class="fancybox img img-inner" href="{{$image['url']}}" rel="{{$image['alt']}}"
                                           alt="{{$image['alt']}}" title="{{$image['caption']}}"
                                           style="background: url(<?php echo $image['sizes']['medium']; ?>);background-position: center;background-size: cover;">
                                            <div class="overlay">
                                                @if (!empty($image['caption']))
                                                    <h2>{{$image['caption']}}</h2>
                                                @else
                                                    <div class="icon" style="max-width: 50px">
                                                        <span class="dashicons dashicons-search"></span>
                                                    </div>
                                                @endif
                                            </div>
                                        </a>
                                    </div>
                                @endif
                                @if($index === 4)
                            </div>
                        @endif
                    @else
                        <div class="img-wrapper img-half e-image d-none">
                            <a data-fancybox="gallery" class="fancybox img img-inner" href="{{$image['url']}}" rel="{{$image['alt']}}"
                               alt="{{$image['alt']}}" title="{{$image['caption']}}"
                               style="background: url(<?php echo $image['sizes']['medium']; ?>);background-position: center;background-size: cover;">
                                <div class="overlay">
                                    @if (!empty($image['caption']))
                                        <h2>{{$image['caption']}}</h2>
                                    @else
                                        <div class="icon" style="max-width: 50px">
                                            <span class="dashicons dashicons-search"></span>
                                        </div>
                                    @endif
                                </div>
                            </a>
                        </div>
                    @endif
                @endforeach

                @if(count($gallery) > 5)
                    <div class="b-more-photos">
                        <button class="btn btn-primary" onclick='$(".img-last a.fancybox").trigger("click");'>Daugiau
                            nuotraukų
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endif
