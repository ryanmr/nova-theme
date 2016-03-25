<?php

class Nova {

  use Singleton;

  public function initialize() {
    add_action('after_setup_theme', array($this, 'setup'), 16);
  }

  public function setup() {

    add_theme_support('menus');
    add_theme_support('automatic-feed-links');
    add_theme_support('post-formats', array('aside', 'link') );

    add_action('init', array($this, 'add_menus'));
    add_action('get_primary_navigation', array($this, 'add_primary_menu'));

    add_action('widgets_init', array($this, 'add_sidebars'));

	add_filter('body_class', array($this, 'add_body_classes'));

	add_action('wp_head', array($this, 'add_headers'));
    add_action('init', array($this, 'header_cleanup'));

	add_action('wp_enqueue_scripts', array($this, 'enqueue_styles'));
	add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));

  }

  public function add_menus() {
    $menus = array(
			'primary' => 'Primary Menu',
			'footer' => 'Footer Menu'
		);
		register_nav_menus($menus);
  }

  public function add_primary_menu() {
    $settings = array(

      'container' => false,                           // remove nav container
      'container_class' => '',                        // class of container
      'menu' => 'primary',                                   // menu name
      'menu_class' => 'top-bar-menu',            // adding custom nav class
      'depth' => 5,                                   // limit the depth of the nav
      'fallback_cb' => false,                         // fallback function (see below)
      'walker' => new TopBarWalker()

    );
		wp_nav_menu($settings);
  }

  public function add_sidebars() {
		$footer_area = array(
			'name' => 'Footer Widgets',
			'id' => 'footer-widgets',
			'description' => 'Contains widgets in the footer',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>'
		);

		register_sidebar($footer_area);
	}


	public function enqueue_styles() {
		wp_register_style('nova-style', get_stylesheet_directory_uri() . '/css/app.css', array(), '', 'all' );
		wp_enqueue_style('nova-style');
	}

	public function enqueue_scripts() {
		wp_enqueue_script( 'nova-foundation', get_stylesheet_directory_uri() . '/js/foundation.js', array( 'jquery' ) );
		wp_enqueue_script( 'nova-script', get_stylesheet_directory_uri() . '/js/app.js', array( 'jquery' ) );
	}

  public function add_headers() {}

  public function add_body_classes($classes) {
    $classes[] = 'nova';

    return $classes;
  }

  public function header_cleanup() {
		remove_action('wp_head', 'wp_generator', 1);
		remove_action('wp_head', 'rsd_link' );
		remove_action('wp_head', 'wlwmanifest_link' );
		remove_action('wp_head', 'index_rel_link' );
		remove_action('wp_head', 'parent_post_rel_link', 10, 0 );
		remove_action('wp_head', 'start_post_rel_link', 10, 0 );
		remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
		remove_action('wp_head', 'wp_generator' );
		add_filter('style_loader_src', array($this, 'remove_version'), 9999 );
		add_filter('script_loader_src', array($this, 'remove_version'), 9999 );
		add_filter('style_loader_tag', array($this, 'fix_link_quotes'));
	}

  public function remove_version($source) {
		if ( strpos($source, 'ver=') ) {
			$source = remove_query_arg('ver', $source);
		}
		return $source;
	}

  // this will fix the annoying singular quotes
	public function fix_link_quotes($structure) {
		$fixed = str_replace("'", '"', $structure);
		return $fixed;
	}

}
