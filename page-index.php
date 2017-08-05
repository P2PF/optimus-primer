<?php
/**
 * @package WordPress
 * @subpackage Wheels
 *
 * Template Name: Page index
 */
get_header();
?>
<?php get_template_part('templates/title'); ?>
<div class="<?php echo petal_class('main-wrapper') ?>">
    <div class="<?php echo petal_class('container') ?>">
        <div class="<?php echo petal_class('content-fullwidth') ?>">
            <?php get_template_part('templates/content-page'); ?>
            <div class="page-grid">
                <?php
                $pages = get_pages(array('hierarchical' => 0, 'parent' => get_the_ID()));
                foreach ($pages as $page) {
                    ?>
                    <div class="block">
                        <div class="pg1"><?php the_title()  ?></div>
                    </div>
                <?php } ?>
                <pre><?php print_r($pages) ?></pre>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
