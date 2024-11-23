
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
        <div class="container">

            <!-- Logo -->
            <div class="site-logo">
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/Photos NMota/logo(2).png" alt="<?php bloginfo('name'); ?>">
                </a>
            </div>

            <!-- Menu de navigation -->
            <nav role="navigation" aria-label="<?php _e('Menu principal', 'text-domain'); ?>">
                <?php
                    wp_nav_menu([
                        'theme_location' => 'main-menu',
                        'container' => false,
                        'menu_class' => 'main-navigation',
                    ]);
                ?>
            </nav>
        </div>
    </header>


