<?php get_template_part('templates/head'); ?>

<!-- search form -->

<?php while (have_posts()) : the_post(); ?>
<?php get_template_part('templates/content', get_post_format()); ?>
<?php endwhile; ?>

<!-- paginate -->

<?php get_template_part('templates/footer');
