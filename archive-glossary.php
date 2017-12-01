<?php
/**
 * @package WordPress
 * @subpackage Wheels
 */

$blog_archive_layout = petal_get_option('blog-archive-layout', 'default');

// Override archive layout
$blog_archive_layout = 'fullwidth';

$blog_archive_is_boxed = $blog_archive_layout == 'boxed' || $blog_archive_layout == 'boxed-fullwidth';
$blog_archive_is_fullwidth = $blog_archive_layout == 'fullwidth' || $blog_archive_layout == 'boxed-fullwidth';

if ($blog_archive_is_boxed) {
    get_header('boxed');
} else {
    get_header();
}
$content_class = $blog_archive_is_fullwidth ? 'content_fullwidht' : 'content';
?>
<?php get_template_part('templates/title'); ?>
<div class="<?php echo petal_class('main-wrapper') ?>">
    <div class="<?php echo petal_class('container') ?>">
        <div class="<?php echo petal_class($content_class) ?>">
            <div class="entry-list">
                <?php if (have_posts()): ?>
                    <?php while (have_posts()) : the_post(); ?>

                        <div class="entry-content">
                            <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <?php the_content(); ?>
                        </div>

                    <?php endwhile; ?>
                <?php else: ?>
                    <?php get_template_part('templates/content', 'none'); ?>
                <?php endif; ?>
                <div class="<?php echo petal_class('pagination') ?>">
                    <?php petal_pagination(); ?>
                </div>
            </div>
        </div>
        <?php if (!$blog_archive_is_fullwidth) : ?>
            <div class="<?php echo petal_class('sidebar') ?>">
                <?php get_sidebar(); ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php
if ($blog_archive_is_boxed) {
    get_footer('boxed');
} else {
    get_footer();
}
?>
