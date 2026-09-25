<?php
/**
 * Plugin Name: Andes Travel Core
 * Description: Funcionalidad principal del sitio Andes Travel.
 * Version: 1.0.0
 * Author: Eusebio Luciano
 * Text Domain: andes-travel-core
 */

if (!defined('ABSPATH')) {
    exit;
}

function andes_travel_core_register_tour_post_type() {

        $labels = array(
            'name'               => 'Tours',
            'singular_name'      => 'Tour',
            'menu_name'          => 'Tours',
            'add_new'            => 'Añadir nuevo',
            'add_new_item'       => 'Añadir nuevo tour',
            'edit_item'          => 'Editar tour',
            'new_item'           => 'Nuevo tour',
            'view_item'          => 'Ver tour',
            'search_items'       => 'Buscar tours',
            'not_found'          => 'No se encontraron tours',
            'not_found_in_trash' => 'No se encontraron tours en la papelera',
        );

        $args = array(
            'labels'       => $labels,
            'public'       => true,
            'show_in_rest' => true,
            'menu_icon'    => 'dashicons-location-alt',

            'supports' => array(
                'title',
                'editor',
                'thumbnail',
                'excerpt',
            ),

            'has_archive' => true,
            'rewrite'     => array(
                'slug' => 'tours',
            ),
        );

        register_post_type('tour', $args);
    }

    add_action(
            'init',
            'andes_travel_core_register_tour_post_type'
        );

function andes_travel_core_register_destination_taxonomy() {

        $labels = array(
            'name'              => 'Destinos',
            'singular_name'     => 'Destino',
            'search_items'      => 'Buscar destinos',
            'all_items'         => 'Todos los destinos',
            'parent_item'       => 'Destino superior',
            'parent_item_colon' => 'Destino superior:',
            'edit_item'         => 'Editar destino',
            'update_item'       => 'Actualizar destino',
            'add_new_item'      => 'Añadir nuevo destino',
            'new_item_name'     => 'Nombre del nuevo destino',
            'menu_name'         => 'Destinos',
        );

        $args = array(
            'labels'            => $labels,
            'public'            => true,
            'hierarchical'      => true,
            'show_admin_column' => true,
            'show_in_rest'      => true,

            'rewrite' => array(
                'slug' => 'destino',
            ),
        );

        register_taxonomy(
            'destination',
            array('tour'),
            $args
        );
    }

    add_action(
        'init',
        'andes_travel_core_register_destination_taxonomy'
    );

    /**
 * Registra el Custom Post Type Consulta.
 */
function andes_travel_core_register_inquiry_post_type() {

    $labels = array(
        'name'          => 'Consultas',
        'singular_name' => 'Consulta',
        'menu_name'     => 'Consultas',
        'all_items'     => 'Todas las consultas',
        'view_item'     => 'Ver consulta',
        'search_items'  => 'Buscar consultas',
        'not_found'     => 'No se encontraron consultas',
    );

    $args = array(
        'labels'       => $labels,
        'public'       => false,
        'show_ui'      => true,
        'show_in_menu' => true,
        'menu_icon'    => 'dashicons-email-alt',
        'supports'     => array('title'),
    );

    register_post_type(
        'travel_inquiry',
        $args
    );
}

add_action(
    'init',
    'andes_travel_core_register_inquiry_post_type'
);

/**
 * Agrega el Meta Box con los detalles de una consulta.
 */
function andes_travel_core_add_inquiry_meta_box() {

    add_meta_box(
        'andes-travel-inquiry-details',
        'Detalles de la consulta',
        'andes_travel_core_render_inquiry_meta_box',
        'travel_inquiry',
        'normal',
        'high'
    );
}

add_action(
    'add_meta_boxes',
    'andes_travel_core_add_inquiry_meta_box'
);

/**
 * Muestra los detalles de una consulta.
 *
 * @param WP_Post $post Consulta actual.
 */
function andes_travel_core_render_inquiry_meta_box($post) {

    $name = get_post_meta(
        $post->ID,
        '_andes_travel_inquiry_name',
        true
    );

    $email = get_post_meta(
        $post->ID,
        '_andes_travel_inquiry_email',
        true
    );

    $phone = get_post_meta(
        $post->ID,
        '_andes_travel_inquiry_phone',
        true
    );

    $tour_id = absint(
        get_post_meta(
            $post->ID,
            '_andes_travel_inquiry_tour_id',
            true
        )
    );

    $tour_name = get_post_meta(
        $post->ID,
        '_andes_travel_inquiry_tour_name',
        true
    );

    $message = get_post_meta(
        $post->ID,
        '_andes_travel_inquiry_message',
        true
    );
    ?>

    <table class="widefat striped">

        <tbody>

            <tr>
                <th scope="row">Nombre</th>
                <td>
                    <?php echo esc_html($name); ?>
                </td>
            </tr>

            <tr>
                <th scope="row">Correo electrónico</th>
                <td>
                    <a href="mailto:<?php echo esc_attr($email); ?>">
                        <?php echo esc_html($email); ?>
                    </a>
                </td>
            </tr>

            <tr>
                <th scope="row">Teléfono</th>
                <td>
                    <?php
                    echo $phone
                        ? esc_html($phone)
                        : 'No proporcionado';
                    ?>
                </td>
            </tr>

            <tr>
                <th scope="row">Tour de interés</th>
                <td>

                    <?php if ($tour_id > 0 && $tour_name) : ?>

                        <?php
                        $tour_edit_url = get_edit_post_link(
                            $tour_id
                        );
                        ?>

                        <?php if ($tour_edit_url) : ?>

                            <a
                                href="<?php echo esc_url($tour_edit_url); ?>"
                            >
                                <?php echo esc_html($tour_name); ?>
                            </a>

                        <?php else : ?>

                            <?php echo esc_html($tour_name); ?>

                        <?php endif; ?>

                    <?php else : ?>

                        No seleccionado

                    <?php endif; ?>

                </td>
            </tr>

            <tr>
                <th scope="row">Mensaje</th>
                <td>
                    <?php echo nl2br(esc_html($message)); ?>
                </td>
            </tr>

        </tbody>

    </table>

    <?php
}

    /**
         * Registra el meta box con información adicional del tour.
         */
function andes_travel_core_add_tour_meta_box() {

            add_meta_box(
                'andes-travel-tour-details',
                'Información del tour',
                'andes_travel_core_render_tour_meta_box',
                'tour',
                'normal',
                'high'
            );
        }

        add_action(
            'add_meta_boxes',
            'andes_travel_core_add_tour_meta_box'
        );

function andes_travel_core_render_tour_meta_box($post) {

            wp_nonce_field(
                'andes_travel_save_tour_details',
                'andes_travel_tour_nonce'
            );

            $price = get_post_meta(
                $post->ID,
                '_andes_travel_price',
                true
            );

            $duration = get_post_meta(
                $post->ID,
                '_andes_travel_duration',
                true
            );

            

            $difficulty = get_post_meta(
                $post->ID,
                '_andes_travel_difficulty',
                true
            );

            $is_featured = get_post_meta(
                $post->ID,
                '_andes_travel_featured',
                true
            );
            ?>

            <p>
                <label for="andes-travel-price">
                    <strong>Precio (S/)</strong>
                </label>
                <br>

                <input
                    type="number"
                    id="andes-travel-price"
                    name="andes_travel_price"
                    value="<?php echo esc_attr($price); ?>"
                    min="0"
                    step="0.01"
                >
            </p>

            <p>
                <label for="andes-travel-duration">
                    <strong>Duración</strong>
                </label>
                <br>

                <input
                    type="text"
                    id="andes-travel-duration"
                    name="andes_travel_duration"
                    value="<?php echo esc_attr($duration); ?>"
                    placeholder="Ej. 1 día"
                >
            </p>

            

            <p>
                <label for="andes-travel-difficulty">
                    <strong>Dificultad</strong>
                </label>
                <br>

                <select
                    id="andes-travel-difficulty"
                    name="andes_travel_difficulty"
                >
                    <option value="">Seleccionar</option>

                    <option
                        value="easy"
                        <?php selected($difficulty, 'easy'); ?>
                    >
                        Fácil
                    </option>

                    <option
                        value="moderate"
                        <?php selected($difficulty, 'moderate'); ?>
                    >
                        Moderada
                    </option>

                    <option
                        value="difficult"
                        <?php selected($difficulty, 'difficult'); ?>
                    >
                        Difícil
                    </option>

                </select>
            </p>

            <p>
                <label>
                    <input
                        type="checkbox"
                        name="andes_travel_featured"
                        value="1"
                        <?php checked($is_featured, '1'); ?>
                    >

                    <strong>Mostrar como tour destacado</strong>
                </label>
            </p>

            <?php
        }

function andes_travel_core_save_tour_details($post_id) {

            // 1. Comprobar que el nonce existe.
            if (!isset($_POST['andes_travel_tour_nonce'])) {
                return;
            }

            // 2. Verificar que el nonce sea válido.
            if (
                !wp_verify_nonce(
                    sanitize_text_field(
                        wp_unslash($_POST['andes_travel_tour_nonce'])
                    ),
                    'andes_travel_save_tour_details'
                )
            ) {
                return;
            }

            // 3. Evitar guardar durante un autosave.
            if (
                defined('DOING_AUTOSAVE')
                && DOING_AUTOSAVE
            ) {
                return;
            }

            // 4. Comprobar permisos del usuario.
            if (!current_user_can('edit_post', $post_id)) {
                return;
            }

            // 5. Comprobar que estamos guardando un Tour.
            if (get_post_type($post_id) !== 'tour') {
                return;
            }

            // 6. Guardar precio.
            if (isset($_POST['andes_travel_price'])) {

                $price = sanitize_text_field(
                    wp_unslash($_POST['andes_travel_price'])
                );

                update_post_meta(
                    $post_id,
                    '_andes_travel_price',
                    $price
                );
            }

            // 7. Guardar duración.
            if (isset($_POST['andes_travel_duration'])) {

                $duration = sanitize_text_field(
                    wp_unslash($_POST['andes_travel_duration'])
                );

                update_post_meta(
                    $post_id,
                    '_andes_travel_duration',
                    $duration
                );
            }

            // 8. Guardar ubicación.
            

            // 9. Guardar dificultad.
            if (isset($_POST['andes_travel_difficulty'])) {

                $difficulty = sanitize_key(
                    wp_unslash($_POST['andes_travel_difficulty'])
                );

                $allowed_difficulties = array(
                    'easy',
                    'moderate',
                    'difficult',
                );

                if (in_array($difficulty, $allowed_difficulties, true)) {

                    update_post_meta(
                        $post_id,
                        '_andes_travel_difficulty',
                        $difficulty
                    );

                } else {

                    delete_post_meta(
                        $post_id,
                        '_andes_travel_difficulty'
                    );
                }
            }
            if (isset($_POST['andes_travel_featured'])) {

                    update_post_meta(
                        $post_id,
                        '_andes_travel_featured',
                        '1'
                    );

                } else {

                    delete_post_meta(
                        $post_id,
                        '_andes_travel_featured'
                    );
                }
        }

        add_action(
            'save_post_tour',
            'andes_travel_core_save_tour_details'
        );

    /**
 * Redirige al formulario de contacto con un estado.
 *
 * @param string $status Estado del formulario.
 */
function andes_travel_core_redirect_contact_form($status) {

    $allowed_statuses = array(
        'success',
        'invalid',
        'error',
    );

    if (!in_array($status, $allowed_statuses, true)) {
        $status = 'error';
    }

    $redirect_url = add_query_arg(
        'contact_status',
        $status,
        home_url('/contacto/')
    );

    wp_safe_redirect($redirect_url);
    exit;
}
        
    /**
 * Procesa el formulario de contacto.
 */
function andes_travel_core_process_contact_form() {

    // 1. Comprobar si se envió nuestro formulario.
    if (!isset($_POST['andes_travel_contact_submit'])) {
        return;
    }

    // 2. Comprobar que el nonce existe.
    if (!isset($_POST['andes_travel_contact_nonce'])) {
    andes_travel_core_redirect_contact_form('invalid');
    }

    // 3. Verificar el nonce.
    $nonce = sanitize_text_field(
        wp_unslash($_POST['andes_travel_contact_nonce'])
    );

    if (
    !wp_verify_nonce(
        $nonce,
        'andes_travel_contact_form'
    )
    ) {
        andes_travel_core_redirect_contact_form('invalid');
    }

    // 4. Recoger y sanitizar los datos.
    $name = isset($_POST['andes_travel_name'])
        ? sanitize_text_field(
            wp_unslash($_POST['andes_travel_name'])
        )
        : '';

    $email = isset($_POST['andes_travel_email'])
        ? sanitize_email(
            wp_unslash($_POST['andes_travel_email'])
        )
        : '';

    $phone = isset($_POST['andes_travel_phone'])
        ? sanitize_text_field(
            wp_unslash($_POST['andes_travel_phone'])
        )
        : '';

    $tour_id = isset($_POST['andes_travel_tour'])
        ? absint($_POST['andes_travel_tour'])
        : 0;

    $message = isset($_POST['andes_travel_message'])
        ? sanitize_textarea_field(
            wp_unslash($_POST['andes_travel_message'])
        )
        : '';

    // 5. Validar los campos obligatorios.
    if (
    empty($name)
    || empty($email)
    || empty($message)
    || !is_email($email)
    ) {
        andes_travel_core_redirect_contact_form('invalid');
    }

    // 6. Validar el Tour seleccionado, si existe.
    if ($tour_id > 0) {

    $tour = get_post($tour_id);

    if (
    empty($name)
    || empty($email)
    || empty($message)
    || !is_email($email)
    ) {
        andes_travel_core_redirect_contact_form('invalid');
    }
}

    // 7. Obtener el nombre del Tour seleccionado.
$tour_name = '';

if ($tour_id > 0) {
    $tour_name = get_the_title($tour_id);
}

// 8. Crear la consulta en WordPress.
$inquiry_id = wp_insert_post(
    array(
        'post_type'   => 'travel_inquiry',
        'post_status' => 'publish',
        'post_title'  => sprintf(
            'Consulta de %s',
            $name
        ),
    ),
    true
);

// 9. Comprobar que la consulta se creó correctamente.
if (is_wp_error($inquiry_id)) {
    andes_travel_core_redirect_contact_form('error');
}

// 10. Guardar los datos de la consulta.
update_post_meta(
    $inquiry_id,
    '_andes_travel_inquiry_name',
    $name
);

update_post_meta(
    $inquiry_id,
    '_andes_travel_inquiry_email',
    $email
);

update_post_meta(
    $inquiry_id,
    '_andes_travel_inquiry_phone',
    $phone
);

update_post_meta(
    $inquiry_id,
    '_andes_travel_inquiry_tour_id',
    $tour_id
);

update_post_meta(
    $inquiry_id,
    '_andes_travel_inquiry_tour_name',
    $tour_name
);

update_post_meta(
    $inquiry_id,
    '_andes_travel_inquiry_message',
    $message
);

// 11. Redirigir después de procesar correctamente la consulta.
andes_travel_core_redirect_contact_form('success');
}

add_action(
    'template_redirect',
    'andes_travel_core_process_contact_form'
);

