<tr>
    <td class="sort"></td>
    <td class="file_name">
        <input type="text" class="input_text" placeholder="<?php esc_attr_e( 'File name', 'growtype' ); ?>" name="_wc_shipping_file_names[]" value="<?php echo esc_attr( $file['name'] ?? '' ); ?>" />
        <input type="hidden" name="_wc_shipping_file_hashes[]" value="<?php echo esc_attr( $key ); ?>" />
    </td>
    <td class="file_url"><input type="text" class="input_text" placeholder="<?php esc_attr_e( 'http://', 'growtype' ); ?>" name="_wc_shipping_file_urls[]" value="<?php echo esc_attr( $file['url'] ?? '' ); ?>" /></td>
    <td class="file_key"><input type="text" class="input_text" placeholder="" name="_wc_shipping_file_keys[]" value="<?php echo esc_attr( $file['key'] ?? '' ); ?>" /></td>
    <td class="file_url_choose" width="1%"><a href="#" class="button upload_file_button" data-choose="<?php esc_attr_e( 'Choose file', 'growtype' ); ?>" data-update="<?php esc_attr_e( 'Insert file URL', 'growtype' ); ?>"><?php echo esc_html__( 'Choose file', 'growtype' ); ?></a></td>
    <td width="1%"><a href="#" class="delete"><?php esc_html_e( 'Delete', 'growtype' ); ?></a></td>
</tr>
