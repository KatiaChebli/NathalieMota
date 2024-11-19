<?php
get_header(); ?>

<main id="site-content">
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <h1><?php the_title(); ?></h1>
                <div class="post-meta">
                    <p>Publié le : <?php the_date(); ?> par <?php the_author(); ?></p>
                </div>
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </article>
            <?php
        endwhile;
    endif;
    ?>
</main>

<?php
get_footer();
