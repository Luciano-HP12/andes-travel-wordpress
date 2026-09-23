<?php

/**
 * Template for displaying the Destinos page.
 *
 * @package AndesTravel
 */

get_header();

$destinations = get_terms(
    array(
        'taxonomy'   => 'destination',
        'hide_empty' => true,
    )
);
?>

<main class="site-main">

    <section class="destinations">

        <div class="destinations__container">

            <header class="destinations__header">

                <p class="destinations__eyebrow">
                    Explora el Perú
                </p>

                <h1 class="destinations__title">
                    Nuestros destinos
                </h1>

                <p class="destinations__description">
                    Descubre experiencias únicas en algunos de los
                    destinos más increíbles del Perú.
                </p>

            </header>

            <?php
            if (
                !is_wp_error($destinations)
                && !empty($destinations)
            ) :
                ?>

                <div class="destination-grid">

                    <?php foreach ($destinations as $destination) : ?>

                        <?php
                        $destination_link = get_term_link(
                            $destination
                        );

                        if (is_wp_error($destination_link)) {
                            continue;
                        }
                        ?>

                        <article class="destination-card">

                            <p class="destination-card__eyebrow">
                                Destino
                            </p>

                            <h2 class="destination-card__title">

                                <a
                                    href="<?php echo esc_url(
                                        $destination_link
                                    ); ?>"
                                >
                                    <?php echo esc_html(
                                        $destination->name
                                    ); ?>
                                </a>

                            </h2>

                            <?php if ($destination->description) : ?>

                                <p class="destination-card__description">
                                    <?php
                                    echo esc_html(
                                        $destination->description
                                    );
                                    ?>
                                </p>

                            <?php endif; ?>

                            <p class="destination-card__count">

                                <?php
                                printf(
                                    esc_html(
                                        _n(
                                            '%s tour disponible',
                                            '%s tours disponibles',
                                            $destination->count,
                                            'andes-travel'
                                        )
                                    ),
                                    esc_html(
                                        number_format_i18n(
                                            $destination->count
                                        )
                                    )
                                );
                                ?>

                            </p>

                            <a
                                class="destination-card__link"
                                href="<?php echo esc_url(
                                    $destination_link
                                ); ?>"
                            >
                                Explorar destino
                            </a>

                        </article>

                    <?php endforeach; ?>

                </div>

            <?php else : ?>

                <p>No hay destinos disponibles actualmente.</p>

            <?php endif; ?>

        </div>

    </section>

</main>

<?php
get_footer();