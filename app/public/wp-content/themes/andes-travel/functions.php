<?php

/**
 * Theme functions.
 *
 * @package AndesTravel
 */

function andes_travel_enqueue_assets() {

    wp_enqueue_style(
        'andes-travel-main',
        get_template_directory_uri() . '/assets/css/main.css',
        array(),
        '1.0.0'
    );

    wp_enqueue_script(
        'andes-travel-main',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        '1.0.0',
        true
    );
}

/**
 * Configuración inicial del tema.
 */
/**
 * Configuración inicial del tema.
 */
function andes_travel_setup() {

    // Permite que WordPress gestione el título de cada página.
    add_theme_support('title-tag');

    // Habilita imágenes destacadas.
    add_theme_support('post-thumbnails');

    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );

    // Registra las ubicaciones de menús del tema.
    register_nav_menus(
        array(
            'primary' => 'Menú principal',
        )
    );
}

add_action('after_setup_theme', 'andes_travel_setup');


add_action('wp_enqueue_scripts', 'andes_travel_enqueue_assets');

/**
 * Registra el Custom Post Type Tour.
 */
function andes_travel_register_tour_post_type() {

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
            'andes_travel_register_tour_post_type'
        );

        /**
         * Registra el meta box con información adicional del tour.
         */
        function andes_travel_add_tour_meta_box() {

            add_meta_box(
                'andes-travel-tour-details',
                'Información del tour',
                'andes_travel_render_tour_meta_box',
                'tour',
                'normal',
                'high'
            );
        }

    add_action(
        'add_meta_boxes',
        'andes_travel_add_tour_meta_box'
    );

    /**
 * Muestra los campos personalizados del tour.
 *
 * @param WP_Post $post Post actual.
 */
    function andes_travel_render_tour_meta_box($post) {

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

        /**
     * Guarda los campos personalizados del tour.
     *
     * @param int $post_id ID del post que se está guardando.
     */
    function andes_travel_save_tour_details($post_id) {

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
        'andes_travel_save_tour_details'
    );

    /**
 * Registra la taxonomía Destino para los tours.
 */
function andes_travel_register_destination_taxonomy() {

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
    'andes_travel_register_destination_taxonomy'
);