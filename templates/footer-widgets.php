<?php

if ( is_active_sidebar('footer-widgets') ):
$class = Template::get_instance()->get_widget_count_class('footer-widgets');

?>

	<div class="footer-area-container <?php echo $class ?>">
		<?php dynamic_sidebar('footer-widgets'); ?>
	</div>

<?php endif; ?>