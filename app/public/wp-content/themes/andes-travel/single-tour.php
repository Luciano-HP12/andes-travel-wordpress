<?php

/**
 * Template for displaying a single tour.
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

            $price = get_post_meta(
                get_the_ID(),
                '_andes_travel_price',
                true
            );

            $duration = get_post_meta(
                get_the_ID(),
                '_andes_travel_duration',
                true
            );

            $destinations = get_the_terms(
                    get_the_ID(),
                    'destination'
                );

                $destination_names = array();

                if (
                    $destinations
                    && !is_wp_error($destinations)
                ) {
                    $destination_names = wp_list_pluck(
                        $destinations,
                        'name'
                    );
                }
            $is_featured = get_post_meta(
                $post->ID,
                '_andes_travel_featured',
                true
            );

            $difficulty = get_post_meta(
                get_the_ID(),
                '_andes_travel_difficulty',
                true
            );

            $difficulty_labels = array(
                'easy'      => 'Fácil',
                'moderate'  => 'Moderada',
                'difficult' => 'Difícil',
            );

            $difficulty_label = isset(
                $difficulty_labels[$difficulty]
            )
                ? $difficulty_labels[$difficulty]
                : '';
            ?>

            <article <?php post_class('tour-single'); ?>>

                <header class="tour-single__header">

                    <div class="tour-single__container">

                        <p class="tour-single__eyebrow">
                            Experiencia Andes Travel
                        </p>

                        <h1 class="tour-single__title">
                            <?php the_title(); ?>
                        </h1>

                        <?php if (has_excerpt()) : ?>

                            <p class="tour-single__excerpt">
                                <?php echo esc_html(get_the_excerpt()); ?>
                            </p>

                        <?php endif; ?>

                    </div>

                </header>

                <div class="tour-single__container">

                    <?php if (has_post_thumbnail()) : ?>

                        <div class="tour-single__image">
                            <?php the_post_thumbnail('large'); ?>
                        </div>

                    <?php endif; ?>

                    <div class="tour-single__layout">

                        <div class="tour-single__content">

                            <?php the_content(); ?>

                        </div>

                        <aside class="tour-single__details">

                            <h2>Información del tour</h2>

                            <?php if ($destination_names) : ?>

                                <p>
                                    <strong>Destino:</strong>

                                    <?php
                                    echo esc_html(
                                        implode(', ', $destination_names)
                                    );
                                    ?>
                                </p>

                            <?php endif; ?>

                            <?php if ($duration) : ?>
                                <p>
                                    <strong>Duración:</strong>
                                    <?php echo esc_html($duration); ?>
                                </p>
                            <?php endif; ?>

                            <?php if ($difficulty_label) : ?>
                                <p>
                                    <strong>Dificultad:</strong>
                                    <?php echo esc_html($difficulty_label); ?>
                                </p>
                            <?php endif; ?>

                            <?php if ($price) : ?>
                                <p class="tour-single__price">
                                    Desde
                                    <strong>
                                        S/ <?php echo esc_html($price); ?>
                                    </strong>
                                </p>
                            <?php endif; ?>

                            <a
                                class="tour-single__button"
                                href="<?php echo esc_url(home_url('/contacto/')); ?>"
                            >
                                Solicitar información
                            </a>

                        </aside>

                    </div>

                </div>

            </article>

            <?php
        endwhile;

    endif;
    ?>

</main>

<?php
get_footer();