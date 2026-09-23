<?php

/**
 * Template part for displaying a tour card.
 *
 * @package AndesTravel
 */

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
?>

<article <?php post_class('tour-card'); ?>>

    <?php if (has_post_thumbnail()) : ?>

        <a
            class="tour-card__image"
            href="<?php the_permalink(); ?>"
        >
            <?php the_post_thumbnail('large'); ?>
        </a>

    <?php endif; ?>

    <div class="tour-card__content">

        <?php
        if (
            $destinations
            && !is_wp_error($destinations)
        ) :
            ?>

            <div class="tour-card__destinations">

                <?php foreach ($destinations as $destination) : ?>

                    <?php
                    $destination_link = get_term_link($destination);

                    if (is_wp_error($destination_link)) {
                        continue;
                    }
                    ?>

                    <a
                        href="<?php echo esc_url($destination_link); ?>"
                    >
                        <?php echo esc_html($destination->name); ?>
                    </a>

                <?php endforeach; ?>

            </div>

        <?php endif; ?>

        <h2 class="tour-card__title">

            <a href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
            </a>

        </h2>

        <?php if (has_excerpt()) : ?>

            <p class="tour-card__excerpt">
                <?php echo esc_html(get_the_excerpt()); ?>
            </p>

        <?php endif; ?>

        <div class="tour-card__footer">

            <?php if ($duration) : ?>

                <span>
                    <?php echo esc_html($duration); ?>
                </span>

            <?php endif; ?>

            <?php if ($price) : ?>

                <strong>
                    S/ <?php echo esc_html($price); ?>
                </strong>

            <?php endif; ?>

        </div>

        <a
            class="tour-card__link"
            href="<?php the_permalink(); ?>"
        >
            Ver tour
        </a>

    </div>

</article>