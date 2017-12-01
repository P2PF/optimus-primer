<?php
/**
 * @package WordPress
 * @subpackage Wheels
 *
 * Template Name: Glossary entry
 */
get_header();
?>
<div class="cbp-row wh-page-title-bar">
    <div class="cbp-container">
        <div class="one whole wh-padding wh-page-title-wrapper">
            <h1 class="page-title">
                <?php the_title(); ?>
        </div>
    </div>
</div>
<?php get_template_part( 'templates/breadcrumbs' ); ?>

<div class="<?php echo petal_class('main-wrapper') ?>">
    <div class="<?php echo petal_class('container') ?>">
        <div class="<?php echo petal_class('content-fullwidth') ?>">

            <?php while ( have_posts() ) : the_post(); ?>
                <div <?php post_class(); ?>>
                    <div class="thumbnail">
                        <?php petal_get_thumbnail( array( 'thumbnail' => 'petal-featured-image' ) ); ?>
                    </div>
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                    <?php if ( petal_get_option( 'archive-single-use-share-this', false ) ): ?>
                        <?php petal_social_share(); ?>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>

        </div>
    </div>
    <?php get_template_part('templates/bottom-nav'); ?>
</div>
<?php get_footer(); ?>
