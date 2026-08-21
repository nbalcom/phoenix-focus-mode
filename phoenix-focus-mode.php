<?php
/**
 * Plugin Name: Phoenix Focus Mode
 * Description: Uses a simple post tag ("focus-mode") to strip away auxiliary UI elements and maximize content focus.
 * Version: 1.2.0
 * Author: Nate Balcom
 * Author URI: https://natebal.com
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * 1. Inject Dynamic Body Class if the post has the 'focus-mode' tag
 */
function phoenix_focus_body_class( $classes ) {
    if ( is_singular() && has_tag( 'focus-mode' ) ) {
        $classes[] = 'phoenix-focus-active';
    }
    return $classes;
}
add_filter( 'body_class', 'phoenix_focus_body_class' );

/**
 * 2. Frontend CSS Rules
 */
function phoenix_focus_frontend_styles() {
    if ( is_singular() && has_tag( 'focus-mode' ) ) :
    ?>
    <style>
        /* 
         * When Focus Mode is checked on this post, 
         * these targeted classes/elements will be hidden.
         */
        nb-article__title,
        nb-jump-link-wrap,
        nb-article-meta-row,
        nb-reading-time-container,
        eeat-author-inner,
        eeat-author-box glimmery-border-wrap alignwide wp-block-group __web-inspector-hide-shortcut__,
        shortlist-glow,
        {
            display: none !important;
        }
    </style>
    <?php
    endif;
}
add_action( 'wp_head', 'phoenix_focus_frontend_styles' );
