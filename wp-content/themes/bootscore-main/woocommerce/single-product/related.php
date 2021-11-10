<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $related_products ) : ?>

	<section class="related products">

		<?php
		$heading = apply_filters( 'woocommerce_product_related_products_heading', __( 'Related products', 'woocommerce' ) );

		if ( $heading ) :
			?>
			<h2><?php echo esc_html( $heading ); ?></h2>
		<?php endif; ?>
		
		<?php woocommerce_product_loop_start(); ?>

			<?php foreach ( $related_products as $related_product ) : ?>

					<?php
					$post_object = get_post( $related_product->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

					wc_get_template_part( 'content', 'product' );
					?>

			<?php endforeach; ?>

		<?php woocommerce_product_loop_end(); ?>

	</section>
    <section id="location" class="container bkg-location mt-5 d-none d-sm-block">

        <div class="row">

            <div class="col-2 col-md-2">
                <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/img/mappin.png" style=" position: absolute; bottom: 2%; ">
            </div>

            <div class="col-10 col-md-4">

                <div class="row pb-5 mt-5">
                    <div class="d-flex">
                        <div class="flex-shrink-0">

                        </div>

                        <div class="flex-grow-1 ms-5">
                            <h4>¿Dónde encontrarnos?</h4>
                            <br>
                            <a href="#" class="btn btn-lg btn-outline-light">Buscar nuestras tiendas</a>
                        </div>
                    </div>
                </div>


            </div>

            <div class="col-12 col-md-6 location-bkg-img" style="background-image: url('<?php echo esc_url(get_stylesheet_directory_uri()); ?>/img/location-guy.png'); background-repeat: no-repeat; background-position: center; background-size: cover;">

            </div>


        </div>

    </section>

    <section id="mobile-location" class="container mt-5 d-block d-sm-none">

        <div class="row">

            <div class="col">

                <div class="card">
                    <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/img/location-guy.png" class="card-img-top" alt="...">
                    <div class="card-body bkg-location">
                        <div class="row">
                            <div class="col-4">
                                <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/img/mappin.png" style=" ">
                            </div>

                            <div class="col-8">
                                <h4 class="text-white">¿Dónde encontrarnos?</h4>
                                <br>
                                <a href="#" class="btn btn-outline-light">Buscar nuestras tiendas</a>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </div>


    </section>
	<?php
endif;



wp_reset_postdata();
