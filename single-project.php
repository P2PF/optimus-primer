<?php
/**
 */
get_header();
$current_post = get_post();
?>

<div class="<?php echo petal_class( 'page-title-row' ); ?>">
    <div class="<?php echo petal_class( 'container' ); ?>">
        <div class="<?php echo petal_class( 'page-title-grid-wrapper' ); ?>">
            <h1 class="<?php echo petal_class( 'page-title' ); ?>"><?php echo petal_title(); ?></h1>
            <?php if ( is_home() && $blog_archive_subtitle ) : ?>
                <h2 class="<?php echo petal_class( 'page-subtitle' ); ?>"><?php echo esc_html( $blog_archive_subtitle ); ?></h2>
            <?php elseif ( is_page() || petal_is_shop() || ( is_single() && get_post_type() == 'project' ) ) : ?>
                <?php global $post;
                if (petal_is_shop()) {
                    $post_id = petal_get_shop_page_id();
                } else {
                    $post_id = $post->ID;
                }
                $subtitle = petal_get_rwmb_meta( 'subtitle_single_page', $post_id ); ?>
                <?php if ( $subtitle ) : ?>
                    <h2 class="<?php echo petal_class( 'page-subtitle' ); ?>"><?php echo esc_html( $subtitle ); ?></h2>
                <?php endif; ?>
            <?php elseif ( is_single() ) : ?>
                <?php get_template_part( 'templates/entry-meta' ); ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php get_template_part('templates/title'); ?>
<div class="<?php echo petal_class('main-wrapper') ?>">
    <div class="<?php echo petal_class('container') ?>">
        <div class="<?php echo petal_class('content-fullwidth') ?>">

            <?php while ( have_posts() ) : the_post(); ?>
                <?php $current_post = get_post(); ?>
                <div <?php post_class(); ?>>
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
</div>
<?php get_footer(); ?>
<script>
</script>