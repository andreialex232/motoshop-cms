<?php
/**
 * Template Name: Front Page
 */


get_header(); 
?>

<main class="site-main">
    <!-- hero section -->
    <section class="hero-section">
        <div class="hero-container">
            <div class="hero-content">
                <?php if ($hero_tagline = get_field('hero-tagline')) : ?>
                    <span class="hero-tagline"><?php echo esc_html($hero_tagline); ?></span>
                <?php endif; ?>

                <?php if ($hero_title = get_field('hero-title')) : ?>
                    <h1 class="hero-title"><?php echo esc_html($hero_title); ?></h1>
                <?php endif; ?>

                <?php if ($hero_desc = get_field('hero-description')) : ?>
                    <p class="hero-description"><?php echo esc_html($hero_desc); ?></p>
                <?php endif; ?>

                <div class="hero-buttons">
                    <a href="<?php echo esc_url(home_url('/shop')); ?>" class="btn btn-primary">Shop products</a>
                    <a href="<?php echo esc_url(home_url('/blog')); ?>" class="btn btn-secondary">Read the blog</a>
                </div>
            </div>

            <div class="hero-image">
                <?php if ($hero_img = get_field('hero-image')) : ?>
                    <img src="<?php echo esc_url($hero_img); ?>" alt="<?php echo esc_attr(get_field('hero-title') ?: get_bloginfo('name')); ?>">
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- brand message -->
    <section class="brand-message">
        <div class="brand-container">
            <h2><?php echo esc_html(get_field('brand-title') ?: 'Why choose Moto Shop'); ?></h2>
            <p><?php echo esc_html(get_field('brand-description') ?: 'We provide precision-tuned motorcycles and rigorously tested gear designed for longevity, safety, and uncompromising performance.'); ?></p>
        </div>
    </section>

</main>

<?php get_footer(); ?>