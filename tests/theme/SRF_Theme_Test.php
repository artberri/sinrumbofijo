<?php

require 'src/wp-content/themes/harmonux-core-child/lib/class-srf-theme.php';

class Harmonux_Core_Child_Test extends PHPUnit_Framework_TestCase {

  public function setUp() {
    parent::setUp();
    WP_Mock::setUp();

    $srf_theme = new SRF_Theme();
  }

  public function tearDown() {
    parent::tearDown();
    WP_Mock::tearDown();
  }

  public function testSetupMethod()
  {
    WP_Mock::wpFunction( 'get_template_directory', array(
        'times' => 1,
        'return' => 'template_directory',
    ) );

    WP_Mock::wpFunction( 'load_theme_textdomain', array(
        'times' => 1,
        'args' => array( 'harmonux', 'template_directory/../harmonux-core-child/languages' )
    ) );

    $srf_theme = new SRF_Theme();
    $srf_theme->setup();
  }

  public function testEnqueueScriptsMethod()
  {
    WP_Mock::wpFunction( 'get_template_directory_uri', array(
        'times' => 1,
        'return' => 'template_directory_uri',
    ) );

    WP_Mock::wpFunction( 'get_stylesheet_directory_uri', array(
        'times' => 1,
        'return' => 'stylesheet_directory_uri',
    ) );

    WP_Mock::wpFunction( 'wp_dequeue_style', array(
        'times' => 1,
        'args' => array( 'smartlib-structure' )
    ) );

    WP_Mock::wpFunction( 'wp_enqueue_style', array(
        'times' => 1,
        'args' => array( 'smartlib-structure', 'template_directory_uri/style.css', array(
          'harmonux-responsive-tables',
          'harmonux-flexslider',
          'smartlib-photoswipe-css',
          'smartlib-font-icon',
        ) )
    ) );

    WP_Mock::wpFunction( 'wp_enqueue_style', array(
        'times' => 1,
        'args' => array( 'child-style', 'stylesheet_directory_uri/style.css', array(
          'smartlib-structure',
          'harmonux-responsive-tables',
          'harmonux-flexslider',
          'smartlib-photoswipe-css',
          'smartlib-font-icon',
        ) )
    ) );

    $srf_theme = new SRF_Theme();
    $srf_theme->enqueue_scripts();
  }

  public function testFooterMethodInSinglePage()
  {
    WP_Mock::wpFunction( 'is_single', array(
        'times' => 1,
        'return' => true,
    ) );

    WP_Mock::wpFunction( 'wp_enqueue_script', array(
        'times' => 1,
        'args' => array( 'addthis', '//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-572e04a1b1e24ca4' ),
    ) );

    $srf_theme = new SRF_Theme();
    $srf_theme->footer();
  }

  public function testFooterMethodNotSinglePage()
  {
    WP_Mock::wpFunction( 'is_single', array(
        'times' => 1,
        'return' => false,
    ) );

    WP_Mock::wpFunction( 'wp_enqueue_script', array(
        'times' => 0,
    ) );

    $srf_theme = new SRF_Theme();
    $srf_theme->footer();
  }
}
