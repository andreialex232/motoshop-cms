<?php

function my_theme_setup() {
    // Automatically add site title to <head>
    add_theme_support('title-tag');
    // Enable featured images for posts
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'my_theme_setup');

function my_theme_scripts() {
    // 1. Enqueue main style.css
    wp_enqueue_style('main-style', get_stylesheet_uri());

    // 2. Enqueue main.js in the footer
    wp_enqueue_script(
        'main-script',
        get_template_directory_uri() . '/assets/main.js',
        array(),
        '1.0.0',
        true // true loads the script right before </body> so elements exist
    );
}
add_action('wp_enqueue_scripts', 'my_theme_scripts');

function remove_comment_website_field($fields) {
    unset($fields['url']);
    return $fields;
}
add_filter('comment_form_default_fields', 'remove_comment_website_field');

