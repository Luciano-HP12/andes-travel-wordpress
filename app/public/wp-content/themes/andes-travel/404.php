<?php
/**
 * Template for displaying 404 pages.
 *
 * @package AndesTravel
 */

get_header();
?>

<main class="error-404">

    <div class="error-404__container">

        <p class="error-404__code">
            404
        </p>

        <h1 class="error-404__title">
            Parece que esta ruta no existe
        </h1>

        <p class="error-404__description">
            La página que buscas no está disponible.
            Puedes volver al inicio o explorar nuestras experiencias.
        </p>

        <div class="error-404__actions">

            <a
                class="error-404__button"
                href="<?php echo esc_url(home_url('/')); ?>"
            >
                Volver al inicio
            </a>

            <a
                class="error-404__link"
                href="<?php echo esc_url(get_post_type_archive_link('tour')); ?>"
            >
                Explorar tours
            </a>

        </div>

    </div>

</main>

<?php
get_footer();