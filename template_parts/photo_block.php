<?php
// Assurez-vous que cette ligne est utilisée WordPress.
if (!defined('ABSPATH')) exit;

// Obtenez les données nécessaires si elles ne sont pas passées directement
if (!isset($post)) $post = get_post();
?>

<div class="related-photo-item">
    <!-- génère le lien vers la page de photo  -->
    <a href="<?php the_permalink(); ?>"> 

        <?php
        // affiche la miniature de la photo
        if (has_post_thumbnail()) {
            the_post_thumbnail('medium', ['style' => 'object-fit: cover; width: 100%; height: 30vh;']);
        } else {
            echo '<img src="' . esc_url(get_template_directory_uri() . '/assets/default-image.jpg') . '" alt="Default Image" />';
        }
        ?>
    </a>
</div>
