<?php
/**
 * The default template for displaying single content.
 *
 */
?>
<div class="post-box">
	<div class="row">
		<div class="columns large-2 medium-2">
			<?php
			if(function_exists('wpsocialite_markup')){
				?>
				<div class="smartlib-soical-widgets">
					<?php	srf_wpsocialite_markup(); ?>
				</div>
				<?php
			}
			?>
			<?php harmonux_entry_tags() ?>
		</div>
		<div class="columns large-14 medium-14">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">

					<h1 class="entry-title"><?php the_title(); ?></h1>
					<?php harmonux_display_meta_post('date'); ?>
					<?php harmonux_category_line(); ?>
				</header>
				<?php get_template_part('views/snippets/image_area') ?>

				<div class="entry-content">
					<?php the_content(); ?>
				</div>
				<?php harmonux_custom_single_page_pagination(); ?>
				<footer class="entry-meta">
				<?php if ( is_singular() && get_the_author_meta( 'description' ) && is_multi_author() ) : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries. ?>
				<div class="author-info" itemprop="author" itemscope="itemscope" itemtype="http://schema.org/Person">

					<?php get_template_part( 'views/snippets/author_info' ); ?>

				</div><!-- .author-info -->
				<?php endif; ?>
				</footer>
			</article>
		</div>
	</div>
	<!-- #post -->
</div><!-- .post-box -->
