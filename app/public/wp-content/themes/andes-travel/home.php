<?php
/**
 * Template for displaying the blog posts index.
 *
 * @package AndesTravel
 */

get_header();
?>

<main class="blog-page">

    <header class="blog-page__header">

        <div class="blog-page__container">

            <p class="blog-page__eyebrow">
                Blog
            </p>

            <h1 class="blog-page__title">
                Inspírate para tu próxima aventura
            </h1>

            <p class="blog-page__intro">
                Descubre consejos, destinos y recomendaciones
                para planificar tu próxima experiencia por Perú.
            </p>

        </div>

    </header>

    <section class="blog-page__content">

        <div class="blog-page__container">

            <?php if (have_posts()) : ?>

                <div class="blog-grid">

                    <?php
                    while (have_posts()) :
                        the_post();
                        ?>

                        <article <?php post_class('blog-card'); ?>>

                            <?php if (has_post_thumbnail()) : ?>

                                <a
                                    class="blog-card__image"
                                    href="<?php the_permalink(); ?>"
                                >
                                    <?php
                                    the_post_thumbnail(
                                        'large',
                                        array(
                                            'loading' => 'lazy',
                                        )
                                    );
                                    ?>
                                </a>

                            <?php endif; ?>

                            <div class="blog-card__content">

                                <div class="blog-card__meta">

                                    <time
                                        datetime="<?php echo esc_attr(get_the_date('c')); ?>"
                                    >
                                        <?php echo esc_html(get_the_date()); ?>
                                    </time>

                                    <?php
                                    $categories = get_the_category();

                                    if ($categories) :
                                        ?>
                                        <span aria-hidden="true">·</span>

                                        <span>
                                            <?php
                                            echo esc_html(
                                                $categories[0]->name
                                            );
                                            ?>
                                        </span>
                                    <?php endif; ?>

                                </div>

                                <h2 class="blog-card__title">

                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>

                                </h2>

                                <div class="blog-card__excerpt">
                                    <?php the_excerpt(); ?>
                                </div>

                                <a
                                    class="blog-card__link"
                                    href="<?php the_permalink(); ?>"
                                >
                                    Leer artículo
                                </a>

                            </div>

                        </article>

                        <?php
                    endwhile;
                    ?>

                </div>

                <nav
                    class="blog-pagination"
                    aria-label="Navegación de artículos"
                >
                    <?php
                    the_posts_pagination(
                        array(
                            'mid_size'  => 1,
                            'prev_text' => '← Anterior',
                            'next_text' => 'Siguiente →',
                        )
                    );
                    ?>
                </nav>

            <?php else : ?>

                <div class="blog-page__empty">

                    <h2>Aún no hay artículos publicados</h2>

                    <p>
                        Próximamente encontrarás consejos y
                        recomendaciones para tus viajes por Perú.
                    </p>

                </div>

            <?php endif; ?>

        </div>

    </section>

</main>

<?php
get_footer();