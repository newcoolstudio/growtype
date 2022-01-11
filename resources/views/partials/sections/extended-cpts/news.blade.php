@php
  $args = array(
    'posts_per_page' => -1,
    'offset' => 0,
    'category' => '',
    'category_name' => '',
    'orderby' => 'menu_order',
    'order' => 'DESC',
    'include' => '',
    'exclude' => '',
    'post_type' => 'news',
    'post_status' => 'publish',
    'suppress_filters' => true
  );
  $posts_array = get_posts($args);
@endphp

@if(!empty($posts_array))

  <div class="section container">
    <div class="b-posts--wrapper">
      @foreach ($posts_array as $singlePost)
        @include('partials.content.post.preview.arrow')
      @endforeach
    </div>
  </div>

@endif


