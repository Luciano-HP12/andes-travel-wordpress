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

add_action('wp_enqueue_scripts', 'andes_travel_enqueue_assets');