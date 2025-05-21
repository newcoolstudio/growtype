<?php

class Growtype_Admin_Theme_Settings_Block_Patterns_Manager
{

    public function __construct()
    {
        add_action('admin_menu', [$this, 'add_block_patterns_manager']);
    }

    public function add_block_patterns_manager()
    {
        add_submenu_page(
            'growtype-theme-settings', // Parent menu slug
            __('Block Patterns Manager', 'growtype'),
            __('Block Patterns Manager', 'growtype'),
            'manage_options', // Capability
            'growtype-block-patterns-manager', // Menu slug
            [$this, 'render_block_patterns_page'], // Callback function
            60 // Position
        );
    }

    public function render_block_patterns_page()
    {
        echo '<div class="wrap">';
        echo '<h1>' . esc_html__('Block Patterns Manager', 'growtype') . '</h1>';

        // Fetch patterns with pagination
        $paged = isset($_GET['paged']) ? max(1, intval($_GET['paged'])) : 1;
        $patterns = $this->get_patterns($paged);

        if (!empty($patterns)) {
            $this->render_patterns_table($patterns, $paged);
        } else {
            echo '<p>' . esc_html__('No patterns found.', 'growtype') . '</p>';
        }

        echo '</div>';
    }

    private function get_patterns($paged = 1, $per_page = 10)
    {
        $query = new WP_Query([
            'post_type' => 'wp_block',
            'post_status' => 'publish',
            'posts_per_page' => $per_page,
            'paged' => $paged,
        ]);

        if ($query->have_posts()) {
            $patterns = [];
            while ($query->have_posts()) {
                $query->the_post();
                $patterns[] = [
                    'id' => get_the_ID(),
                    'title' => get_the_title(),
                    'content' => get_the_content(),
                    'edit_post_url' => admin_url('post.php?post=' . get_the_ID() . '&action=edit'),
                    'edit_canvas_url' => admin_url('site-editor.php?postType=wp_block&postId=' . get_the_ID() . '&canvas=edit'),
                ];
            }
            wp_reset_postdata();
            return $patterns;
        }

        return [];
    }

    private function render_patterns_table($patterns, $paged)
    {
        echo '<table class="wp-list-table widefat fixed striped">';
        echo '<thead>
            <tr>
                <th>' . esc_html__('Title', 'growtype') . '</th>
                <th>' . esc_html__('Preview', 'growtype') . '</th>
                <th>' . esc_html__('Actions', 'growtype') . '</th>
            </tr>
        </thead>';
        echo '<tbody>';

        foreach ($patterns as $pattern) {
            echo '<tr>';
            echo '<td>' . esc_html($pattern['title']) . '</td>';
            echo '<td>
                <div class="block-pattern-preview" style="position:relative;border: 1px solid #ddd; padding: 10px; background: #f9f9f9; overflow: auto;max-height: 300px;">
                    ' . apply_filters('the_content', $pattern['content']) . '
                </div>
            </td>';
            echo '<td>
                <a href="' . esc_url($pattern['edit_post_url']) . '" class="button button-primary">' . esc_html__('Edit Post', 'growtype') . '</a>
                <a href="' . esc_url($pattern['edit_canvas_url']) . '" class="button button-primary">' . esc_html__('Edit Canvas', 'growtype') . '</a>
                <a href="' . esc_url(add_query_arg(['action' => 'delete', 'pattern_id' => $pattern['id']], admin_url('admin-post.php'))) . '" 
                    class="button button-secondary">' . esc_html__('Delete', 'growtype') . '</a>
            </td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';

        $this->render_pagination($paged);
    }

    private function render_pagination($paged, $per_page = 10)
    {
        $total = wp_count_posts('wp_block')->publish;
        $total_pages = ceil($total / $per_page);

        if ($total_pages > 1) {
            $base_url = admin_url('admin.php?page=growtype-block-patterns-manager');
            $current_url = add_query_arg('paged', '%#%', $base_url);

            echo '<div class="tablenav bottom">';
            echo paginate_links([
                'base' => $current_url,
                'format' => '',
                'current' => $paged,
                'total' => $total_pages,
                'prev_text' => __('« Previous', 'growtype'),
                'next_text' => __('Next »', 'growtype'),
            ]);
            echo '</div>';
        }
    }
}
