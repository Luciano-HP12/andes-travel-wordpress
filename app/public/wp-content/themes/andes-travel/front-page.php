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
                <img
                    class="hero__background"
                    src="<?php echo esc_url(
                        get_template_directory_uri()
                        . '/assets/images/hero-home.jpg'
                    ); ?>"
                    alt=""
                    width="736"
                    height="485"
                    fetchpriority="high"
                >

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

            <section class="featured-tours">

                <div class="featured-tours__container">

                    <header class="featured-tours__header">

                        <div>

                            <p class="featured-tours__eyebrow">
                                Experiencias
                            </p>

                            <h2 class="featured-tours__title">
                                Tours destacados
                            </h2>

                        </div>

                        <a
                            class="featured-tours__all"
                            href="<?php echo esc_url(
                                get_post_type_archive_link('tour')
                            ); ?>"
                        >
                            Ver todos los tours
                        </a>

                    </header>

                    <?php
                    $featured_tours = new WP_Query(
                        array(
                            'post_type'      => 'tour',
                            'post_status'    => 'publish',
                            'posts_per_page' => 3,

                            'meta_query' => array(
                                array(
                                    'key'     => '_andes_travel_featured',
                                    'value'   => '1',
                                    'compare' => '=',
                                ),
                            ),
                        )
                    );
                    ?>

                    <?php if ($featured_tours->have_posts()) : ?>

                        <div class="tour-grid">

                            <?php
                            while ($featured_tours->have_posts()) :
                                $featured_tours->the_post();

                                get_template_part(
                                    'template-parts/tour',
                                    'card'
                                );

                            endwhile;
                            ?>

                        </div>

                        <?php wp_reset_postdata(); ?>

                    <?php else : ?>

                        <p>No hay tours disponibles actualmente.</p>

                    <?php endif; ?>

                </div>

            </section>

        <?php
        endwhile;

    endif;
    ?>

</main>

<?php
get_footer();