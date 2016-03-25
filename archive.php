<?php get_template_part('templates/head'); ?>

<?php do_action('get_before_world'); ?>

<main class="world">
  <div class="world-container">

    <div class="content-wrapper">


      <?php while (have_posts()) : the_post(); ?>
        <?php get_template_part('templates/content', get_post_format()); ?>
      <?php endwhile; ?>

    </div>

    <?php get_template_part('templates/loop-navigation'); ?>

  </div>
</main><!-- /world -->

<?php do_action('get_after_world'); ?>

<?php get_template_part('templates/footer'); ?>
