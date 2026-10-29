<?php
/**
 * WooCommerce Catch-All Template (woocommerce.php)
 *
 * @package MotoShop
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

get_header(); 
?>

<main id="main-content" class="site-main shop-main">
    <div class="shop-container">
        
        <?php if ( function_exists('is_shop') && ( is_shop() || is_product_taxonomy() ) ) : ?>
            <div class="shop-layout">
                <!-- Product Grid -->
                <div class="shop-content">
                    <?php 
                    if ( function_exists('woocommerce_content') ) {
                        woocommerce_content(); 
                    }
                    ?>
                </div>
            </div>
        <?php else : ?>
            <!-- Single product, Cart, Checkout, Account views or non-WooCommerce fallback -->
            <div class="shop-content-full">
                <?php 
                if ( function_exists('woocommerce_content') ) {
                    woocommerce_content(); 
                } else {
                    while ( have_posts() ) : the_post();
                        the_content();
                    endwhile;
                }
                ?>
            </div>
        <?php endif; ?>

    </div>
</main>

<?php get_footer(); ?>