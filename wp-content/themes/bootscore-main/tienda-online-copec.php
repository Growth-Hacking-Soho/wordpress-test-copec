<?php

/**
 * Template Name: Tienda Online Copec
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bootscore
 */

get_header();
?>
    <div id="content" class="site-content py-5 mt-md-5 mt-3">
        <div id="primary" class="content-area mt-md-4">
            <section id="carousel">
                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                    <!--          <div class="carousel-indicators">-->
                    <!--              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>-->
                    <!--          </div>-->
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/img/sliders-tienda/slider-tienda.png" class="d-block w-100" alt="...">
                            <div class="carousel-caption carousel-tienda-copec d-none d-md-block">
                                <h1>Nueva tienda <br>online</h1>
                            </div>
                            <div class="carousel-caption carousel-tienda-copec-mobile d-block d-sm-none">
                                <h1>Nueva tienda <br>online</h1>
                            </div>
                        </div>
                    </div>
                    <!--  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">-->
                    <!--      <span class="carousel-control-prev-icon" aria-hidden="true"></span>-->
                    <!--      <span class="visually-hidden">Previous</span>-->
                    <!--  </button>-->
                    <!--  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">-->
                    <!--      <span class="carousel-control-next-icon" aria-hidden="true"></span>-->
                    <!--      <span class="visually-hidden">Next</span>-->
                    <!--  </button>-->
                </div>
            </section>

            <section id="categories" class="bkg-categories-cope">

                <div class="text-center container text-white pt-3 pb-5">
                    <h2>¿Qué tipo de producto buscas?</h2>

                    <div class="categories-loop mt-3">
                        <div class="owl-carousel owl-wc-categories">
							<?php
							$taxonomy     = 'product_cat';
							$orderby      = 'name';
							$show_count   = 1;      // 1 for yes, 0 for no
							$pad_counts   = 0;      // 1 for yes, 0 for no
							$hierarchical = 1;      // 1 for yes, 0 for no
							$title        = '';
							$empty        = 0;

							$args           = array(
								'taxonomy'     => $taxonomy,
								'orderby'      => $orderby,
								'show_count'   => $show_count,
								'pad_counts'   => $pad_counts,
								'hierarchical' => $hierarchical,
								'title_li'     => $title,
								'hide_empty'   => $empty
							);
							$all_categories = get_categories( $args );
							foreach ( $all_categories as $cat ) {
								if ( $cat->category_parent ) {
									$category_id = $cat->term_id;
									// get the thumbnail id using the queried category term_id
									$thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
									// get the image URL
									$image = wp_get_attachment_url( $thumbnail_id );
									?>
                                    <div class="item mb-3">
                                        <a href="<?php echo get_term_link( $cat->slug, 'product_cat' ) ?>" class="btn btn-lg btn-outline-light btn-outline-light-cat btn-no-round" role="button" data-bs-toggle="button"><?php echo $cat->name; ?></a>
                                    </div>
									<?php
								}
							}
							?>
                        </div>
                    </div>

                </div>

            </section>

            <section id="featured-products" class="bkg-secondary-copec-gray">
                <div class="container">
                    <div class="row pt-5 pb-3">
                        <div class="col-12">
                            <h2 class="text-center text-secondary-copec">Productos destacados</h2>
                        </div>
                    </div>
                    <div class="row">

						<?php
						$args = array(
							'post_type'      => 'product',
							'posts_per_page' => 8,
							'orderby'        => 'rand',
							'tax_query'      => array(
								array(
									'taxonomy' => 'product_visibility',
									'field'    => 'name',
									'terms'    => 'featured',
								),
							),
						);
						$loop = new WP_Query( $args );
						if ( $loop->have_posts() ) {
							while ( $loop->have_posts() ) : $loop->the_post();
								wc_get_template_part( 'content', 'product' );

							endwhile;
						} else {
							echo __( 'No products found' );
						}
						wp_reset_postdata();
						?>

                    </div>

            </section>

            <section id="about-us" class="container">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="row mt-5">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/img/shield.png">
                                </div>

                                <div class="flex-grow-1 ms-5">
                                    <h4>Sobre Mobil™</h4>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas non erat commodo, volutpat massa id, dictum
                                    <br>
                                    <a href="#">Conocer más</a>
                                </div>
                            </div>
                            <hr class="solid mt-5">
                        </div>

                        <div class="row mt-5">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/img/fixhand.png">
                                </div>

                                <div class="flex-grow-1 ms-5">
                                    <h4>Recomendación de Marca</h4>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas non erat commodo, volutpat massa id, dictum
                                    <br>
                                    <a href="#">Conocer más</a>
                                </div>
                            </div>
                            <hr class="solid mt-5">
                        </div>

                        <div class="row mt-5">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/img/fuelcontainer.png">
                                </div>

                                <div class="flex-grow-1 ms-5">
                                    <h4>FAQ´s Lubricantes</h4>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas non erat commodo, volutpat massa id, dictum
                                    <br>
                                    <a href="#">Conocer más</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="card">
                            <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/img/about-us-support.png" class="card-img-top" alt="...">
                            <div class="card-body bkg-card-aboutus" >
                                <h5 class="card-title text-white">¿Necesitas ayuda o asesoría?</h5>
                                <p class="card-text text-white">Si tienes dudas puedes contactarnos a través de nuestro formulario web o llámanos al 600 200 02 02.</p>
                                <a href="#" class="btn btn-lg btn-outline-light">Contáctate con nosotros</a>
                            </div>
                        </div>

                    </div>

            </section>

            <section id="location" class="container bkg-location mt-5 d-none d-sm-block">

                <div class="row">

                    <div class="col-2 col-md-2">
<img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/img/mappin.png" style=" position: absolute; bottom: 13%; ">
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

        </div><!-- #primary -->
    </div><!-- #content -->
<?php
get_footer();
