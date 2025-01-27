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


// Etape4 HERO

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
// // fonction ajax
// function add_ajax_url() {
//     echo '<script type="text/javascript">var ajaxurl = "' . admin_url('admin-ajax.php') . '";</script>';
// }
// add_action('wp_head', 'add_ajax_url');


//Etape4 Ajax photo homepage

function filter_photos() {
    $args = array(
        'post_type'      => 'photos',
        'posts_per_page' => 8,
        'tax_query'      => array('relation' => 'AND'),
        'meta_query'     => array('relation' => 'AND'),
    );

    // Filtre par catégorie
    if (!empty($_GET['category'])) {
        $args['tax_query'][] = array(
            'taxonomy' => 'catégories',
            'field'    => 'slug',
            'terms'    => sanitize_text_field($_GET['category']),
        );
    }

    // Filtre par format
    if (!empty($_GET['format'])) {
        $args['tax_query'][] = array(
            'taxonomy' => 'Formats',
            'field'    => 'slug',
            'terms'    => sanitize_text_field($_GET['format']),
        );
    }

 // Trier par
 if (!empty($_GET['order_by'])) {
    $order_by = sanitize_text_field($_GET['order_by']);

    // Trier par Année
    if ($order_by === 'annee-asc') {
        $args['meta_query'][] = array(
            'key'     => 'Annees',
            'type'    => 'NUMERIC',
            'compare' => 'EXISTS',
        );
        $args['orderby'] = 'meta_value_num';
        $args['order'] = 'ASC';
    }
    if ($order_by === 'annee-desc') {
        $args['meta_query'][] = array(
            'key'     => 'Années',
            'type'    => 'NUMERIC',
            'compare' => 'EXISTS',
        );
        $args['orderby'] = 'meta_value_num';
        $args['order'] = 'DESC';
    }

    // Trier par Référence
    if ($order_by === 'reference-asc') {
        $args['meta_key'] = 'Références';
        $args['orderby'] = 'meta_value';
        $args['order'] = 'ASC';
    }
    if ($order_by === 'reference-desc') {
        $args['meta_key'] = 'Références';
        $args['orderby'] = 'meta_value';
        $args['order'] = 'DESC';
    }

    // Trier par Type
    if ($order_by === 'type-asc') {
        $args['meta_key'] = 'Type';
        $args['orderby'] = 'meta_value';
        $args['order'] = 'ASC';
    }
    if ($order_by === 'type-desc') {
        $args['meta_key'] = 'Type';
        $args['orderby'] = 'meta_value';
        $args['order'] = 'DESC';
    }
}

    // Requête WP_Query
    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            ?>
            <div class="photo-item">
                <?php the_post_thumbnail(); ?>
                <h3><?php the_title(); ?></h3>
            </div>
            <?php
        endwhile;
    else :
        echo '<p>Aucune photo trouvée.</p>';
    endif;

    wp_die(); // Terminer l'exécution pour Ajax
}
add_action('wp_ajax_filter_photos', 'filter_photos');
add_action('wp_ajax_nopriv_filter_photos', 'filter_photos');
