<?php
/**
 * Contact page template.
 *
 * @package AndesTravel
 */

get_header();
?>

<main class="contact-page">

    <section class="contact-page__hero">

        <div class="contact-page__container">

            <p class="contact-page__eyebrow">
                Contacto
            </p>

            <h1 class="contact-page__title">
                Planifica tu próxima experiencia
            </h1>

            <p class="contact-page__intro">
                Cuéntanos qué destino deseas conocer y te ayudaremos
                a encontrar la experiencia ideal para tu viaje por Perú.
            </p>

        </div>

    </section>

    <section class="contact-page__content">

        <div class="contact-page__container contact-page__grid">

            <div class="contact-page__information">

                <h2>
                    Hablemos de tu viaje
                </h2>

                <p>
                    Completa el formulario con tus datos y la información
                    de tu viaje. Nuestro equipo podrá ponerse en contacto
                    contigo para resolver tus consultas.
                </p>

                <div class="contact-page__detail">

                    <strong>Correo</strong>

                    <span>
                        reservas@andestravel.pe
                    </span>

                </div>

                <div class="contact-page__detail">

                    <strong>Horario de atención</strong>

                    <span>
                        Lunes a sábado, 9:00 a. m. - 6:00 p. m.
                    </span>

                </div>

            </div>

            <div class="contact-page__form-wrapper">

                    <?php
                    $contact_status = isset($_GET['contact_status'])
                        ? sanitize_key(wp_unslash($_GET['contact_status']))
                        : '';
                    $selected_tour_id = isset($_GET['tour_id'])
                        ? absint($_GET['tour_id'])
                        : 0;
                    ?>

                    <?php if ($contact_status === 'success') : ?>

                        <div
                            class="contact-form__notice contact-form__notice--success"
                            role="status"
                        >
                            <strong>¡Consulta enviada!</strong>

                            <p>
                                Hemos recibido tu mensaje correctamente.
                                Nos pondremos en contacto contigo pronto.
                            </p>
                        </div>

                    <?php endif; ?>

                    <?php if ($contact_status === 'invalid') : ?>

                    <div
                        class="contact-form__notice contact-form__notice--error"
                        role="alert"
                    >
                        <strong>Revisa los datos ingresados.</strong>

                        <p>
                            No pudimos procesar la consulta porque algunos
                            datos no son válidos.
                        </p>
                    </div>

                <?php endif; ?>

                <?php if ($contact_status === 'error') : ?>

                    <div
                        class="contact-form__notice contact-form__notice--error"
                        role="alert"
                    >
                        <strong>No pudimos enviar tu consulta.</strong>

                        <p>
                            Ocurrió un problema al procesarla.
                            Inténtalo nuevamente.
                        </p>
                    </div>

                <?php endif; ?>

                <form
                    class="contact-form"
                    method="post"
                >

                    <div class="contact-form__field">

                        <label for="contact-name">
                            Nombre completo
                        </label>

                        <input
                            type="text"
                            id="contact-name"
                            name="andes_travel_name"
                            required
                        >

                    </div>

                    <div class="contact-form__field">

                        <label for="contact-email">
                            Correo electrónico
                        </label>

                        <input
                            type="email"
                            id="contact-email"
                            name="andes_travel_email"
                            required
                        >

                    </div>

                    <div class="contact-form__field">

                        <label for="contact-phone">
                            Teléfono
                        </label>

                        <input
                            type="tel"
                            id="contact-phone"
                            name="andes_travel_phone"
                        >

                    </div>

                    <div class="contact-form__field">

                        <label for="contact-tour">
                            Tour de interés
                        </label>

                        <select
                            id="contact-tour"
                            name="andes_travel_tour"
                        >

                            <option value="">
                                Selecciona un tour
                            </option>

                            <?php
                            $tours = get_posts(
                                array(
                                    'post_type'      => 'tour',
                                    'post_status'    => 'publish',
                                    'posts_per_page' => -1,
                                    'orderby'        => 'title',
                                    'order'          => 'ASC',
                                )
                            );
                            ?>

                            <?php foreach ($tours as $tour) : ?>

                                <option
                                    value="<?php echo esc_attr($tour->ID); ?>"
                                    <?php selected($selected_tour_id, $tour->ID); ?>
                                >
                                    <?php echo esc_html($tour->post_title); ?>
                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>

                    <div class="contact-form__field">

                        <label for="contact-message">
                            Mensaje
                        </label>

                        <textarea
                            id="contact-message"
                            name="andes_travel_message"
                            rows="6"
                            required
                        ></textarea>

                    </div>

                    <?php
                    wp_nonce_field(
                        'andes_travel_contact_form',
                        'andes_travel_contact_nonce'
                    );
                    ?>

                    <button
                        class="contact-form__submit"
                        type="submit"
                        name="andes_travel_contact_submit"
                    >
                        Enviar consulta
                    </button>

                </form>

            </div>

        </div>

    </section>

</main>

<?php
get_footer();