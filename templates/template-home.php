<?php
/* Template Name: Page d'accueil */
get_header();
?>
<div class="hero">
    <!-- Le contenu du Hero -->
    <div class="hero" style="background-image: url('<?php echo esc_url(get_random_hero_image()); ?>');">
    <div class="hero-content">
        <h1>Bienvenue sur le site de Nathalie Mota</h1>
        <p>Découvrez nos plus belles collections.</p>
    </div>
</div>

</div>
<?php get_footer(); ?>
