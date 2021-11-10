<?php

/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_mini_cart'); ?>

<?php if (!WC()->cart->is_empty()) : ?>

  <div class="woocommerce-mini-cart cart_list product_list_widget <?php echo esc_attr($args['list_class']); ?>">
    <?php
    do_action('woocommerce_before_mini_cart_contents');

    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
      $_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
      $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

      if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key)) {
        $product_name      = apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key);
        $thumbnail         = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);
        $product_price     = apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key);
        $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
    ?>
        <div class="woocommerce-mini-cart-item border-bottom p-3 <?php echo esc_attr(apply_filters('woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key)); ?>">

          <div class="row">

            <div class="item-image col-3">
              <div class="mt-1 border">
                <?php if (empty($product_permalink)) : ?>
                  <?php echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                  ?>
                <?php else : ?>
                  <a href="<?php echo esc_url($product_permalink); ?>">
                    <?php echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                    ?>
                  </a>
                <?php endif; ?>
              </div>
            </div>

            <div class="item-name col-7">
              <?php if (empty($product_permalink)) : ?>
                <?php echo $product_name; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                ?>
              <?php else : ?>
                <strong><a href="<?php echo esc_url($product_permalink); ?>">
                    <?php echo $product_name; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                    ?>
                  </a></strong>
              <?php endif; ?>
              <div class="item-quantity">
                <?php echo wc_get_formatted_cart_item_data($cart_item); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                ?>
                <?php echo apply_filters('woocommerce_widget_cart_item_quantity', '<span class="quantity qty-mincart">' . $product_price . '</span>', $cart_item, $cart_item_key); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                ?>
              </div>
                <td class="product-quantity" data-title="<?php esc_attr_e('Quantity', 'woocommerce'); ?>">
		            <?php
		            if ($_product->is_sold_individually()) {
			            $product_quantity = sprintf('1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key);
		            } else {
			            $product_quantity = woocommerce_quantity_input(
				            array(
					            'input_name'   => "cart[{$cart_item_key}][qty]",
					            'input_value'  => $cart_item['quantity'],
					            'max_value'    => $_product->get_max_purchase_quantity(),
					            'min_value'    => '0',
					            'product_name' => $_product->get_name(),
				            ),
				            $_product,
				            false
			            );
		            }

		            echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item); // PHPCS: XSS ok.
		            ?>
                </td>
            </div>



            <div class="remove col-2 text-end">
              <?php echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                'woocommerce_cart_item_remove_link',
                sprintf(
                  '<a href="%s" class="remove_from_cart_button text-danger aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s"><i class="fas fa-times fa-gray"></i></a>',
                  esc_url(wc_get_cart_remove_url($cart_item_key)),
                  esc_attr__('Remove this item', 'woocommerce'),
                  esc_attr($product_id),
                  esc_attr($cart_item_key),
                  esc_attr($_product->get_sku())
                ),
                $cart_item_key
              );
              ?>
            </div>

          </div>
          <!--row-->

        </div>
    <?php
      }
    }

    do_action('woocommerce_mini_cart_contents');
    ?>
  </div>

  <div class="cart-footer text-center position-absolute bottom-0 bg-cart-gray w-100">

    <div class="container">
        <hr class="solid">
	    <?php do_action('woocommerce_review_order_before_order_total'); ?>
        <div class="row">
            <div class="col" style="padding-bottom: 5%;"><?php esc_html_e('Subtotal', 'woocommerce'); ?></div>
            <div class="col" style="padding-bottom: 5%;"><?php wc_cart_totals_order_total_html(); ?></div>
        </div>
    </div>


    <?php do_action('woocommerce_widget_shopping_cart_before_buttons'); ?>

    <div class="woocommerce-mini-cart__buttons buttons px-4"><?php do_action('woocommerce_widget_shopping_cart_buttons'); ?></div>

    <?php do_action('woocommerce_widget_shopping_cart_after_buttons'); ?>

  </div>

<?php else : ?>

  <p class="woocommerce-mini-cart__empty-message alert alert-info m-3"><?php esc_html_e('No products in the cart.', 'woocommerce'); ?></p>

<?php endif; ?>

<?php do_action('woocommerce_after_mini_cart'); ?>