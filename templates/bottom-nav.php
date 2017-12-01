<?php
$current_post = get_post();
?>
<div class="nav-links">
        <?php
        $next_post = get_previous_post();
        if (!empty($next_post)): ?>
            <a href="<?php echo get_permalink($next_post->ID); ?>">
                <div class="prev">
                    <h2><?php echo $next_post->post_parent == $current_post->post_parent ? "Previous article" : "Previous section" ?></h2>
                    <?php echo $next_post->post_title; ?>
                </div>
            </a>
        <?php endif; ?>
<?php
$next_post = get_next_post();
if (!empty($next_post)): ?>
    <a href="<?php echo get_permalink($next_post->ID); ?>">
        <div class="next">
            <h2><?php echo $next_post->post_parent == $current_post->post_parent ? "Next article" : "Next section" ?></h2>
            <?php echo $next_post->post_title; ?>
        </div>
    </a>
<?php endif; ?>
</div>
