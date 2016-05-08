<!DOCTYPE html>
<!--[if lt IE 9]>
<html class="ie lt-ie9" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php

    wp_head();
    ?>

</head>

<body <?php body_class(); ?>>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-2004323-5', 'auto');
  ga('send', 'pageview');

</script>
<?php harmonux_lt_ie7_info(); //display info if IE lower than 7  ?>
<div class="top-bar-outer">
	<?php
	//fixed top bar option
	$fixed = __HARMONUX::option( 'project_fixed_topbar' );
	?>

<div id="top-bar" class="top-bar home-border<?php get_header_fixed_class(); ?>">

	<div class="row">
		<div class="columns large-4 medium-6  small-8">
            <?php
            /**
             * Add Theme logo : template_tags
             */
            harmonux_logo()
            ?>
    </div>


		<div class="columns large-12 medium-10 small-8">
			<!--falayout search menu-->
			<?php harmonux_searchmenu(); //display search menu ?>

			<nav id="top-navigation" class="left show-for-large-up">
				<a class="harmonux-wai-info harmonux-skip-link" href="#content" title="<?php esc_attr_e( 'Skip to content', 'harmonux' ); ?>"><?php _e( 'Skip to content', 'harmonux' ); ?></a>
				<?php
				if ( has_nav_menu( 'top_pages' ) ) {
					wp_nav_menu(array('theme_location' => 'top_pages', 'menu_class' => 'harmonux-menu harmonux-top-menu'));
				}
				?>
			</nav>
		</div>
	</div>
	<div class="row">
		<div class="columns large-16 smartlib-toggle-area" id="toggle-search">
			<?php harmonux_searchform(); //display toggle form search  ?>
		</div>
	</div>
</div>
</div>
<?php
	if(!is_front_page()){
?>
<div class="smartlib-special-area">
	<div class="row">
		<div class="columns large-16">
			<?php
			harmonux_get_header(); //display header info or header image
			harmonux_breadcrumb();

			?>
		</div>
	</div>
</div>
		<?php
	}
?>
<div id="wrapper" class="row">
	<div id="page" role="main" class="<?php echo get_class_of_component('content') ?>">

		<?php
if(is_front_page()){
	?>
	<?php
	harmonux_get_header(); //display header info or header image
		?>
		<?php
}
		?>





