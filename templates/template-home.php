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

<!-- groupe des filtres de gauche-->
    <div class="filter-group">
  <!-- Filtre Catégories -->
  <select name="category" id="category">
        <option value="">CATÉGORIES</option>
        <?php
        $categories = get_terms(array('taxonomy' => 'categories', 'hide_empty' => false));
        foreach ($categories as $category) {
            echo '<option value="category-' . $category->slug . '">' . $category->name . '</option>';
        }
        ?>
    </select>

    <!-- Filtre Formats -->
    <select name="format" id="format">
        <option value="">FORMATS</option>
        <?php
        $formats = get_terms(array('taxonomy' => 'format', 'hide_empty' => false));
        foreach ($formats as $format) {
            echo '<option value="Formats-' . $format->slug . '">' . $format->name . '</option>';
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
    $query = new WP_Query(array('post_type' => 'photos', 'posts_per_page' => 12));
    ?>

    <?php
    $page = get_page_by_path('single-page');
    $page_url = get_permalink($page->ID);
    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
        $id= get_the_ID();
        ?>
        <a href="<?php echo esc_url( $page_url ) . '?postid=' . $id; ?>">
            <div class="photo-item">
                <?php the_post_thumbnail(); ?>
                <!-- <h3><?php echo get_the_ID(); ?></h3> -->
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

<!-- <div class="lightbox">
    <button class="lightbox__close">Fermer</button>
    <button class="lightbox__next">Suivant</button>
    <button class="lightbox__prev">Précédent</button>
        <div class="lightbox__container">
            <img src="https://picsum.photos/300/1800" alt="">
        </div>
</div> -->

<!-- Bouton Charger plus -->
<button id="load-more" data-page="1">Charger plus</button>

<?php get_footer(); ?>
