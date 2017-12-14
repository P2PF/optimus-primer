<?php
/**
 * @package WordPress
 * @subpackage Wheels
 *
 * Template Name: Case study list
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
                    'nopaging' => true,
                );

                $child_query = new WP_Query($args);
                ?>
                <?php while ($child_query->have_posts()) : $child_query->the_post(); ?>
                        <div class="page-entry">
                            <a href="<?php the_permalink(); ?>" rel="bookmark"
                               title="<?php the_title_attribute(); ?>" class="">
                                <h2><?php the_title() ?></h2>
                            </a>
                            <div class="link">
                                <a href="<?php the_permalink(); ?>" rel="bookmark"
                                   title="<?php the_title_attribute(); ?>" class="">
                                    Read the article here
                                </a>
                            </div>
                            </a>
                        </div>
                <?php endwhile; ?>

                <?php
                wp_reset_postdata();
                ?>

            </div>
        </div>
    </div>
</div>
<?php
$current_post = get_post();
?>
<!--bottom-nav-->
<div class="nav-links">
    <?php
    $next_post = get_previous_post();
    if (!empty($next_post)): ?>
        <a href="<?php echo get_permalink($next_post->ID); ?>">
            <div class="prev equalheight">
                <h2><?php echo $next_post->post_parent == $current_post->post_parent ? "Previous article" : "Previous section" ?></h2>
                <?php echo $next_post->post_title; ?>
            </div>
        </a>
    <?php endif; ?>
    <?php
    $next_post = get_next_post();
    if (!empty($next_post)): ?>
        <a href="<?php echo get_permalink($next_post->ID); ?>">
            <div class="next equalheight">
                <h2><?php echo $next_post->post_parent == $current_post->post_parent ? "Next article" : "Next section" ?></h2>
                <?php echo $next_post->post_title; ?>
            </div>
        </a>
    <?php endif; ?>
</div>
<!--/bottom-nav-->
<script>
    jQuery(function () {
    });
</script>
<?php get_footer(); ?>
