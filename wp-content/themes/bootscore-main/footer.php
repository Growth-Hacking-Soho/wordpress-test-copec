<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Bootscore
 */

?>

<footer>

  <div class="bootscore-footer bg-dark pt-5 pb-3">
    <div class="container">

      <!-- Top Footer Widget -->
      <?php if (is_active_sidebar('top-footer')) : ?>
        <div>
          <?php dynamic_sidebar('top footer'); ?>
        </div>
      <?php endif; ?>

      <div class="row">

        <!-- Footer 1 Widget -->
        <div class="col-md-3 col-lg-3">
            <div>
                <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/img/logo/logo-white.png" width="150" alt="logo" class="">
            </div>
        </div>

          <div class="col-md-3 mt-4 mt-md-1 mb-4 mb-md-1 text-center order-md-last col-lg-3">
              <div class="icons-footer">

                                <span class="fa-stack fa-white" style="vertical-align: top;">
                                    <i class="far fa-circle fa-stack-2x"></i>
                                    <i class="fab fa-instagram fa-stack-1x"></i>
                                </span>

                  <span class="fa-stack fa-white" style="vertical-align: top;">
                                    <i class="far fa-circle fa-stack-2x"></i>
                                    <i class="fab fa-facebook-f fa-stack-1x"></i>
                                </span>
                  <span class="fa-stack fa-white" style="vertical-align: top;">
                                    <i class="far fa-circle fa-stack-2x"></i>
                                    <i class="fab fa-youtube fa-stack-1x"></i>
                                </span>

                  <span class="fa-stack fa-white" style="vertical-align: top;">
                                    <i class="far fa-circle fa-stack-2x"></i>
                                    <i class="fab fa-linkedin-in fa-stack-1x"></i>
                                </span>

                  <span class="fa-stack fa-white" style="vertical-align: top;">
                                    <i class="far fa-circle fa-stack-2x"></i>
                                    <i class="fab fa-twitch fa-stack-1x"></i>
                                </span>

                  <span class="fa-stack fa-white" style="vertical-align: top;">
                                    <i class="far fa-circle fa-stack-2x"></i>
                                    <i class="fab fa-spotify fa-stack-1x"></i>
                                </span>

              </div>
          </div>

        <!-- Footer 2 Widget -->
        <div class="col-md-2 col-lg-2 col-6">
          <?php if (is_active_sidebar('footer-2')) : ?>
            <div>
              <?php dynamic_sidebar('footer-2'); ?>
            </div>
          <?php endif; ?>
        </div>

        <!-- Footer 3 Widget -->
        <div class="col-md-2 col-lg-2 col-6">
          <?php if (is_active_sidebar('footer-3')) : ?>
            <div>
              <?php dynamic_sidebar('footer-3'); ?>
            </div>
          <?php endif; ?>
        </div>

        <!-- Footer 4 Widget -->
        <div class="col-md-2 col-lg-2">
            <div class="contact-footer text-white">
    <p>Copec en Línea<br>
    Teléfono: 600 200 02 02</p>

                <p>Oficinas Generales Copec Chile:<br>
                    Isidora Goyenechea 2915, Las Condes, Santiago - Chile</p>

                <p>Términos y condiciones</p>

            </div>
        </div>
        <!-- Footer Widgets End -->


      </div>

        <!-- Footer 4 Widget -->
        <!-- Footer Widgets End -->

    </div>

      <!-- Bootstrap 5 Nav Walker Footer Menu -->
      <?php
      wp_nav_menu(array(
        'theme_location' => 'footer-menu',
        'container' => false,
        'menu_class' => '',
        'fallback_cb' => '__return_false',
        'items_wrap' => '<ul id="footer-menu" class="nav %2$s">%3$s</ul>',
        'depth' => 1,
        'walker' => new bootstrap_5_wp_nav_menu_walker()
      ));
      ?>
      <!-- Bootstrap 5 Nav Walker Footer Menu End -->

    </div>
  </div>

  <div class="bootscore-info bg-dark text-white py-2 text-center">
    <div class="container">
      <small>&copy;&nbsp;Copyright 2021 Compañía de Petróleos de Chile Copec S. A. Todos los derechos reservados</small>
    </div>
  </div>

</footer>

<div class="top-button position-fixed zi-1020">
  <a href="#to-top" class="btn btn-primary shadow"><i class="fas fa-chevron-up"></i></a>
</div>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>