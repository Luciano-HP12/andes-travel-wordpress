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