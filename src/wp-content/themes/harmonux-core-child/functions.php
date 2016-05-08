<?php

add_action( 'wp_enqueue_scripts', 'srf_enqueue_styles' );
function srf_enqueue_styles() {
    wp_dequeue_style( 'smartlib-structure');

    wp_enqueue_style( 'smartlib-structure', get_template_directory_uri() . '/style.css',
      array( 'harmonux-responsive-tables', 'harmonux-flexslider', 'smartlib-photoswipe-css', 'smartlib-font-icon')
    );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'smartlib-structure', 'harmonux-responsive-tables', 'harmonux-flexslider', 'smartlib-photoswipe-css', 'smartlib-font-icon')
    );
}

add_action('after_setup_theme', 'srf_setup');
function srf_setup() {
  load_theme_textdomain('harmonux', get_template_directory() . '/../harmonux-core-child/languages');
}

add_action( 'wp_footer', 'srf_footer' );
function srf_footer() {
  if (is_single()):
    ?>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-572e04a1b1e24ca4"></script>
    <?php
  endif;
}
