<?php 
get_header(); 

if (have_posts()) : 
    while (have_posts()) : the_post(); ?>?>


<!-- Titre de la photo -->
<div class="single-photo-page">
    
    <div class="title-photo">
        <h1 class="photo-title"><?php the_title(); ?></h1> <!-- Affiche le titre de l'image -->
    </div>

    <div class="photo-image">
        <?php the_post_thumbnail('large'); ?> <!-- Affiche l'image en taille 'large' -->
    </div>

    <div class="photo-details">
        <p><strong>Référence :</strong> <?php echo esc_html(get_post_meta(get_the_ID(), 'reference', true)); ?></p>
        <p><strong>Catégorie :</strong> <?php echo esc_html(get_the_terms(get_the_ID(), 'categorie')[0]->name); ?></p>
        <p><strong>Format :</strong> <?php echo esc_html(get_post_meta(get_the_ID(), 'format', true)); ?></p>
        <p><strong>Type :</strong> <?php echo esc_html(get_post_meta(get_the_ID(), 'type', true)); ?></p>
        <p><strong>Année :</strong> <?php echo esc_html(get_post_meta(get_the_ID(), 'annee', true)); ?></p>
    </div>

    <div class="contact">
        <p>Cette photo vous intéresse ?</p>
        <?php get_template_part('template_parts/contact-modal'); ?>
    </div>

    <div class="photo-navigation">
        <?php previous_post_link('%link', '← Précédente'); ?>
        <?php next_post_link('%link', 'Suivante →'); ?>
    </div>

</div>
<!-- conteneur global -->
<div class="related-photos-container"> 
    <h2>Vous aimerez aussi</h2>
<!-- conteneur photo apparentées -->
    <div class="related-photos-grid">
    <?php
    $current_id = get_the_ID();
    $categories = get_the_terms($current_id, 'categorie');

// requête WP_Query pour récuper les photos
    $related_query = new WP_Query(array(
        'post_type' => 'photo',
        'posts_per_page' => 2,
        'post__not_in' => array($current_id),
        'tax_query' => array(
            array(
                'taxonomy' => 'categorie',
                'field'    => 'term_id',
                'terms'    => $category_ids,
            ),
        ),
    ));
    
// Affichage des photos apparentées
if ($related_query->have_posts()) :
    while ($related_query->have_posts()) : $related_query->the_post();
        get_template_part('templates_parts/photo_block');
    endwhile;
    wp_reset_postdata();
else : ?>
    <p>Aucune photo apparentée trouvée.</p>
    
<?php endif; ?>
    </div>
</div>


<?php get_footer(); ?>

