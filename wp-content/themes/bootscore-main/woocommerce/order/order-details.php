<?php

/**
 * Order details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.6.0
 */

defined( 'ABSPATH' ) || exit;

$order = wc_get_order( $order_id ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited

if ( ! $order ) {
	return;
}

$order_items           = $order->get_items( apply_filters( 'woocommerce_purchase_order_item_types', 'line_item' ) );
$show_purchase_note    = $order->has_status( apply_filters( 'woocommerce_purchase_note_order_statuses', array( 'completed', 'processing' ) ) );
$show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id();
$downloads             = $order->get_downloadable_items();
$show_downloads        = $order->has_downloadable_item() && $order->is_download_permitted();

if ( $show_downloads ) {
	wc_get_template(
		'order/order-downloads.php',
		array(
			'downloads'  => $downloads,
			'show_title' => true,
		)
	);
}
?>
    <style>
        div#page {
            background: url('<?php echo esc_url(get_stylesheet_directory_uri()); ?>/img/checkout-guy.png') no-repeat, linear-gradient( 359.14deg , #E6E7E9 58.35%, rgba(230, 231, 233, 0) 99.21%);
            background-position: right;
        }

        table.rounded.woocommerce-table.woocommerce-table--order-details.shop_table.order_details {
            width: 80%;
        }
        ul.woocommerce-order-overview.woocommerce-thankyou-order-details.order_details.alert.alert-success{
            width: 80%;
        }
        header.entry-header {
        display: none;
        }
            </style>
    <section class="woocommerce-order-details">
		<?php do_action( 'woocommerce_order_details_before_order_table', $order ); ?>

        <table class="rounded woocommerce-table woocommerce-table--order-details shop_table order_details">

            <thead>
            <tr>
                <th class="woocommerce-table__product-name product-name"><?php esc_html_e( 'Producto', 'woocommerce' ); ?></th>
                <th class="woocommerce-table__product-table product-total"><?php esc_html_e( 'Total', 'woocommerce' ); ?></th>
            </tr>
            </thead>

            <tbody>
			<?php
			do_action( 'woocommerce_order_details_before_order_table_items', $order );

			foreach ( $order_items as $item_id => $item ) {
				$product = $item->get_product();

				wc_get_template(
					'order/order-details-item.php',
					array(
						'order'              => $order,
						'item_id'            => $item_id,
						'item'               => $item,
						'show_purchase_note' => $show_purchase_note,
						'purchase_note'      => $product ? $product->get_purchase_note() : '',
						'product'            => $product,
					)
				);
			}

			do_action( 'woocommerce_order_details_after_order_table_items', $order );
			?>
            </tbody>

            <tfoot>
			<?php
			foreach ( $order->get_order_item_totals() as $key => $total ) {
				?>
                <tr>
                    <th scope="row"><?php echo esc_html( $total['label'] ); ?></th>
                    <td><?php echo ( $total['value'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						?></td>
                </tr>
				<?php
			}
			?>
            </tfoot>
        </table>

    </section>

<a href="<?php echo esc_url(wc_get_page_permalink( 'shop' )) ?>" class="btn btn-primary"> <i class="fas fa-shopping-cart"></i>  Volver a la tienda</a>