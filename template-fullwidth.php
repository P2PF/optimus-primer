<?php
/**
 * @package WordPress
 * @subpackage Wheels
 *
 * Template Name: Full Width
 */
get_header();
?>
<?php get_template_part('templates/title'); ?>
<div class="<?php echo petal_class('main-wrapper') ?>">
    <div class="<?php echo petal_class('container') ?>">
        <div class="<?php echo petal_class('content-fullwidth') ?>">
            <?php get_template_part('templates/content-page'); ?>
        </div>
    </div>
    <div class="nav-links">
        <div class="prev">
            <?php
            $next_post = get_previous_post();
            if (!empty($next_post)): ?>
                <a href="<?php echo get_permalink($next_post->ID); ?>"><h2>Previous article</h2>
                <?php echo $next_post->post_title; ?></a>
            <?php endif; ?>

        </div>
        <div class="next">
            <?php
            $next_post = get_next_post();
            if (!empty($next_post)): ?>
                <a href="<?php echo get_permalink($next_post->ID); ?>"><h2>Next article</h2>
                <?php echo $next_post->post_title; ?></a>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>
