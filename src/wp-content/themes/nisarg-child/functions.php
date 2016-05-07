<?php

function theme_enqueue_styles() {

  $parent_style = 'parent-style';

  wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css', array('bootstrap'));
  wp_enqueue_style('nisarg-style',
      get_stylesheet_directory_uri() . '/style.css',
      array($parent_style, )
  );
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');