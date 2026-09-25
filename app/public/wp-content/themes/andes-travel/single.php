<?php
/**
 * Template for displaying a single blog post.
 *
 * @package AndesTravel
 */

get_header();
?>

<main class="blog-single">

    <?php
    if (have_posts()) :

        while (have_posts()) :
            the_post();

            $categories = get_the_category();
            ?>

            <article <?php post_class('blog-article'); ?>>

                <header class="blog-article__header">

                    <div class="blog-article__container">

                        <?php if ($categories) : ?>

                            <p class="blog-article__category">
                                <?php
                                echo esc_html(
                                    $categories[0]->name
                                );
                                ?>
                            </p>

                        <?php endif; ?>

                        <h1 class="blog-article__title">
                            <?php the_title(); ?>
                        </h1>

                        <div class="blog-article__meta">

                            <time
                                datetime="<?php echo esc_attr(get_the_date('c')); ?>"
                            >
                                <?php echo esc_html(get_the_date()); ?>
                            </time>

                            <span aria-hidden="true">·</span>

                            <span>
                                Por <?php echo esc_html(get_the_author()); ?>
                            </span>

                        </div>

                    </div>

                </header>

                <div class="blog-article__container">

                    <?php if (has_post_thumbnail()) : ?>

                        <figure class="blog-article__image">
                            <?php the_post_thumbnail('large'); ?>
                        </figure>

                    <?php endif; ?>

                    <div class="blog-article__content">

                        <?php the_content(); ?>

                    </div>

                    <footer class="blog-article__footer">

                        <a
                            class="blog-article__back"
                            href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"
                        >
                            ← Volver al Blog
                        </a>

                    </footer>

                </div>

            </article>

            <?php
        endwhile;

    endif;
    ?>

</main>

<?php
get_footer();