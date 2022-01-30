<div class="options_group">
    <div class="form-field downloadable_files">
        <label><?php esc_html_e('Shipping documents', 'woocommerce'); ?></label>
        <table class="widefat">
            <thead>
            <tr>
                <th class="sort">&nbsp;</th>
                <th><?php esc_html_e('Name', 'woocommerce'); ?><?php echo wc_help_tip(__('This is the name of the download shown to the customer.', 'woocommerce')); ?></th>
                <th colspan="2"><?php esc_html_e('File URL', 'woocommerce'); ?><?php echo wc_help_tip(__('This is the URL or absolute path to the file which customers will get access to. URLs entered here should already be encoded.', 'woocommerce')); ?></th>
                <th>&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $downloadable_files = Growtype_Product::shipping_documents($_GET['post']);
            if ($downloadable_files) {
                foreach ($downloadable_files as $key => $file) {
                    include 'documents-table-row.php';
                }
            }
            ?>
            </tbody>
            <tfoot>
            <tr>
                <th colspan="5">
                    <a href="#" class="button insert" data-row="
							<?php
                    $key = '';
                    $file = array (
                        'file' => '',
                        'name' => '',
                    );
                    ob_start();
                    require 'documents-table-row.php';
                    echo esc_attr(ob_get_clean());
                    ?>">
                        <?php esc_html_e('Add File', 'woocommerce'); ?></a>
                </th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
