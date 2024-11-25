<?php get_header(); ?>

<main class="single-photo">
    <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                ?>
                <h1><?php the_title(); ?></h1>
                <div class="photo-content">
                    <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                    <p>Référence : <?php the_field('reference'); ?></p>
                    <p>Type : <?php the_field('type'); ?></p>
                    <p>Catégorie : <?php the_terms(get_the_ID(), 'categorie'); ?></p>
                    <p>Format : <?php the_terms(get_the_ID(), 'format'); ?></p>
                </div>
                <button id="contact-button" data-reference="<?php the_field('reference'); ?>">Contact</button>
            <?php
            endwhile;
        endif;
    ?>
</main>

<?php get_footer(); ?>

