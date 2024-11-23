<?php get_header(); ?>

<main>
    <h1><?php the_title(); ?></h1>
    <div>
        <?php
            while (have_posts()) : the_post();
                the_content();
            endwhile;
        ?>
    </div>
</main>

<?php get_footer(); ?>

