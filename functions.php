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
    // Récupérer les images du custom post type ou d'une catégorie spécifique
    $args = array(
        'post_type' => 'attachment', // Si les images sont des médias
        'post_mime_type' => 'image', // Type image
        'post_status' => 'inherit', // Statut des fichiers
        'posts_per_page' => -1, // Récupérer toutes les images
        'tax_query' => array(
            array(
                'taxonomy' => 'category', // Adapter avec la taxonomie utilisée
                'field'    => 'slug',
                'terms'    => 'hero-images', // Nom de la catégorie d'images
            ),
        ),
    );

    $images = get_posts($args);
    if (!empty($images)) {
        $random_image = $images[array_rand($images)]; // Sélectionne une image aléatoire
        return wp_get_attachment_url($random_image->ID); // Retourne l'URL de l'image
    }

    // Image par défaut si aucune image n'est trouvée
    return get_template_directory_uri() . '/assets/images/default-hero.jpg';
}
