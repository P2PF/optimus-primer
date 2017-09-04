<?php
/**
 * @package WordPress
 * @subpackage Wheels
 *
 * Template Name: Page index
 */
get_header();
?>
<div class="cbp-row wh-page-title-bar">
    <div class="cbp-container">
        <div class="one whole wh-padding wh-page-title-wrapper">
            <h1 class="page-title"><span class="number"></span> <span class="firstWord">Glossary Terms</span> <span class="nextWords"></span></h1>
        </div>
    </div>
</div>
<?php get_template_part( 'templates/breadcrumbs' ); ?>

<div class="<?php echo petal_class('main-wrapper') ?>">
    <div class="<?php echo petal_class('container') ?>">
        <div class="<?php echo petal_class('content-fullwidth') ?>">
            <?php get_template_part('templates/content-single'); ?>
        </div>
    </div>
</div>
<script>
    jQuery(function () {
    });
</script>
<?php get_footer(); ?>
