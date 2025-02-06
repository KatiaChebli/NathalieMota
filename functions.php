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
function add_contact_menu_item($items, $args) {
        if ($args->theme_location == 'primary') { // Vérifie si c'est le menu principal
            $items .= '<li id="menu-item-68" class="menu-item">
                        <a href="#" class="contact-link">Contact</a>
                      </li>';
        }
        return $items;
    }
add_filter('wp_nav_menu_items', 'add_contact_menu_item', 10, 2);
    
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


// // fonction ajax bouton charger plus
function my_enqueue_scripts() {
    wp_enqueue_script('my-theme-js', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0', true);

    wp_localize_script('my-theme-js', 'ajaxurl', admin_url('admin-ajax.php'));
}
add_action('wp_enqueue_scripts', 'my_enqueue_scripts');


function load_more_photos() {
    $paged = isset($_GET['page']) ? intval($_GET['page']) : 1;

    $args = array(
        'post_type'      => 'photos',
        'posts_per_page' => $photos_par_page,
        'paged'          => $paged,
        'orderby'        => 'date',
        'order'          => 'DESC',
        'offset'         => $offset, // Exclut les premières photos
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            echo '<div class="photo-item">' . get_the_post_thumbnail() . '</div>';
        }
        wp_reset_postdata();
    } else {
        echo ''; // Retourne une réponse vide si plus de photos
    }

    wp_die();
}
add_action('wp_ajax_load_more_photos', 'load_more_photos');
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos');


//Etape4 Ajax photo homepage
function filter_photos() {
    // Récupération des filtres envoyés par AJAX
    $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '';
    $format = isset($_POST['format']) ? sanitize_text_field($_POST['format']) : '';
    $order_by = isset($_POST['order_by']) ? sanitize_text_field($_POST['order_by']) : '';

    $args = array(
        'post_type'      => 'photos',
        'posts_per_page' => -1, // Charge toutes les photos filtrées
        'tax_query'      => array('relation' => 'AND'),
        'meta_query'     => array('relation' => 'AND'),
    );

    // Filtrer par catégorie 
    if (!empty($category)) {
        $args['tax_query'][] = array(
            'taxonomy' => 'categorie', // Assure-toi que c'est le bon nom
            'field'    => 'slug',
            'terms'    => $category,
        );
    }

    // Filtrer par format 
    if (!empty($format)) {
        $args['tax_query'][] = array(
            'taxonomy' => 'format', // Correction du nom
            'field'    => 'slug',
            'terms'    => $format,
        );
    }

    // Trier les résultats
    if (!empty($order_by)) {
        switch ($order_by) {
            case 'annee-asc':
                $args['meta_query'][] = array(
                    'key'     => 'annee',
                    'type'    => 'NUMERIC',
                    'compare' => 'EXISTS',
                );
                $args['orderby'] = 'meta_value_num';
                $args['order'] = 'ASC';
                break;

            case 'annee-desc':
                $args['meta_query'][] = array(
                    'key'     => 'annee',
                    'type'    => 'NUMERIC',
                    'compare' => 'EXISTS',
                );
                $args['orderby'] = 'meta_value_num';
                $args['order'] = 'DESC';
                break;

            case 'reference-asc':
                $args['meta_key'] = 'reference';
                $args['orderby'] = 'meta_value';
                $args['order'] = 'ASC';
                break;

            case 'reference-desc':
                $args['meta_key'] = 'reference';
                $args['orderby'] = 'meta_value';
                $args['order'] = 'DESC';
                break;

            case 'type-asc':
                $args['meta_key'] = 'type';
                $args['orderby'] = 'meta_value';
                $args['order'] = 'ASC';
                break;

            case 'type-desc':
                $args['meta_key'] = 'type';
                $args['orderby'] = 'meta_value';
                $args['order'] = 'DESC';
                break;
        }
    }

    // Exécution de la requête WP_Query
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
        wp_reset_postdata();
    else :
        echo '<p>Aucune photo trouvée.</p>';
    endif;

    wp_die();
}
add_action('wp_ajax_filter_photos', 'filter_photos');
add_action('wp_ajax_nopriv_filter_photos', 'filter_photos');
