<?php
/*
	Template Name: Front Page

	TODO:
		Finish all three sections.
*/
?>
<?php get_template_part('templates/head'); ?>

<?php do_action('get_before_world'); ?>

<main class="world">
  <div class="world-container">

    <div class="content-wrapper">

    	<div id="front-page">
	    	<?php
	    		$query = Template::get_instance()->get_front_page_query();
	    		while ($query->have_posts()) : $query->the_post();
		    		get_template_part('templates/content', get_post_format());
	    		endwhile;
	    	?>
    	</div>

    </div>

    <?php get_template_part('templates/loop-navigation'); ?>

  </div>
</main><!-- /world -->

<?php do_action('get_after_world'); ?>

<?php get_template_part('templates/footer'); ?>
