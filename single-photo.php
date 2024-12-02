<?php 
get_header(); 

if (have_posts()) : 
    while (have_posts()) : the_post(); ?>?>


<!-- Titre de la photo -->
<div class="photo-container">
    <h1 class="photo-title"><?php the_title(); ?></h1> <!-- Affiche le titre de l'image -->
        
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
</div>



<?php get_footer(); ?>

