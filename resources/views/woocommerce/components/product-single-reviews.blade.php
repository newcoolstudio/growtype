<section id="reviews" class="section-reviews">
    <ul class="reviews">
        <?php
        foreach ($reviews as $review) {
        $rating = intval(get_comment_meta($review->comment_ID, 'rating', true));
        $avatar = get_avatar($review, '60');
        $rating = wc_get_rating_html($rating);
        $author = get_comment_author($review);
        ?>

        <li class="review">
            <div class="review-avatar">
                {!! $avatar !!}
            </div>
            <div class="review-author">
                {!! $author !!}
            </div>
            {!! $review->comment_content !!}
        </li>

        <?php } ?>
    </ul>
</section>
