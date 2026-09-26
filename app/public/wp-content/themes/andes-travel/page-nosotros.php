<?php
/**
 * Template for the About page.
 *
 * @package AndesTravel
 */

get_header();
?>

<main class="about-page">

    <section class="about-hero">

        <div class="about-page__container">

            <p class="about-page__eyebrow">
                Sobre Andes Travel
            </p>

            <h1 class="about-page__title">
                Creamos experiencias para descubrir el Perú
            </h1>

            <p class="about-page__intro">
                En Andes Travel buscamos acercar a los viajeros a los
                principales destinos del Perú mediante experiencias
                organizadas, accesibles y pensadas para disfrutar cada viaje.
            </p>

        </div>

    </section>

    <section class="about-story">

        <div class="about-page__container about-story__grid">

            <div class="about-story__content">

                <p class="about-page__eyebrow">
                    Nuestra historia
                </p>

                <h2>
                    Viajar es más que llegar a un destino
                </h2>

                <p>
                    Andes Travel nace con la idea de facilitar la planificación
                    de experiencias turísticas dentro del Perú, reuniendo
                    información clara sobre destinos, tours y actividades en
                    una misma plataforma.
                </p>

                <p>
                    Nuestro propósito es que cada viajero pueda conocer nuevas
                    experiencias, comparar alternativas y encontrar la
                    información necesaria antes de comenzar su próxima aventura.
                </p>

            </div>

            <div class="about-story__highlight">

                <span class="about-story__number">
                    Perú
                </span>

                <p>
                    Experiencias inspiradas en la diversidad cultural,
                    histórica y natural de nuestros destinos.
                </p>

            </div>

        </div>

    </section>

    <section class="about-values">

        <div class="about-page__container">

            <div class="about-values__header">

                <p class="about-page__eyebrow">
                    Lo que nos guía
                </p>

                <h2>
                    Nuestra forma de entender cada experiencia
                </h2>

            </div>

            <div class="about-values__grid">

                <article class="about-value">

                    <h3>Experiencias memorables</h3>

                    <p>
                        Buscamos presentar alternativas que permitan conocer
                        cada destino y disfrutar de experiencias significativas.
                    </p>

                </article>

                <article class="about-value">

                    <h3>Información clara</h3>

                    <p>
                        Presentamos los detalles importantes de cada tour para
                        ayudar al viajero a tomar decisiones informadas.
                    </p>

                </article>

                <article class="about-value">

                    <h3>Conexión con el Perú</h3>

                    <p>
                        Promovemos el descubrimiento de la riqueza natural,
                        histórica y cultural de los diferentes destinos del país.
                    </p>

                </article>

            </div>

        </div>

    </section>

    <section class="about-cta">

        <div class="about-page__container about-cta__content">

            <div>

                <p class="about-page__eyebrow">
                    Tu próxima experiencia
                </p>

                <h2>
                    ¿Listo para descubrir un nuevo destino?
                </h2>

                <p>
                    Explora nuestras experiencias y encuentra el tour ideal
                    para tu próxima aventura por el Perú.
                </p>

            </div>

            <a
                class="about-cta__button"
                href="<?php echo esc_url(get_post_type_archive_link('tour')); ?>"
            >
                Explorar tours
            </a>

        </div>

    </section>

</main>

<?php
get_footer();