<?php get_template_part( 'templates/footer' ); ?>
<footer>
<?php
$img = get_stylesheet_directory_uri() . '/public/img';
?>
    <img id="heinrich" src="<?php echo $img ?>/heinrich-boll-stiftung.png">
    <img id="p2p-footer" src="<?php echo $img ?>/p2pf-footer.png">
    <img id="cc" src="<?php echo $img ?>/cc-by-sa.png" align="right">
</footer>
<?php wp_footer(); ?>
</body>
</html>
