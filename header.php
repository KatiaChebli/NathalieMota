
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header class="site-header">
        <!-- Logo -->
        <div class="logo">
            <a href="<?php echo home_url(); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/logo(1).png" alt="Nathalie Mota Logo">
            </a>
        </div>

        <!-- Menu de navigation -->
        <nav class="main-navigation">
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'primary',
                    'container'      => false,
                    'menu_class'     => 'nav-menu',
                )
            );
            ?>
            <?php get_template_part('template_parts/contact-modal'); ?>
            <!-- <button class="open-contact-modal">Contact</button> -->
        </nav>
    </header>


