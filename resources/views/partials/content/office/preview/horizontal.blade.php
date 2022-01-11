<div class="b-office b-office-horizontal">
    <p class="e-title">{{$post->post_title}}</p>
    <p class="e-content">{!! wpautop( $post->post_content, true ) !!}</p>
</div>
