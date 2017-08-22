<?php
/**
 * @package WordPress
 * @subpackage Wheels
 *
 * Template Name: Home page (Full Width No Content)
 */
get_header();
function first_word($str) {
    $arr=explode(" ",$str);
    print $arr[0];
}
$img = get_stylesheet_directory_uri() . '/public/img';
?>
<div id="front">
    <img id="logo" src="<?php echo $img ?>/home-logo.svg">
    <img id="welcome" src="<?php echo $img ?>/home-welcome.png" class="animate bounceInLeft">
</div>
<div id="back">


    <?php
    $args = array(
        'post_parent' => 0,
        'post_type' => 'page',
        'orderby' => 'menu_order',
        'order' => 'ASC',
        'post__not_in' => array($post->ID),
    );

    $child_query = new WP_Query($args);
    ?>

    <?php while ($child_query->have_posts()) : $child_query->the_post(); ?>
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
                    <h2><?php print the_title("","",false); ?></h2>
                    <a href="<?php the_permalink(); ?>">
                        <div class="grid-block-hover">
                            <div class="excerpt">
                                <?php the_excerpt(); ?>
                                <span class="btn">Read more</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </a>
    <?php endwhile; ?>

    <?php
    wp_reset_postdata();
    ?>
</div>
<?php get_footer(); ?>
<script>
    window.$ = jQuery;
    $(function () {
        $('#front').on('click', function () {
            $(this).addClass('animated zoomOutLeft');
        });
    });
</script>