<?php
/**
 * @package WordPress
 * @subpackage Wheels
 *
 * Template Name: Home (Full Width No Content)
 */
get_header();
$img = get_stylesheet_directory_uri() . '/public/img';
?>
<div id="front">
    <img id="logo" src="<?php echo $img ?>/home-logo.svg">
    <img id="welcome" src="<?php echo $img ?>/home-welcome.png" class="animate bounceInLeft">
</div>
<div id="back">
    <div class="slice">1</div>
    <div class="slice">2</div>
    <div class="slice">3</div>
    <div class="slice">4</div>
</div>
<?php get_footer(); ?>
<script>
    window.$ = jQuery;
    $(function () {
        $('#front').on('click', function () {
            $(this).hide();
        });
    });
</script>