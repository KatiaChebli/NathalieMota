<?php get_header(); ?>

<main>
    <h1><?php _e('Bienvenue sur mon site', 'text-domain'); ?></h1>
    <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                the_title('<h2>', '</h2>');
                the_excerpt();
            endwhile;
        else :
            _e('Aucun contenu disponible.', 'text-domain');
        endif;
    ?>
</main>

<?php get_footer(); ?>

