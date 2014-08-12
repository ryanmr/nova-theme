<!doctype html>
<html <?php language_attributes(); ?>>
<head>

<!-- ascii art -->

<title><?php wp_title(''); ?></title>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=yes" />

<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>

<div class="universe">

<?php do_action('get_header'); ?>
<?php get_template_part('templates/header'); ?>

<div class="galaxy">
