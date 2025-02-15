<?php
/* Template Name: Page d'accueil */
get_header();
?>

 <div class="hero" style="background-image: url('<?php echo esc_url(get_random_hero_image()); ?>');">
    <div class="hero-content">
        <h1>PHOTOGRAPHE EVENT</h1>
    </div>
</div>

<!-- affichage des filtres -->
<form id="photo-filters">
    <div class="filter-group">
        <!-- Filtre Catégories -->
        <select name="category" id="category">
            <option value="">CATÉGORIES</option>
            <?php
            $categories = get_terms(array('taxonomy' => 'categorie', 'hide_empty' => false));
            foreach ($categories as $category) {
                echo '<option value="' . $category->slug . '">' . $category->name . '</option>';
            }
            ?>
        </select>

        <!-- Filtre Formats -->
        <select name="format" id="format">
            <option value="">FORMATS</option>
            <?php
            $formats = get_terms(array('taxonomy' => 'format', 'hide_empty' => false));
            foreach ($formats as $format) {
                echo '<option value="' . $format->slug . '">' . $format->name . '</option>';
            }
            ?>
        </select>
    </div>

    <!-- Filtre Trier par -->
    <div class="order-group">
        <select name="order_by" id="order_by">
            <option value="">Trier par</option>
            <option value="annee-asc">Année : Croissant</option>
            <option value="annee-desc">Année : Décroissant</option>
            <option value="reference-asc">Référence : A-Z</option>
            <option value="reference-desc">Référence : Z-A</option>
            <option value="type-asc">Type : Croissant</option>
            <option value="type-desc">Type : Décroissant</option>
        </select>
    </div>
</form>



<!-- affichage des photos -->
<div id="photo-results">

    <?php
    $query = new WP_Query(array('post_type' => 'photos', 'posts_per_page' => 8));
    ?>

    <?php
    $page = get_page_by_path('single-page');
    $page_url = get_permalink($page->ID);
    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
        $id= get_the_ID();
        ?>
        
        <a href="<?php echo esc_url($page_url) . '?postid=' . $id; ?>" class="photo-item">
    <div class="image-container">
        <img src="<?php echo get_the_post_thumbnail_url(); ?>" 
             alt="<?php the_title(); ?>">
        
        <!-- Overlay qui apparaît au survol -->
        <div class="overlay">
            <h3 class="image-title"><?php the_title(); ?></h3>
            <p class="image-category">
                <?php
                $categories = get_the_terms(get_the_ID(), 'categorie');
                if ($categories && !is_wp_error($categories)) {
                    echo $categories[0]->name;
                }
                ?>
            </p>
            <!-- Bouton "œil" pour la lightbox -->
            <button type="button" class="view-icon" 
                    data-large="<?php echo get_the_post_thumbnail_url(); ?>" 
                    data-title="<?php the_title(); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/Group.png" alt="Voir">
                    </button>
        

        <!-- Icône loupe en haut à droite -->

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
    </div>
    </div>
</a>


            <?php
        endwhile;
        wp_reset_postdata();
    else :
        echo '<p>Aucune photo trouvée.</p>';
    endif;
    ?>
</div>

<!-- Bouton Charger plus -->
<button id="load-more" data-page="1">Charger plus</button>

<?php get_footer(); ?>
