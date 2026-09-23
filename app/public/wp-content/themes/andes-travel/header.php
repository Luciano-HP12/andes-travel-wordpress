<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<header class="site-header">

    <div class="site-header__container">

        <a
            class="site-header__logo"
            href="<?php echo esc_url(home_url('/')); ?>"
        >
            <?php bloginfo('name'); ?>
        </a>

        <button
            class="site-header__toggle"
            type="button"
            aria-expanded="false"
            aria-controls="primary-menu"
            aria-label="Abrir menú de navegación"
        >
            <span></span>
            <span></span>
            <span></span>
        </button>

        <nav
            class="site-header__nav"
            id="primary-menu"
            aria-label="Navegación principal"
        >

            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'primary',
                    'container'      => false,
                    'menu_class'     => 'main-menu',
                    'fallback_cb'    => false,
                )
            );
            ?>

        </nav>

    </div>

</header>