<?php
/**
 * The template for displaying all pages.
 *
 */

get_header(); ?>

<main id="content" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog" role="main">


    <?php while (have_posts()) : the_post(); ?>
    <?php get_template_part('views/content', 'page'); ?>
    <?php endwhile; // end of the loop. ?>


</main><!-- #content -->


</div><!-- #page -->

<?php
//add sidebar on the right side
if(check_position_of_component('sidebar', 'right'))
	get_sidebar();
?>
</div><!-- #wrapper -->
<?php get_footer(); ?>