<?php

/**
 * Growtype post methods
 */
class Growtype_Post
{
    function __construct()
    {
        if (!is_admin()) {
            add_shortcode('posts_growtype', array (&$this, 'posts_growtype_shortcode'));
        }
    }

    /**
     * @param $atts
     * @return string
     * Posts shortcode
     */
    function posts_growtype_shortcode($atts)
    {
        extract(shortcode_atts(array (
            'post_type' => 'post',
            'posts_per_page' => -1,
            'slider' => 'false',
            'preview_style' => 'basic', //arrow, basic, blog
            'id' => 'b-posts',
            'slider_slides_to_show' => '4',
            'post_link' => 'true',
            'category_name' => '',
            'parent_class' => '',
            'pagination' => false,
        ), $atts));

        $args = array (
            'post_type' => $post_type,
            'posts_per_page' => $posts_per_page,
            'post_order' => 'menu_order',
            'order' => 'asc'
        );

        if (!empty($category_name)) {
            $args['category_name'] = $category_name;
        }

        if ($post_type === 'multisite_sites') {
            $current_page = max(1, get_query_var('paged'));
            $offset = $current_page === 1 ? 0 : ($current_page - 1) * $posts_per_page;

            $total_pages = get_sites([
                'number' => 1000,
                'site__not_in' => '1',
            ]);

            $total_pages = round(count($total_pages) / $posts_per_page);

            $posts = get_sites([
                'number' => $posts_per_page === -1 ? 100 : $posts_per_page,
                'site__not_in' => '1',
                'offset' => $offset
            ]);
        } else {
            $the_query = new WP_Query($args);

            $posts_amount = $the_query->post_count;
            $posts = $the_query->get_posts();
        }

        $extra_class = 'b-post-' . $preview_style;

        ob_start();

        if (!empty($posts)) : ?>
            <div <?php echo !empty($id) ? 'id="' . $id . '"' : "" ?> class="b-posts b-posts-growtype <?php echo $parent_class ?> <?php echo $slider === 'true' ? 'b-posts-slider' : '' ?>">
                <?php
                foreach ($posts as $post) {
                    echo App\template('partials.content.post.preview.' . $preview_style, ['post' => $post, 'post_link' => $post_link === 'true' ? true : false, 'extra_class' => $extra_class]);
                }
                ?>
            </div>
        <?php endif;

        /**
         * Pagination
         */
        if ($pagination) {
            ?>
            <div class="pagination">
                <?php
                echo self::pagination($posts, $total_pages ?? null);
                ?>
            </div>
            <?php
        }

        $render = ob_get_clean();

        /**
         * Add js scripts
         */
        if ($slider === 'true') {
            add_action('wp_head', array (&$this, 'posts_growtype_shortcode_scripts_header'), 100);

            if ($posts_amount > $slider_slides_to_show) {
                add_action('wp_footer', function ($arguments) use ($id, $slider_slides_to_show) { ?>
                    <script type="text/javascript">
                        jQuery(document).ready(function () {
                            let slidesToShow = <?php echo $slider_slides_to_show ?>;
                            // if (window.innerWidth < 768) {
                            //     slidesToShow = 1;
                            // }
                            jQuery('#<?php echo $id ?>').slick({
                                infinite: false,
                                slidesToShow: slidesToShow,
                                slidesToScroll: 1,
                                autoplay: false,
                                autoplaySpeed: 2000,
                                arrows: true,
                                dots: false,
                                responsive: [
                                    {
                                        breakpoint: 600,
                                        settings: {
                                            slidesToShow: 1,
                                            slidesToScroll: 1
                                        }
                                    }
                                ]
                            });
                        });
                    </script>
                    <?php
                }, 100);
            }
        }

        return $render;
    }

    /**
     * @return void
     */
    function posts_growtype_shortcode_scripts_header()
    {
        ?>
        <style></style>
        <?php
    }

    /**
     * @return string
     */
    public static function permalink()
    {
        if (class_exists('woocommerce') && is_shop()) {
            return get_permalink(wc_get_page_id('shop'));
        } elseif (is_search()) {
            return home_url('/');
        }

        return get_permalink();
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
    public static function reading_time($post_id)
    {
        if (empty($post_id)) {
            return false;
        }

        $content = get_post_field('post_content', $post_id);
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
