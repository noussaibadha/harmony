<?php
// Support FSE (Full Site Editing)

function amid_setup() {
    add_theme_support( 'block-templates' );
    add_theme_support('block-editor');
    add_theme_support('editor-styles');
    add_theme_support('wp-block-styles');
    add_theme_support('responsive-embeds');
    add_theme_support('align-wide');
}
add_action('after_setup_theme', 'lharmony_setup');

function amid_enqueue_scripts() {
  wp_enqueue_style('lharmony-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'lharmony_enqueue_scripts');

add_theme_support('block-template-parts');