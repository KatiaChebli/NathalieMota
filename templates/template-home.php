<?php
/* Template Name: Page d'accueil */
get_header();
?>

 <div class="hero" style="background-image: url('<?php echo esc_url(get_random_hero_image()); ?>');">
    <div class="hero-content">
        <h1>PHOTOGRAPHE EVENT</h1>
    </div>
</div>

<?php get_footer(); ?>
