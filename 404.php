<?php get_template_part('templates/head'); ?>

<?php do_action('get_before_world'); ?>

<main class="world">
  <div class="world-container">

    <div class="content-wrapper">
      
	<article>
		<div class="article-container">
		
		  <header class="entry-header">
		    <h1>404</h1>
		    <h2>That's an error.</h2>
		  </header>

		  <div class="entry-content">

		  	<p>The page you were looking for does not exist as such.</p>
		  	<ul>
		  		<li>It is possible it was erronous content and was removed.</li>
		  	</ul>

		  	<?php do_action('get_404_entry'); ?>

		  </div>

		  
		</div>
	</article><!-- /article -->

    </div>

  </div>
</main><!-- /world -->

<?php do_action('get_after_world'); ?>

<?php get_template_part('templates/footer'); ?>

