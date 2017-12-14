<?php
/**
 * @package WordPress
 * @subpackage Wheels
 *
 * Template Name: Full Width No Container
 */
get_header();
?>
<?php get_template_part( 'templates/title' ); ?>
<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<?php the_content(); ?>
	<?php endwhile; ?>
<?php endif; ?>
<div class="nav-links">
    <?php
    $next_post = get_previous_post();
    if (!empty($next_post)): ?>
		<a href="<?php echo get_permalink($next_post->ID); ?>">
			<div class="prev equalheight">
				<h2><?php echo $next_post->post_parent==0 || $next_post->post_parent != $current_post->post_parent ? "Previous section" : "Previous article" ?></h2>
                <?php echo $next_post->post_title; ?>
			</div>
		</a>
    <?php endif; ?>
    <?php
    $next_post = get_next_post();
    if (!empty($next_post)): ?>
		<a href="<?php echo get_permalink($next_post->ID); ?>">
			<div class="next equalheight">
				<h2><?php echo $next_post->post_parent==0 || $next_post->post_parent != $current_post->post_parent ? "Next section" : "Next article" ?></h2>
                <?php echo $next_post->post_title; ?>
			</div>
		</a>
    <?php endif; ?>
</div>
<?php get_footer(); ?>
