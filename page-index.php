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
                    <?php for ($i = 0; $i < 4; ++$i) { ?>
                        <a href="<?php the_permalink(); ?>" rel="bookmark"
                           title="<?php the_title_attribute(); ?>" class="">
                            <!-- alternatively:  one third two-up-small-tablet one-up-mobile -->
                            <div <?php post_class("grid-block"); ?>>
                                <div class="grid-block-base">
                                    <?php
                                    if (has_post_thumbnail()) {
                                        the_post_thumbnail('page-thumb-mine');
                                    }
                                    ?>
                                    <h2><?php the_title(); ?></h2>
                                    <a href="<?php the_permalink(); ?>">
                                        <div class="grid-block-hover">
                                            <span class="btn">Read more</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </a>
                    <?php } ?>


                <?php endwhile; ?>

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
