<?php
/**
 * The Template for displaying all single posts.
 */

get_header();
$category = get_the_category();
?>

<main id="content" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog"  role="main">

    <?php while (have_posts()) : the_post(); ?>

    <?php
    if (get_post_format()) {
        get_template_part('views/content', get_post_format());
    } else {
        get_template_part('views/content', 'single');
    }
    ?>

    <?php harmonux_prev_next_post_navigation(); ?>

	   <?php harmonux_get_related_post_box($category[0]->cat_ID, get_the_ID(), 8, 4); ?>

    <?php comments_template('', true); ?>

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