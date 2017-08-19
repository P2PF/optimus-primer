<?php
/**
 * @package WordPress
 * @subpackage Wheels
 *
 * Template Name: Page index list
 */
get_header();
?>
<?php get_template_part('templates/title'); ?>
<div class="<?php echo petal_class('main-wrapper') ?>">
    <div class="<?php echo petal_class('container') ?>">


        <div class="<?php echo petal_class('content-fullwidth') ?>">
            <?php get_template_part('templates/content-page'); ?>


            <div class="page-list">

                <?php
                $args = array(
                    'post_parent' => $post->ID,
                    'post_type' => 'page',
                    'orderby' => 'menu_order',
                    'order' => 'ASC',
                );

                $child_query = new WP_Query($args);
                ?>
                <?php while ($child_query->have_posts()) : $child_query->the_post(); ?>
                        <div class="page-entry">
                            <a href="<?php the_permalink(); ?>" rel="bookmark"
                               title="<?php the_title_attribute(); ?>" class="">
                                <h2><?php the_title() ?></h2></a>
                            <div class="excerpt"><?php the_excerpt() ?></div>
                            </a>
                            <hr>
                        </div>
                <?php endwhile; ?>

                <?php
                wp_reset_postdata();
                ?>

            </div>
        </div>
    </div>
    <div class="nav-links">
        <div class="prev">
            <?php
            $next_post = get_previous_post();
            if (!empty($next_post)): ?>
                <a href="<?php echo get_permalink($next_post->ID); ?>"><h2>Previous section</h2>
                    <?php echo $next_post->post_title; ?></a>
            <?php endif; ?>

        </div>
        <div class="next">
            <?php
            $next_post = get_next_post();
            if (!empty($next_post)): ?>
                <a href="<?php echo get_permalink($next_post->ID); ?>"><h2>Next section</h2>
                    <?php echo $next_post->post_title; ?></a>
            <?php endif; ?>
        </div>
    </div>
</div>
<script>
    jQuery(function () {
    });
</script>
<?php get_footer(); ?>