<?php

/**
 * Template for displaying the front page.
 *
 * @package AndesTravel
 */

get_header();
?>

<main class="site-main">

    <?php
    if (have_posts()) :

        while (have_posts()) :
            the_post();
            ?>

            <section class="hero">

                <div class="hero__content">

                    <p class="hero__eyebrow">
                        Descubre el Perú
                    </p>

                    <h1 class="hero__title">
                        Vive experiencias inolvidables
                    </h1>

                    <p class="hero__description">
                        Explora destinos únicos, cultura, aventura y naturaleza
                        con Andes Travel.
                    </p>

                    <a
                        class="hero__button"
                        href="<?php echo esc_url(home_url('/tours/')); ?>"
                    >
                        Explorar tours
                    </a>

                </div>

            </section>

        <?php
        endwhile;

    endif;
    ?>

</main>

<?php
get_footer();