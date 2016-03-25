<?php get_template_part('templates/head'); ?>

<?php do_action('get_before_world'); ?>

<main class="world">
  <div class="world-container">

    <div class="content-wrapper">


      <?php while (have_posts()) : the_post(); ?>
      
    	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="article-container">
			
			  <header class="entry-header">
			    <?php do_action('get_entry_header'); ?>
			    
			    <?php do_action('get_entry_meta'); ?>
			  </header>

			  <div class="entry-content">
			    <?php the_content(); ?>
			  </div>

			  <?php get_template_part('templates/content-footer'); ?>
			  
			</div>
		</article><!-- /article -->
      
      <?php endwhile; ?>

    </div>

  </div>
</main><!-- /world -->

<?php do_action('get_after_world'); ?>

<?php get_template_part('templates/footer'); ?>

