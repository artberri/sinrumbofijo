<?php

add_action( 'wp_enqueue_scripts', 'srf_enqueue_styles' );
function srf_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}

add_action('after_setup_theme', 'srf_setup');
function srf_setup() {
  load_theme_textdomain('harmonux', get_template_directory() . '/../harmonux-core-child/languages');
}


function srf_wpsocialite_markup($args = array()) {
  $wpsocialite = new wpsocialite();
  $response = $wpsocialite->wpsocialite_markup($args);

  return $response;
}
