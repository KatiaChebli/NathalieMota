<?php
/**
 * Template Name: Single Photo
 */

get_header(); 
?>

<main class="single-photo-page">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <?php
// Récupérer l'ID du post depuis URL
$post_id = isset($_GET['postid']) ? intval($_GET['postid']) : 0;

// Vérifie ID est valide
if ($post_id && get_post($post_id)) {
    // Récupérez les informations du post en utilisant son ID
    $post = get_post($post_id);
    setup_postdata($post);
}
?>

<div class="photo-container">
            <!-- Colonne gauche -->
    <div class="photo-details">
        <div class="photo-reference">

        <h1 class="photo-title"> <?php echo get_the_title(); ?></h1>
            <p><strong>Référence :</strong> 
            <?php
            $reference = SCF::get('reference'); 
            echo !empty($reference) ? esc_html($reference) : 'Non spécifié';
            ?>
            </p>

            <p><strong>Catégorie :</strong> 
            <?php
            $terms = get_the_terms( get_the_ID(), 'categorie' );
            foreach ( $terms as $term ) {
                echo '<span class="taxo-categorie">' . esc_html( $term->name ) . '</span>';
            }
            ?>
            </p>

            <p><strong>Format :</strong> 
            <?php
            $termsFormat = get_the_terms( get_the_ID(), 'format' );
            foreach ( $termsFormat as $term ) {
                echo '<span class="taxo-format">' . esc_html( $term->name ) . '</span>';
            }
            ?>
            </p>

            <p><strong>Type :</strong> 
            <?php
            $type = SCF::get('type'); 
            echo !empty($type) ? esc_html($type) : 'Non spécifié';
            ?>
            </p>

            <p><strong>Année :</strong> 
            <?php
            $annee = SCF::get('annee'); 
            echo !empty($annee) ? esc_html($annee) : 'Non spécifié';
            ?>
            </p>
        </div>

        <div class="photo-image">
            <?php
            if (has_post_thumbnail($post_id)) {
            echo get_the_post_thumbnail($post_id, 'large'); // Taille de l'image ('thumbnail', 'medium', 'large', 'full' selon vos besoins)
            } else {
            echo '<p>Aucune image disponible pour ce post.</p>';
        }
        ?>
        </div>

       
</div>

<div class="contact-wrapper">
    <p class="contact-texte">Cette photo vous intéresse ?</p>
    <button class="contact-button single-photo-contact" 
    data-ref-photo="<?php echo esc_attr(SCF::get('reference')); ?>">Contact</button> 
    <!-- data-ref-photo="XXX" qui contient la ref -->
    <?php get_template_part('template_parts/contact-modal'); ?>


    <!-- Liens de navigation -->
<div class="photo-navigation">
    <?php
    $prev_post = get_previous_post();
    $next_post = get_next_post();
    ?>

    <?php if ($prev_post) : ?>
        <div class="nav-container">
            <a href="<?php echo get_permalink(get_page_by_path('single-page')->ID) . '?postid=' . $prev_post->ID; ?>" 
               class="nav-link prev-photo"
               data-thumbnail="<?php echo get_the_post_thumbnail_url($prev_post->ID, 'thumbnail'); ?>">
                ← 
            </a>
            <div class="photo-preview hidden"></div> <!-- Miniature intégrée -->
        </div>
    <?php endif; ?>

    <?php if ($next_post) : ?>
        <div class="nav-container">
            <a href="<?php echo get_permalink(get_page_by_path('single-page')->ID) . '?postid=' . $next_post->ID; ?>" 
               class="nav-link next-photo"
               data-thumbnail="<?php echo get_the_post_thumbnail_url($next_post->ID, 'thumbnail'); ?>">
                →
            </a>
            <div class="photo-preview hidden"></div> <!-- Miniature intégrée -->
        </div>
    <?php endif; ?>
</div>

</div>


<!-- Photos apparentées -->
<div class="related-photos-container">
        <h2>Vous aimerez aussi</h2>
        <div class="related-photos">
            <?php
            $current_post_id = get_the_ID(); // ID de l'article actuel

            $categories = get_the_terms($current_post_id, 'categorie'); // Récupère les catégories de la photo actuelle

        if (!empty($categories) && !is_wp_error($categories)) {
            $category_ids = array_map(function($cat) {
                return $cat->term_id;
            }, $categories);
        } else {
            $category_ids = array(); // Si pas de catégorie, évite erreur
        }

        $args = array(
            'post_type'      => 'photos',
            'posts_per_page' => 2,
            'post__not_in'   => array($current_post_id), // Exclut la photo en cours
            'orderby'        => 'rand',
            'tax_query'      => array(
                array(
                    'taxonomy' => 'categorie',
                    'field'    => 'term_id',
                    'terms'    => $category_ids, // Filtre par catégorie
                ),
            ),
        );

            $related_photos_query = new WP_Query($args);

            if ($related_photos_query->have_posts()) :
                while ($related_photos_query->have_posts()) :
                    $related_photos_query->the_post(); 


                    // Récupérer l'URL de la page single et ajouter l'ID de la photo
                    $single_page_url = get_permalink(get_page_by_path('single-page')->ID);
                    ?>
                    <div class="related-photo">
                        <a href="<?php echo esc_url($single_page_url) . '?postid=' . get_the_ID(); ?>">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('medium'); // Afficher l'image de taille moyenne ?>
                            <?php endif; ?>
                        </a>

                    <!-- Overlay qui contient les icônes "View" et "Zoom" -->
                    <div class="overlay">
                    <!-- Bouton "œil" qui redirige vers la single page-->
                    <button type="button" class="view-icon" 
                            data-large="<?php echo get_the_post_thumbnail_url(); ?>" 
                            data-title="<?php the_title(); ?>"
                            data-url="<?php echo esc_url($single_page_url) . '?postid=' . get_the_ID(); ?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/Group.png" alt="Voir">
                    </button>
                   
                    <button type="button" class="zoom-icon" 
                    data-large="<?php echo get_the_post_thumbnail_url(); ?>" 
                    data-reference="<?php 
                    $reference = SCF::get('reference'); 
                    echo !empty($reference) ? esc_html($reference) : 'Non spécifié';
                    ?>"  
                    data-category="<?php 
                    $categories = get_the_terms(get_the_ID(), 'categorie');
                    echo (!empty($categories) && !is_wp_error($categories)) ? esc_attr($categories[0]->name) : 'Sans catégorie'; 
                    ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/Icon_fullscreen.png">
                    </button> 

                      <!-- Titre et Catégorie en bas -->
        <div class="overlay-info">
            <h3 class="overlay-title"><?php the_title(); ?></h3>
            <p class="overlay-category">
                <?php
                $categories = get_the_terms(get_the_ID(), 'categorie');
                echo (!empty($categories) && !is_wp_error($categories)) ? esc_html($categories[0]->name) : 'Sans catégorie';
                ?>
            </p>
        </div>

                    </div>
                    </div>
                <?php endwhile;
                wp_reset_postdata(); // Réinitialiser la requête principale
            else : ?>
                <p>Aucune photo disponible.</p>
            <?php endif; ?>
        </div>
    </div>

    <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>

