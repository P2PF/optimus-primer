<?php get_template_part( 'templates/head' ); ?>
<?php $rtl = petal_get_option( 'is-rtl', false ); ?>
<body <?php body_class('page-template-template-home-transparent-header'); ?><?php if ($rtl): ?> dir="<?php echo esc_attr('rtl'); ?>"<?php endif; ?>>
	<?php get_template_part( 'templates/header-mobile' ); ?>
	<?php get_template_part( 'templates/header' ); ?>
