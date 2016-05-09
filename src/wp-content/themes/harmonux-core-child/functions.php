<?php

require 'lib/class-srf-theme.php';

$srf_theme = new SRF_Theme();

add_action( 'after_setup_theme', array( $srf_theme, 'setup' ) );
add_action( 'wp_enqueue_scripts', array( $srf_theme, 'enqueue_scripts' ) );
add_action( 'wp_footer', array( $srf_theme, 'footer' ) );
