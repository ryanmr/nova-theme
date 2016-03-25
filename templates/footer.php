</div><!-- /galaxy -->

<?php do_action('get_footer'); ?>
<footer class="footer">
  <div class="footer-container">

  		<?php get_template_part('templates/footer-widgets'); ?>

      <div class="endpoint">
		<p class="source-org copyright">&copy; <?php echo date('Y'); ?> &blacksquare; <a href="<?php echo home_url(); ?>"><?php echo get_bloginfo('name'); ?></a> &blacksquare; <a class="theme-toggle" href="#">theme toggle</a></p>
      </div>

  </div>
</footer><!-- /footer -->

</div><!-- /unvierse -->

<?php wp_footer(); ?>

</body>
</html>
