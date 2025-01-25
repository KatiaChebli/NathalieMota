<?php
// Charger les styles et scripts
function nathaliemota_enqueue_assets() {
    // Charger le style principal
    wp_enqueue_style('style', get_stylesheet_uri());

    // Charger le script pour la modale
    wp_enqueue_script('modal-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'nathaliemota_enqueue_assets');

// Ajout des menus
function nathaliemota_register_menus() {
    register_nav_menus(
        array(
            'primary' => __( 'Menu Principal', 'nathaliemota' ),
        )
    );
}
add_action('after_setup_theme', 'nathaliemota_register_menus');


// Etape5

function get_random_hero_image() {
    // Modifier la requête pour récupérer les photos du custom post type "photo"
    $args = array(
        'post_type'      => 'Photos', // slug custom post type
        'post_status'    => 'publish', // photos publiées
        'posts_per_page' => -1, // Récupérer toutes les photos disponibles
    );

    // Récupérer les publications du type "photo"
    $photos = get_posts($args);

    if (!empty($photos)) {
        // Sélectionner une photo aléatoire
        $random_photo = $photos[array_rand($photos)];
        
        // Récupérer l'URL de l'image en tant qu'image mise en avant
        if (has_post_thumbnail($random_photo->ID)) {
            return get_the_post_thumbnail_url($random_photo->ID, 'full');
        }
    }

    // Si aucune photo ou image mise en avant, retourner une image par défaut
    return get_template_directory_uri() . '/images/cat(1).png';
}
