<?php

/**
 * Growtype post methods
 */
class Growtype_Page
{
    /**
     * @return string
     */
    public static function permalink()
    {
        if (is_search()) {
            return home_url('/');
        }

        return apply_filters('growtype_permalink', get_permalink());
    }

    /**
     * @return string
     */
    public static function title()
    {
        if (class_exists('woocommerce') && is_shop()) {
            if (is_search() && !empty(get_search_query())) {
                $page_title = sprintf(__('Search results: &ldquo;%s&rdquo;', 'woocommerce'), get_search_query());

                if (get_query_var('paged')) {
                    $page_title .= sprintf(__('&nbsp;&ndash; Page %s', 'woocommerce'), get_query_var('paged'));
                }
            } elseif (is_tax()) {
                $page_title = single_term_title('', false);
            } else {
                $shop_page_id = wc_get_page_id('shop');
                $page_title = get_the_title($shop_page_id);
            }

            $page_title = apply_filters('woocommerce_page_title', $page_title);

            return $page_title;
        }

        return get_the_title();
    }

    /**
     * @return string
     */
    public static function title_formatted($text)
    {
        return "<h2 class='page-title'>" . $text . "</h2>";
    }

    /**
     * @return string
     */
    public static function title_render($page_title = '')
    {
        $header_page_title_enabled = get_theme_mod('header_page_title_enabled');

        if ($header_page_title_enabled) {
            $header_page_title_pages = get_theme_mod('header_page_title_pages');

            if (growtype_page_is_among_enabled_pages($header_page_title_pages)) {
                $page_title = self::title_formatted(self::title());
            }
        }

        $page_title = apply_filters('growtype_page_title', $page_title);

        return $page_title;
    }

    /**
     * @return false|mixed|string
     */
    public static function get_url_slug(): string
    {
        global $wp;
        $path = explode('/', $wp->request);

        return end($path);
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
     * @param $initial_content
     * @param int $length
     * @return string
     */
    public static function content($postId)
    {
        $content_post = get_post($postId);

        if (empty($content_post)) {
            return '';
        }

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
        if (empty($initial_content)) {
            return $initial_content;
        }

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
     * @param null $custom_query
     */
    public static function pagination($custom_query = null, $total_pages = null)
    {
        if (empty($custom_query)) {
            global $wp_query;
            $custom_query = $wp_query;
        }

        $total_pages = !empty($total_pages) ? $total_pages : (is_object($custom_query) ? $custom_query->max_num_pages : count($custom_query));
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
