<?php
// Ajout du styles 
function nathaliemota_enqueue_scripts() {
    wp_enqueue_style( 'style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'nathaliemota_enqueue_scripts' );

// Ajout des menus
function nathaliemota_register_menus() {
    register_nav_menus(
        array(
            'primary' => __( 'Menu Principal', 'nathaliemota' ),
        )
    );
}
add_action( 'after_setup_theme', 'nathaliemota_register_menus' );


//charger fichier js
function theme_enqueue_scripts() {
    wp_enqueue_script('custom-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');



?>
