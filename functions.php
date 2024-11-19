<?php
// Ajouter les styles et scripts du thème
function nathaliemota_enqueue_scripts() {
    wp_enqueue_style( 'style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'nathaliemota_enqueue_scripts' );

// Ajouter le support des menus
function nathaliemota_register_menus() {
    register_nav_menus(
        array(
            'primary' => __( 'Menu Principal', 'nathaliemota' ),
        )
    );
}
add_action( 'after_setup_theme', 'nathaliemota_register_menus' );

// Ajouter le support des images mises en avant
add_theme_support( 'post-thumbnails' );

// Ajouter le support du titre dynamique
add_theme_support( 'title-tag' );
