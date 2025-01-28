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
       
        <div class="photo-image">
            <?php
            if (has_post_thumbnail($post_id)) {
            echo get_the_post_thumbnail($post_id, 'large'); // Taille de l'image ('thumbnail', 'medium', 'large', 'full' selon vos besoins)
            } else {
            echo '<p>Aucune image disponible pour ce post.</p>';
        }
        ?>
        </div>

        <div class="photo-reference">
            <p><strong>Référence :</strong> 
            <?php
            $reference = SCF::get('reference'); 
            echo !empty($reference) ? esc_html($reference) : 'Non spécifié';
            ?>
            </p>

            <p><strong>Format :</strong> 
            <?php
            $format = SCF::get('format'); 
            echo !empty($format) ? esc_html($format) : 'Non spécifié';
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
            $annee = SCF::get('Année'); 
            echo !empty($annee) ? esc_html($annee) : 'Non spécifié';
            ?>
            </p>
        </div>
</div>

<div class="line-above1"></div>
    <div class="contact">
        <p>Cette photo vous intéresse ?</p>
        <button id="open-modal">Contact</button>
        <?php get_template_part('template_parts/contact-modal'); ?>
    </div>
</div>

<!-- Photos apparentées -->
<div class="line-above2"></div>
<div class="related-photos-container">
            <h2>Vous aimerez aussi</h2>

            <?php
        $current_post_id = get_the_ID(); // ID de l'article actuel
        $args = array(
            'post_type'      => 'Photos', // Type de contenu 
            'posts_per_page' => 2,       // 2 photos
            'post__not_in'   => array($current_post_id), // Exclure l'article actuel
            'orderby'        => 'rand', // Afficher aléatoirement
        );

        $related_photos_query = new WP_Query($args);

        if ($related_photos_query->have_posts()) :
            while ($related_photos_query->have_posts()) :
                $related_photos_query->the_post(); ?>

                <div class="related-photo">
                    <a href="<?php the_permalink(); ?>">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('medium'); // Afficher l'image de taille moyenne ?>
                        <?php endif; ?>
                    </a>
                </div>

            <?php endwhile;
            wp_reset_postdata(); // Réinitialiser la requête principale
        else : ?>
            <p>Aucune photo disponible.</p>
        <?php endif; ?>
    </div>


    <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>
