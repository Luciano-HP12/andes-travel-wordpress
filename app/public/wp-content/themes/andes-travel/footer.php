<?php
/**
 * Footer template.
 *
 * @package AndesTravel
 */
?>

<footer class="site-footer">

    <div class="site-footer__container">

        <div class="site-footer__grid">

            <div class="site-footer__brand">

                <a
                    class="site-footer__logo"
                    href="<?php echo esc_url(home_url('/')); ?>"
                >
                    <?php bloginfo('name'); ?>
                </a>

                <p class="site-footer__description">
                    Descubre experiencias inolvidables en Perú
                    y explora destinos únicos con Andes Travel.
                </p>

            </div>

            <div class="site-footer__column">

                <h2 class="site-footer__title">
                    Explora
                </h2>

                <ul class="site-footer__links">

                    <li>
                        <a href="<?php echo esc_url(
                            get_post_type_archive_link('tour')
                        ); ?>">
                            Tours
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo esc_url(
                            home_url('/destinos/')
                        ); ?>">
                            Destinos
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo esc_url(
                            home_url('/nosotros/')
                        ); ?>">
                            Nosotros
                        </a>
                    </li>

                </ul>

            </div>

            <div class="site-footer__column">

                <h2 class="site-footer__title">
                    Información
                </h2>

                <ul class="site-footer__links">

                    <li>
                        <a href="<?php echo esc_url(
                            home_url('/blog/')
                        ); ?>">
                            Blog
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo esc_url(
                            home_url('/contacto/')
                        ); ?>">
                            Contacto
                        </a>
                    </li>

                </ul>

            </div>

        </div>

        <div class="site-footer__bottom">

            <p>
                &copy;
                <?php echo esc_html(date('Y')); ?>
                <?php bloginfo('name'); ?>.
                Todos los derechos reservados.
            </p>

        </div>

    </div>

</footer>

<?php wp_footer(); ?>

</body>
</html>