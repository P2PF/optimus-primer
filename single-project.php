<?php
/**
 */
get_header();
$current_post = get_post();
?>
<?php get_template_part('templates/title'); ?>
<div class="<?php echo petal_class('main-wrapper') ?>">
    <div class="<?php echo petal_class('container') ?>">
        <div class="<?php echo petal_class('content-fullwidth') ?>">

            <?php while ( have_posts() ) : the_post(); ?>
                <?php $current_post = get_post(); ?>
                <div <?php post_class(); ?>>
                    <?php if ( ! petal_get_option( 'archive-single-use-page-title', false ) ) : ?>
                        <?php the_title( '<h1>', '</h1>' ); ?>
                    <?php endif; ?>
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>

                    <?php comments_template( '/templates/comments.php' ); ?>
                </div>
            <?php endwhile; ?>


        </div>
    </div>
    <div class="nav-links">
        <?php
        $next_post = get_previous_post();
        if (!empty($next_post)): ?>
            <a href="<?php echo get_permalink($next_post->ID); ?>">
                <div class="prev">
                    <h2><?php echo $next_post->post_parent == $current_post->post_parent ? "Previous article" : "Previous section" ?></h2>
                    <?php echo $next_post->post_title; ?>
                </div>
            </a>
        <?php endif; ?>
        <?php
        $next_post = get_next_post();
        if (!empty($next_post)): ?>
            <a href="<?php echo get_permalink($next_post->ID); ?>">
                <div class="next">
                    <h2><?php echo $next_post->post_parent == $current_post->post_parent ? "Next article" : "Next section" ?></h2>
                    <?php echo $next_post->post_title; ?>
                </div>
            </a>
        <?php endif; ?>
    </div>
</div>
<?php get_footer(); ?>
<script>
</script>