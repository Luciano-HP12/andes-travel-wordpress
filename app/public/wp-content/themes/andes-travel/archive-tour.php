<?php

/**
 * Template for displaying the tour archive.
 *
 * @package AndesTravel
 */

get_header();
?>

<main class="site-main">

    <section class="tour-archive">

        <div class="tour-archive__container">

            <header class="tour-archive__header">

                <p class="tour-archive__eyebrow">
                    Explora el Perú
                </p>

                <h1 class="tour-archive__title">
                    Nuestros tours
                </h1>

                <p class="tour-archive__description">
                    Descubre experiencias diseñadas para conocer
                    algunos de los destinos más increíbles del Perú.
                </p>

            </header>

            <?php if (have_posts()) : ?>

                            <div class="tour-grid">

                                <?php
                                while (have_posts()) :
                                    the_post();

                                    get_template_part(
                                        'template-parts/tour',
                                        'card'
                                    );

                                endwhile;
                                ?>

                            </div>

            <?php else : ?>

                <p>No hay tours disponibles actualmente.</p>

            <?php endif; ?>

        </div>

    </section>

</main>

<?php
get_footer();