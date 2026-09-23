<?php

/**
 * Template for displaying destination archives.
 *
 * @package AndesTravel
 */

get_header();

$current_destination = get_queried_object();
?>

<main class="site-main">

    <section class="destination-archive">

        <div class="destination-archive__container">

            <header class="destination-archive__header">

                <p class="destination-archive__eyebrow">
                    Destino
                </p>

                <h1 class="destination-archive__title">
                    <?php echo esc_html($current_destination->name); ?>
                </h1>

                <?php if (!empty($current_destination->description)) : ?>

                    <div class="destination-archive__description">
                        <?php
                        echo wp_kses_post(
                            wpautop($current_destination->description)
                        );
                        ?>
                    </div>

                <?php else : ?>

                    <p class="destination-archive__description">
                        Descubre nuestros tours disponibles en
                        <?php echo esc_html($current_destination->name); ?>.
                    </p>

                <?php endif; ?>

            </header>

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

    </section>

</main>

<?php
get_footer();