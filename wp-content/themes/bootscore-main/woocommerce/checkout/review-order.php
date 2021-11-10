<?php

/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined('ABSPATH') || exit;
?>

<table class="table table-borderless align-middle">

    <tbody>

    <?php
    do_action('woocommerce_review_order_before_cart_contents');

    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
        $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);

        if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key)) {
            ?>
            <td class="item-image col-3 position-relative">

                <?php
                $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);
                $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);

                if (!$product_permalink) {
                    echo $thumbnail; // PHPCS: XSS ok.
                } else {
                    printf('<a href="%s">%s</a>', esc_url($product_permalink), $thumbnail); // PHPCS: XSS ok.
                }
                ?>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
    <?php echo apply_filters('woocommerce_checkout_cart_item_quantity', ' <strong class="product-quantity">' . $cart_item['quantity'] . '</strong>', $cart_item, $cart_item_key); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    ?>
    <span class="visually-hidden">Cantidad de producto</span>
  </span>
            </td>
            <td colspan="1" class="product-name">
                <?php echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key)) . '&nbsp;'; ?>
                <?php echo wc_get_formatted_cart_item_data($cart_item); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                ?>

            </td>
            <td class="product-thumbnail">
                <?php echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                ?>
            </td>

            <tr class="<?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">


            </tr>
            <?php
        }
    }

    do_action('woocommerce_review_order_after_cart_contents');
    ?>
    </tbody>


    <tfoot>
    <tr>
        <td colspan="3">
            <form class="" method="post" >
                <div class="row g-3 align-items-center">
                    <div class="col-auto">
                        <label for="coupon_code" class="visually-hidden">Email</label>
                    <input type="text" name="coupon_code" class="form-control" id="coupon_code" value="" placeholder="<?php esc_attr_e('Coupon code', 'woocommerce'); ?>"/>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-outline-primary" name="apply_coupon" value="<?php esc_attr_e('Apply coupon', 'woocommerce'); ?>"><?php esc_attr_e('Apply coupon', 'woocommerce'); ?></button>
                    </div>
                    <?php do_action('woocommerce_cart_coupon'); ?>
                </div>
                <div class="clear"></div>

            </form>
        </td>
    </tr>
    <tr class="cart-subtotal">

        <th colspan="2"><?php esc_html_e('Subtotal', 'woocommerce'); ?></th>
        <td><?php wc_cart_totals_subtotal_html(); ?></td>
    </tr>
    <tr class="cart-subtotal">
        <th colspan="2">Envíos</th>
        <td>Calculando en el siguiente paso</td>
    </tr>
    <tr class="order-total">
        <th colspan="3"><hr class="solid"></th>

    </tr>

    <?php foreach (WC()->cart->get_coupons() as $code => $coupon) : ?>
        <tr class="cart-discount coupon-<?php echo esc_attr(sanitize_title($code)); ?>">
            <th colspan="2"><?php wc_cart_totals_coupon_label($coupon); ?></th>
            <td><?php wc_cart_totals_coupon_html($coupon); ?></td>
        </tr>
    <?php endforeach; ?>

    <?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()) : ?>

        <?php do_action('woocommerce_review_order_before_shipping'); ?>

        <?php wc_cart_totals_shipping_html(); ?>

        <?php do_action('woocommerce_review_order_after_shipping'); ?>

    <?php endif; ?>

    <?php foreach (WC()->cart->get_fees() as $fee) : ?>
        <tr class="fee">
            <th colspan="2"><?php echo esc_html($fee->name); ?></th>
            <td><?php wc_cart_totals_fee_html($fee); ?></td>
        </tr>
    <?php endforeach; ?>

    <?php if (wc_tax_enabled() && !WC()->cart->display_prices_including_tax()) : ?>
        <?php if ('itemized' === get_option('woocommerce_tax_total_display')) : ?>
            <?php foreach (WC()->cart->get_tax_totals() as $code => $tax) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
                ?>
                <tr class="tax-rate tax-rate-<?php echo esc_attr(sanitize_title($code)); ?>">
                    <th colspan="2"><?php echo esc_html($tax->label); ?></th>
                    <td><?php echo wp_kses_post($tax->formatted_amount); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr class="tax-total">
                <th colspan="2" style=" padding-bottom: 5%; "><?php echo esc_html(WC()->countries->tax_or_vat()); ?></th>
                <td style="padding-bottom: 5%;"><?php wc_cart_totals_taxes_total_html(); ?></td>
            </tr>
        <?php endif; ?>
    <?php endif; ?>

    <?php do_action('woocommerce_review_order_before_order_total'); ?>
    <tr class="order-total">
        <th colspan="2" style="padding-top: 3%;"><?php esc_html_e('Total', 'woocommerce'); ?></th>
        <td style="padding-top: 3%;"><?php wc_cart_totals_order_total_html(); ?></td>
    </tr>

    <?php do_action('woocommerce_review_order_after_order_total'); ?>

    </tfoot>
</table>