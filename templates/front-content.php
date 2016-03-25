<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="article-container">
	
	  <header class="entry-header">
	    <?php do_action('get_entry_header'); ?>
	    
	    <?php do_action('get_entry_meta'); ?>
	  </header>

	  <div class="entry-content">
	    <?php the_content(); ?>
	  </div>
	  
	</div>
</article><!-- /article -->
