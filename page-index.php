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
                $args = array(
                    'post_parent' => $post->ID,
                    'post_type' => 'page',
                    'orderby' => 'menu_order',
                    'order' => 'ASC',
                );

                $child_query = new WP_Query($args);
                ?>

                <?php while ($child_query->have_posts()) : $child_query->the_post(); ?>
                    <div <?php post_class("grid-block"); ?>>
                        <a href="<?php the_permalink(); ?>" rel="bookmark"
                           title="<?php the_title_attribute(); ?>" class="">
                            <div class="grid-block-base">
                                <?php
                                if (has_post_thumbnail()) {
                                    the_post_thumbnail('page-thumb-mine');
                                }
                                ?>
                                <h2><?php the_title(); ?></h2>
                            </div>
                        </a>
                    </div>
                <?php endwhile; ?>

                <a href="/2-long-articles" rel="bookmark" class="">
                    <!-- alternatively:  one third two-up-small-tablet one-up-mobile -->
                    <div class="grid-block next">
                        <div class="grid-block-base">
                            <h2>Next: long articles</h2>
                        </div>
                    </div>

                </a>


                <?php
                wp_reset_postdata();
                ?>

            </div>
        </div>
    </div>
</div>
<script>
    jQuery(function () {
    });
</script>
<?php get_footer(); ?>
