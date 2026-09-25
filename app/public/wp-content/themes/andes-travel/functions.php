<?php

/**
 * Theme functions.
 *
 * @package AndesTravel
 */

/**
 * Carga los estilos y scripts del tema.
 */
function andes_travel_enqueue_assets() {

    $css_path = get_template_directory()
        . '/assets/css/main.css';

    $js_path = get_template_directory()
        . '/assets/js/main.js';

    wp_enqueue_style(
        'andes-travel-main',
        get_template_directory_uri() . '/assets/css/main.css',
        array(),
        filemtime($css_path)
    );

    wp_enqueue_script(
        'andes-travel-main',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        filemtime($js_path),
        true
    );
}

add_action(
    'wp_enqueue_scripts',
    'andes_travel_enqueue_assets'
);

/**
 * Configuración inicial del tema.
 */
function andes_travel_setup() {

    // Permite que WordPress gestione el título de cada página.
    add_theme_support('title-tag');

    // Habilita imágenes destacadas.
    add_theme_support('post-thumbnails');

    add_image_size(
        'andes-travel-card',
        600,
        400,
        true
    );

    // Habilita marcado HTML5 para elementos generados por WordPress.
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

add_action(
    'after_setup_theme',
    'andes_travel_setup'
);

/**
 * Añade una meta description básica según el contenido actual.
 */
function andes_travel_meta_description() {

    $description = '';

    if (is_front_page()) {

        $description = get_bloginfo('description');

    } elseif (is_singular('tour')) {

        $description = get_the_excerpt();

    } elseif (is_single()) {

        $description = get_the_excerpt();

    } elseif (is_post_type_archive('tour')) {

        $description = 'Descubre tours y experiencias para conocer los principales destinos del Perú con Andes Travel.';

    } elseif (is_home()) {

        $description = 'Consejos, destinos y recomendaciones para planificar tu próxima aventura por el Perú.';

    } elseif (is_tax('destination')) {

        $term = get_queried_object();

        $description = sprintf(
            'Descubre tours y experiencias disponibles en %s con Andes Travel.',
            $term->name
        );

    } elseif (is_page()) {

        $description = get_the_excerpt();

    }

    if (!$description) {
        return;
    }

    $description = wp_strip_all_tags($description);
    $description = preg_replace('/\s+/', ' ', $description);
    $description = trim($description);

    printf(
        '<meta name="description" content="%s">' . "\n",
        esc_attr($description)
    );
}

add_action(
    'wp_head',
    'andes_travel_meta_description'
);