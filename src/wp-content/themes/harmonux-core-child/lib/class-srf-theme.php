<?php

class SRF_Theme
{
  public function setup() {
    load_theme_textdomain( 'harmonux', get_template_directory() . '/../harmonux-core-child/languages' );
  }

  public function enqueue_scripts() {
    wp_dequeue_style( 'smartlib-structure' );

    wp_enqueue_style( 'smartlib-structure', get_template_directory_uri() . '/style.css',
      array(
        'harmonux-responsive-tables',
        'harmonux-flexslider',
        'smartlib-photoswipe-css',
        'smartlib-font-icon',
      )
    );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array(
          'smartlib-structure',
          'harmonux-responsive-tables',
          'harmonux-flexslider',
          'smartlib-photoswipe-css',
          'smartlib-font-icon',
        )
    );
  }

  public function footer() {
    if ( is_single() ) {
      wp_enqueue_script( 'addthis', '//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-572e04a1b1e24ca4' );
    }
  }
}
