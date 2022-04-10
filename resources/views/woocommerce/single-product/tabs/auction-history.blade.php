<?php
/**
 * Auction history tab
 *
 */

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

global $woocommerce, $post, $product;

$auction_history = apply_filters('woocommerce__auction_history_data', $product->auction_history());

$heading = esc_html(apply_filters('woocommerce_auction_history_heading',
    esc_html__('Auction History', 'wc_simple_auctions')));
$datetimeformat = get_option('date_format') . ' ' . get_option('time_format');
?>

<h2><?php echo $heading; ?></h2>

<?php if(($product->is_closed() === TRUE) and ($product->is_started() === TRUE)) : ?>

<p><?php esc_html_e('Auction has finished', 'wc_simple_auctions') ?></p>

<?php if ($product->get_auction_fail_reason() == '1') {

    esc_html_e('Auction failed because there were no bids', 'wc_simple_auctions');

} elseif ($product->get_auction_fail_reason() == '2') {

    esc_html_e('Auction failed because item did not make it to reserve price', 'wc_simple_auctions');
}

if ( $product->get_auction_closed() == '3' ){ ?>

<p><?php esc_html_e('Product sold for buy now price', 'wc_simple_auctions') ?>:
    <span><?php echo wp_kses(wc_price($product->get_regular_price()), true); ?></span></p>

<?php } elseif ( $product->get_auction_current_bider()){ ?>

<p><?php esc_html_e('Highest bidder was', 'wc_simple_auctions') ?>:
    <span><?php echo apply_filters('woocommerce_simple_auctions_displayname',
            get_userdata($product->get_auction_current_bider())->display_name, $product); ?></span></p>

<?php } ?>

<?php endif; ?>

<table id="auction-history-table-<?php echo esc_attr($product->get_id()); ?>" class="auction-history-table">
    <?php

    if ( !empty($auction_history) ): ?>

    <thead>
    <tr>
        <th><?php esc_html_e('Date', 'wc_simple_auctions') ?></th>
        <th><?php esc_html_e('Bid', 'wc_simple_auctions') ?></th>
    </tr>
    </thead>
    <tbody>
    <?php if ($product->is_sealed()) {

        echo "<tr>";
        echo "<td colspan='4'  class='sealed'>" . esc_html__('This auction is sealed. Upon auction finish auction history and winner will be available to the public.',
                'wc_simple_auctions') . "</td>";
        echo "</tr>";

    } else {

        foreach ($auction_history as $history_value) {
            echo "<tr>";
            echo "<td class='date'>" . mysql2date($datetimeformat, $history_value->date) . "</td>";
            echo "<td class='bid'>" . wc_price($history_value->bid) . "</td>";
            echo "</tr>";
        }
    }?>
    </tbody>

    <?php endif;?>

    <tr class="start">
        <?php

        if ($product->is_started() === TRUE) {

            echo '<td class="date">' . esc_html(mysql2date($datetimeformat,
                    $product->get_auction_start_time())) . '</td>';
            echo '<td colspan="3" class="started">';
            echo apply_filters('auction_history_started_text', esc_html__('Auction started', 'wc_simple_auctions'),
                $product);
            echo '</td>';

        } else {

            echo '<td  class="date">' . esc_html(mysql2date($datetimeformat,
                    $product->get_auction_start_time())) . '</td>';
            echo '<td colspan="3"  class="starting">';
            echo apply_filters('auction_history_starting_text',
                esc_html__('Auction starting', 'wc_simple_auctions'),
                $product);
            echo '</td>';
        }
        ?>
    </tr>
</table>
