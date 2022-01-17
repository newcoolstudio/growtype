<?php

/**
 * Growtype auction methods
 * Requires woocommerce-simple-auction plugin
 */
class Growtype_Auction
{
    /**
     * @return array|mixed|string
     */
    public static function has_started()
    {
        global $product;

        return $product->get_meta('_auction_has_started');
    }

    /**
     * @return false|DateInterval|null
     */
    public static function auction_duration()
    {
        global $product;

        if ($product->is_type('auction') && class_exists('WC_Product_Auction')) {
            $start_time = date_create($product->get_auction_start_time());
            $end_time = date_create($product->get_auction_end_time());

            return date_diff($start_time, $end_time);
        }

        return null;
    }

    /**
     * @return string
     */
    public static function duration_in_days()
    {
        if (self::auction_duration()) {
            return self::auction_duration()->format('%r%a');
        }

        return null;
    }

    /**
     * @return void
     */
    public static function time_remaining()
    {
        global $product;

        if ($product->is_type('auction') && class_exists('WC_Product_Auction')) {
            return '<div class="auction-time-countdown" data-time="' . $product->get_seconds_remaining() . '" data-auctionid="' . $product->get_id() . '" data-format="' . get_option('simple_auctions_countdown_format') . '"></div>';
        }

        return null;
    }

    /**
     * @return void
     */
    public static function time_to_auction()
    {
        global $product;

        if ($product->is_type('auction') && class_exists('WC_Product_Auction')) {
            return $product->get_seconds_to_auction();
        }

        return null;
    }
}
