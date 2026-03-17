<?php

class Growtype_Modal
{
    public function __construct()
    {
        add_action('wp_ajax_growtype_get_modal', [$this, 'growtype_get_modal_callback']);
        add_action('wp_ajax_nopriv_growtype_get_modal', [$this, 'growtype_get_modal_callback']);
    }

    public function growtype_get_modal_callback()
    {
        $modal_id = $_POST['modal_id'] ?? '';

        if (empty($modal_id)) {
            wp_send_json_error(['message' => 'missing_modal_id']);
        }

        $modal_id = ltrim($modal_id, '#');

        $modal_map = apply_filters('growtype_modal_map', []);

        $view_path = $modal_map[$modal_id] ?? null;

        if (!$view_path) {
            wp_send_json_error([
                'message' => 'invalid_modal_id',
                'modal_id' => $modal_id
            ]);
        }

        $modal_html = '';

        if (function_exists('App\\template')) {
            try {
                $modal_html = \App\template($view_path, apply_filters('growtype_modal_params', $_POST, $modal_id));
            }
            catch (\Exception $e) {
                wp_send_json_error(['message' => $e->getMessage()]);
            }
        }

        if (empty($modal_html)) {
            wp_send_json_error(['message' => 'modal_not_found']);
        }

        wp_send_json_success([
            'modal' => $modal_html
        ]);
    }
}
