<?php

/**
 * Growtype auction methods
 * Requires woocommerce-simple-auction plugin
 */
class Growtype_Auction
{
    const KEY_AUCTION_BID_VALUE_PER_UNIT = 'auction_bid_value_per_unit';
    const META_KEY_AUCTION_BID_VALUE_PER_UNIT = '_auction_bid_value_per_unit';

    /**
     * @return string
     * percent
     */
    public static function buyers_premium(): string
    {
        return 0.1;
    }

    /**
     * @return string
     * percent
     */
    public static function buyers_premium_formatted(): string
    {
        return self::buyers_premium() * 100 . '%';
    }

    /**
     * @return bool
     */
    public static function has_started(): bool
    {
        global $product;

        if ($product->is_type('auction') && class_exists('WC_Product_Auction')) {
            return $product->is_started();
        }

        return false;
    }

    /**
     * @return bool
     */
    public static function has_closed(): bool
    {
        global $product;

        if ($product->is_type('auction') && class_exists('WC_Product_Auction')) {
            return $product->is_closed();
        }

        return false;
    }

    /**
     * @return object
     */
    public static function duration(): object
    {
        global $product;

        if ($product->is_type('auction') && class_exists('WC_Product_Auction')) {
            $start_time = date_create($product->get_auction_start_time());
            $end_time = date_create($product->get_auction_end_time());

            return date_diff($start_time, $end_time);
        }

        return (object)[];
    }

    /**
     * @return object
     */
    public static function duration_formatted($format = ''): string
    {
        global $product;

        if ((array)self::duration()) {
            $duration_formatted = '';

            if (self::duration_in_days_formatted()) {
                $duration_formatted .= self::duration_in_days_formatted();
            }

            if (self::duration_in_hours_formatted()) {
                if (!empty($duration_formatted)) {
                    $duration_formatted .= ' ' . self::duration_in_hours_formatted();
                } else {
                    $duration_formatted .= self::duration_in_hours_formatted();
                }
            }

            return $duration_formatted;
        }

        return '';
    }

    /**
     * @return int
     */
    public static function duration_in_days(): int
    {
        $days = 0;

        if ((array)self::duration()) {
            $days = !empty((array)self::duration()) ? (int)self::duration()->format('%r%a') : 0;
        }

        return $days;
    }

    /**
     * @return string
     */
    public static function duration_in_days_formatted(): string
    {
        $days = '';

        if (!empty(self::duration_in_days())) {
            $days_amount = self::duration_in_days();
            $days = $days_amount === 1 ? $days_amount . ' ' . __('day', 'growtype') : $days_amount . ' ' . __('days', 'growtype');
        }

        return $days;
    }

    /**
     * @return int
     */
    public static function duration_in_hours(): int
    {
        $days = 0;

        if ((array)self::duration()) {
            $days = !empty((array)self::duration()) ? (int)self::duration()->format('%r%H') : 0;
        }

        return $days;
    }

    /**
     * @return string
     */
    public static function duration_in_hours_formatted(): string
    {
        $hours = '';

        if (!empty(self::duration_in_hours())) {
            $hours_amount = self::duration_in_hours();
            $hours = $hours_amount === 1 ? $hours_amount . ' ' . __('hour', 'growtype') : $hours_amount . ' ' . __('hours', 'growtype');
        }

        return $hours;
    }

    /**
     * @return string
     */
    public static function time_remaining(): string
    {
        global $product;

        if ($product->is_type('auction') && class_exists('WC_Product_Auction')) {
            if ($product->get_seconds_remaining() > 0) {
                return '<div class="auction-time-countdown" data-time="' . $product->get_seconds_remaining() . '" data-auctionid="' . $product->get_id() . '" data-format="' . get_option('simple_auctions_countdown_format') . '"></div>';
            } else {
                return '-';
            }
        }

        return '';
    }

    /**
     * @return string
     */
    public static function time_to_auction(): string
    {
        global $product;

        if ($product->is_type('auction') && class_exists('WC_Product_Auction')) {
            return '<div class="auction-time-countdown" data-time="' . $product->get_seconds_to_auction() . '" data-auctionid="' . $product->get_id() . '" data-format="' . get_option('simple_auctions_countdown_format') . '"></div>';
        }

        return '';
    }

    /**
     * @return string
     */
    public static function start_price(): string
    {
        global $product;

        if ($product->is_type('auction') && class_exists('WC_Product_Auction')) {
            return $product->get_auction_start_price();
        }

        return '';
    }

    /**
     * @return string
     */
    public static function start_price_formatted(): string
    {
        return wc_price(self::start_price());
    }

    /**
     * @return string
     */
    public static function buy_now_price(): string
    {
        global $product;

        if ($product->is_type('auction') && class_exists('WC_Product_Auction')) {
            return $product->get_price();
        }

        return '';
    }

    /**
     * @return string
     */
    public static function buy_now_price_formatted(): string
    {
        return empty(self::buy_now_price()) ? '-' : wc_price(self::buy_now_price());
    }

    /**
     * @return string
     */
    public static function bid_value(): string
    {
        global $product;

        if ($product->is_type('auction') && class_exists('WC_Product_Auction')) {
            return $product->bid_value();
        }

        return '';
    }

    /**
     * @return string
     */
    public static function bid_value_formatted(): string
    {
        return wc_price(self::bid_value());
    }

    /**
     * @return float|int
     */
    public static function price_per_unit()
    {
        global $product;

        if (!empty(Growtype_Product::amount_in_units())) {
            if ($product->is_type('auction') && class_exists('WC_Product_Auction')) {
                return round(self::bid_value() / Growtype_Product::amount_in_units(), 2);
            }
        }

        return 0;
    }

    /**
     * @return string
     */
    public static function price_per_unit_formatted(): string
    {
        return wc_price(self::price_per_unit());
    }

    /**
     * @return float|int
     */
    public static function price_per_unit_buy_now()
    {
        global $product;

        if (!empty(Growtype_Product::amount_in_units()) && !empty(self::buy_now_price()) && $product->is_type('auction') && class_exists('WC_Product_Auction')) {
            return round(self::buy_now_price() / Growtype_Product::amount_in_units(), 2);
        }

        return 0;
    }

    /**
     * @return string
     */
    public static function price_per_unit_buy_now_formatted(): string
    {
        if (!empty(self::price_per_unit_buy_now())) {
            return wc_price(self::price_per_unit_buy_now());
        }

        return '';
    }

    /**
     * @return float|int
     */
    public static function price_per_unit_from_bid($bid, $product_id = null)
    {
        global $product;

        $product_id = !empty($product_id) ? $product_id : $product->get_id();

        return $bid / Growtype_Product::amount_in_units($product_id);
    }

    /**
     * @return float|int
     */
    public static function bid_increase_value()
    {
        global $product;

        if (!empty(Growtype_Product::amount_in_units())) {
            return $product->get_increase_bid_value();
        }

        return 0;
    }

    /**
     * @return string
     */
    public static function current_bid(): string
    {
        global $product;

        if ($product->is_type('auction') && class_exists('WC_Product_Auction')) {
            return $product->get_curent_bid();
        }

        return '';
    }

    /**
     * @return string
     */
    public static function current_bid_formatted(): string
    {
        return wc_price(self::current_bid());
    }

    /**
     * @return string
     */
    public static function next_bid_value(): string
    {
        global $product;

        $product_id = !empty($product_id) ? $product_id : $product->get_id();

        $latest_bid = Growtype_Auction::current_bid();

        $price_per_unit = self::price_per_unit_from_bid($latest_bid, $product_id);

        $next_price_per_unit = $price_per_unit + self::bid_increase_value();

        return $next_price_per_unit * Growtype_Product::amount_in_units();
    }

    /**
     * @return string
     */
    public static function current_bid_with_buyers_premium(): string
    {
        return self::current_bid() + (self::current_bid() * self::buyers_premium());
    }

    /**
     * @return string
     */
    public static function current_bid_with_buyers_premium_formatted(): string
    {
        return wc_price(self::current_bid_with_buyers_premium());
    }

    /**
     * @return string
     */
    public static function buy_now_with_buyers_premium(): string
    {
        if (!empty(self::buy_now_price())) {
            return self::buy_now_price() + (self::buy_now_price() * self::buyers_premium());
        }

        return '';
    }

    /**
     * @return string
     */
    public static function buy_now_with_buyers_premium_formatted(): string
    {
        return !empty(self::buy_now_with_buyers_premium()) ? wc_price(self::buy_now_with_buyers_premium()) : '-';
    }

    /**
     * @return string
     */
    public static function status_badge(): string
    {
        global $product;

        $output = '';

        if ($product->is_type('auction') && class_exists('WC_Product_Auction')) {
            if (self::has_started() && !self::has_closed()) {
                $output .= '<div class="badge bg-info" data-status="live">' . __('Live', 'growtype-child') . '</div>';
            } elseif (self::has_closed()) {
                $output .= '<div class="badge bg-warning" data-status="live">' . __('Ended', 'growtype-child') . '</div>';
            } else {
                $output .= '<div class="badge bg-success" data-status="live">' . __('Upcoming', 'growtype-child') . '</div>';
            }
        }

        return $output;
    }

    /**
     * @return string
     */
    public static function details_time_block(): string
    {
        global $product;

        ob_start();
        ?>

        <div class="auction-details-time">
            <?php
            if (self::has_started()) { ?>
                <div class="b-time">
                    <?= __('Time left until end:', 'growtype-child') ?>
                    <?= self::time_remaining() ?>
                </div>
            <?php } else { ?>
                <div class="b-time">
                    <?= __('Auction starts in:', 'growtype-child') ?>
                    <?= self::time_to_auction() ?>
                </div>
            <?php } ?>
            <div>
                <span><?= __('Auction duration:', 'growtype-child') ?></span>
                <span><?= self::duration_in_days_formatted() ?></span>
            </div>
        </div>

        <?php

        return ob_get_clean();
    }

    /**
     * @return void
     */
    public static function bids_amount()
    {
        global $product;

        return $product->get_auction_bid_count();
    }

    /**
     * @return string
     */
    public static function rules_formatted()
    {
        return \App\template('plugins.woocommerce-simple-auctions.rules');
    }
}
