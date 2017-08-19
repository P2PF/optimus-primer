<?php get_template_part( 'templates/footer' ); ?>
<footer>
<?php
    $img = get_stylesheet_directory_uri() . '/public/img';
?>
    <a href="https://www.boell.de/en" target="_blank"><img id="heinrich" src="<?php echo $img ?>/heinrich-boll-stiftung.png"></a>
    <a href="https://p2pfoundation.net/" target="_blank"><img id="p2p-footer" src="<?php echo $img ?>/p2pf-footer.png"></a>
    <a href="https://creativecommons.org/licenses/by-sa/4.0/" target="_blank"><img id="cc" src="<?php echo $img ?>/cc-by-sa.png" align="right"></a>
</footer>
<?php wp_footer(); ?>
</body>
</html>
