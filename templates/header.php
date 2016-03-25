<?php do_action('get_before_header'); ?>

<header class="header">
  <div class="header-container">

    <div class="identity">
      <div class="identity-container">

      <?php
        if ( is_home() || is_front_page() ):
          $primary_tag = "h1";
          $secondary_tag = "h2";
        else:
          $primary_tag = "div";
          $secondary_tag = "div";
        endif;

        $url = get_bloginfo('url');
        $name = get_bloginfo('name');
        // $description = get_bloginfo('description');

      ?>

      <<?php echo $primary_tag; ?> class="site-title">
        <span class="title">
          <a title="<?php echo esc_attr($name); ?>" href="<?php echo esc_attr($url); ?>">
            <?php echo $name; ?>
          </a>
        </span>
      </<?php echo $primary_tag; ?>>

      </div>
    </div>

    <?php do_action('get_after_header'); ?>
    <?php get_template_part('templates/top-navigation'); ?>


  </div>
</header>
