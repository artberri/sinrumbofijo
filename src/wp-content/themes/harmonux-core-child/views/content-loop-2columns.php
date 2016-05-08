<?php
/**
 * The 2 columns template for displaying content.
 */
?>
<div class="post-box columns large-8 column-box">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


        <header class="entry-header">
            <div class="top-meta">
                <?php harmonux_category_line(); ?>
            </div>
            <h2 class="entry-title">
                <a href="<?php the_permalink(); ?>"
                   title="<?php echo esc_attr(sprintf(__('Permalink to %s', 'harmonux'), the_title_attribute('echo=0'))); ?>"
                   rel="bookmark"><?php the_title(); ?></a>
            </h2>
          <?php harmonux_display_meta_post(); ?>
        </header>
        <!-- .entry-header -->
        <div class="row">
            <div class="columns large-16">
                <?php
                $post_format = get_post_format();


                if ( '' != get_the_post_thumbnail() ) {
                    ?>
                   <div class="smartlib-thumbnail-outer"><?php harmonux_get_format_ico($post_format) ?><a href="<?php the_permalink(); ?>"
                                                                                     title="<?php echo esc_attr(sprintf(__('Permalink to %s', 'harmonux'), the_title_attribute('echo=0'))); ?>"
                                                                                     ><?php the_post_thumbnail('medium-square'); ?></a></div>

                    <?php
                }

                    ?>
                    <div class="entry-summary">
                    <?php the_excerpt(); ?>
                    </div><!-- .entry-summary -->
            </div>
        </div>

        <!-- .entry-meta -->
    </article>
    <!-- #post -->
</div><!-- .post-box -->
