<?php

/**
 * Growtype post methods
 */
class Growtype_Post
{
    /**
     * @return string
     */
    public static function title()
    {
        if (class_exists('woocommerce') && is_shop()) {
            return woocommerce_page_title(false);
        }

        return get_the_title();
    }

    /**
     * @return string
     */
    public static function title_formatted()
    {
        return "<h2 class='page-title'>" . self::title() . "</h2>";
    }

    /**
     * @return string
     */
    public static function title_render()
    {
        $header_page_title_enabled = get_theme_mod('header_page_title_enabled');

        if ($header_page_title_enabled) {
            $header_page_title_pages = get_theme_mod('header_page_title_pages');

            if (page_is_among_enabled_pages($header_page_title_pages)) {
                return self::title_formatted();
            }
        }

        return '';
    }

    /**
     * @param $post
     * @return int|null
     */
    public static function ID($post)
    {
        $post_id = $post->ID ?? null;

        if (empty($post_id)) {
            $post_name = $post->post_name ?? null;
            $post = get_page_by_path($post_name);
            $post_id = $post->ID ?? null;
        }

        return $post_id;
    }

    /**
     * @return bool
     */
    public static function is_front()
    {
        return get_option('page_on_front') == self::ID(get_post());
    }

    /**
     * @param $limit
     * @param $single_post_id
     * @param $post_type
     * @return int[]|WP_Post[]
     */
    public static function ordered_by_start_time($limit = -1, $single_post_id = null, $post_type = 'activity')
    {
        $args = array (
            'post_type' => $post_type,
            'post_status' => 'publish',
            'posts_per_page' => $limit,
            'orderby' => 'end_date',
            'order' => 'ASC',
            'meta_query' => array (
                'relation' => 'OR',
                array (
                    'key' => 'start_date',
                    'value' => date('Y-m-d H:i:s'),
                    'compare' => '>'
                ),
                array (
                    'key' => 'end_date',
                    'value' => date('Y-m-d H:i:s'),
                    'compare' => '>'
                ),
            )
        );

        $first_tag = null;
        if (!empty($single_post_id)) {
            $first_tag = !empty(wp_get_post_tags(get_the_id())) ? wp_get_post_tags(get_the_id())[0]->term_id : '';
            $args['post__not_in'] = array ($single_post_id);
        }

        if (!empty($first_tag)) {
            $args['tag__in'] = array ($first_tag);
        }

        $the_query = new WP_Query($args);
        $valid_posts = $the_query->get_posts();
        $posts_available = $valid_posts;

        if ($limit === -1) {
            $extra_posts = true;
        } else {
            $extra_posts = count($valid_posts) < $limit;
        }

        if ($extra_posts) {

            $post_not_in = array_pluck($valid_posts, 'ID');

            if (!empty($single_post_id)) {
                $post_not_in = array_merge($post_not_in, [$single_post_id]);
            }

            $args = array (
                'post_type' => $post_type,
                'post__not_in' => $post_not_in,
                'post_status' => 'publish',
                'posts_per_page' => $limit,
                'orderby' => 'start_date',
                'order' => 'DESC',
                'meta_query' => array (
                    array (
                        'key' => 'start_date',
                    ),
                )
            );

            if (!empty($first_tag)) {
                $args['tag__in'] = array ($first_tag);
            }

            $the_query = new WP_Query($args);
            $expired_posts = $the_query->get_posts();

            $posts_available = array_merge($valid_posts, $expired_posts);
        }

        if ($limit !== -1) {
            $posts_available = array_slice($posts_available, 0, $limit);
        }

        return $posts_available;
    }

    /**
     * @param $initial_content
     * @param int $length
     * @return string
     */
    public static function content($postId)
    {
        $content_post = get_post($postId);
        $content = $content_post->post_content;
        $content = apply_filters('the_content', $content);
        $content = str_replace(']]>', ']]&gt;', $content);

        return $content;
    }

    /**
     * @param $initial_content
     * @param int $length
     * @return string
     */
    public static function content_limited($initial_content, $length = 125)
    {
        $content = $initial_content;
        $content = strip_shortcodes($content);
        $content = strip_tags($content);
        $content = substr($content, 0, $length);
        $content = substr($content, 0, strripos($content, " "));
        $content = trim(preg_replace('/\s+/', ' ', $content));
        $content = $content . '...';

        return $content;
    }

    /**
     * @param $post
     * @return string
     */
    public static function reading_time($post)
    {
        if (!isset($post->ID)) {
            return false;
        }

        $content = get_post_field('post_content', $post->ID);
        $word_count = str_word_count(strip_tags($content));
        $reading_time = ceil($word_count / 200);

        if ($reading_time == 1) {
            $timer = " min";
        } else {
            $timer = " min";
        }

        return $reading_time . $timer . ' ' . __('read', 'growtype');
    }

    /**
     * @param null $custom_query
     */
    public static function pagination($custom_query = null)
    {
        if (empty($custom_query)) {
            global $wp_query;
            $custom_query = $wp_query;
        }

        $total_pages = $custom_query->max_num_pages;
        $big = 999999999;

        if ($total_pages > 1) {
            $current_page = max(1, get_query_var('paged'));

            echo paginate_links(array (
                'prev_text' => '<span class="dashicons dashicons-arrow-left-alt"></span>',
                'next_text' => '<span class="dashicons dashicons-arrow-right-alt"></span>',
                'type' => 'list',
                'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                'format' => '?page=%#%',
                'current' => $current_page,
                'total' => $total_pages,
            ));
        }
    }
}
