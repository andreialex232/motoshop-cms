<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <a class="skip-link" href="#main-content">Skip to main content</a>
<?php wp_body_open(); ?>

<header class="site-header">
    <div class="logo">
        <a href="<?php echo esc_url(home_url('/')); ?>">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/LogoMotoshopHeader1.png'); ?>" alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?> Logo">
        </a>
    </div>

    <!-- Navigation -->
    <nav class="main-nav" id="primary-menu" aria-label="Main Navigation">
        <ul>
            <li><a href="<?php echo esc_url(home_url('/shop')); ?>">Shop</a></li>
            <li><a href="<?php echo esc_url(home_url('/test')); ?>">Test drive</a></li>
            <li><a href="<?php echo esc_url(home_url('/blog')); ?>">Blog</a></li>
            <li><a href="<?php echo esc_url(home_url('/sustainability')); ?>">Sustainability initiatives</a></li>
            <li><a href="<?php echo esc_url(home_url('/contact')); ?>">Contact</a></li>
        </ul>
    </nav>

    <!-- Header Right Controls -->
    <div class="header-right">
        <!-- Accessible Hamburger Toggle Button -->
        <button class="menu-toggle" id="menu-toggle" aria-expanded="false" aria-controls="primary-menu" aria-label="Open main menu">
            <span class="hamburger-bar"></span>
            <span class="hamburger-bar"></span>
            <span class="hamburger-bar"></span>
        </button>
    </div>
</header>

<div id="content" class="site-content">