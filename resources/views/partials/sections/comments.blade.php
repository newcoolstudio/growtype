@if(!get_option('comments_fully_disabled'))
    <section class="s-comments mb-5">
        @php
            if (post_password_required()) {
              return;
            }
        @endphp

        @if (have_comments())
            <div class="comments-area">
                <div class="block-title">
                    <h3 class="comments-title">
                            <?php
                            $comment_count = get_comments_number();
                            if (1 === $comment_count) {
                                esc_html_e('One Comment', 'growtype');
                            } else {
                                printf( // WPCS: XSS OK.
                                // translators: 1: comment count number, 2: title.
                                    esc_html(_nx('%1$s Comment', '%1$s Comments', $comment_count, 'comments title',
                                        'growtype')),
                                    number_format_i18n($comment_count)
                                );
                            }
                            ?>
                    </h3>
                </div>

                <div class="comment-list">
                        <?php
                        wp_list_comments(
                            array (
                                'style' => 'div',
                                'short_ping' => true,
                                'avatar_size' => 50,
                            )
                        );
                        ?>
                </div><!-- .comment-list -->

                @if (get_comment_pages_count() > 1 && get_option('page_comments'))
                    <nav>
                        <ul class="pager">
                            @if (get_previous_comments_link())
                                <li class="previous">@php previous_comments_link(__('&larr; Older comments', 'growtype')) @endphp</li>
                            @endif
                            @if (get_next_comments_link())
                                <li class="next">@php next_comments_link(__('Newer comments &rarr;', 'growtype')) @endphp</li>
                            @endif
                        </ul>
                    </nav>
                @endif
            </div>
        @endif

        @if (!comments_open() && get_comments_number() != '0' && post_type_supports(get_post_type(), 'comments'))
            <div class="alert alert-warning">
                {{ __('Comments are closed.', 'growtype') }}
            </div>
        @endif

        @php comment_form(
		array(
			'id_form'            => 'comment-form',
			'title_reply_before' => '<div class="block-title"><h3 id="reply-title" class="comment-reply-title">',
			'title_reply_after'  => '</h3></div>',
		)
	); @endphp
    </section>
@endif

