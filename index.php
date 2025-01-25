<?php get_header(); ?>

<main>

<!-- hero -->
<div id="hero"></div>
<?php echo wp_list_pages()?>
    <a href="<?php echo site_url('/single-photo');?>">Lien photo</a>
</main>

<?php get_footer(); ?>

