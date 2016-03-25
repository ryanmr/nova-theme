<?php

class Template {

  use Singleton;

  public function initialize() {
  
    add_filter('wp_title', array($this, 'get_title'), 10, 2);

    add_action('get_entry_header', array($this, 'get_entry_header'));
    add_action('get_entry_meta', array($this, 'get_entry_meta'));
    add_action('get_entry_footer', array($this, 'get_entry_footer'));
  
  }

  public function get_title($title, $sep) {
    $sep = '&#8250;';
    $name = get_bloginfo('name');

    if ( is_front_page() || is_home() ) {
      $description = get_bloginfo('description');
      return "$name $sep $description";
    }

    if ( is_feed() ) {
      return $title;
    }

    if ( is_category() ) {
      $title = "$title $sep Archive";
    }

    if ( is_single() ) {
      $title = "$title";
    }

    return "$title $sep $name";

  }

  public function get_entry_header() {

    $html = '<%1$s class="entry-title"><a href="%2$s">%3$s</a></%1$s>';

    $tag = 'h2';

    if ( !is_home() && !is_front_page() ) {
      $tag = 'h1';
    }

    $link = get_the_permalink();
    $source = apply_filters('link_attribution_source', '');

    if ( has_post_format('link') && !empty( $source ) ) {
      $link = $source;
    }

    $output = sprintf(
      $html,
      $tag,
      $link,
      get_the_title()
    );

    echo $output;

  }

  public function get_entry_meta() {

    $bsq = '<span class="separator">▪</span>';

    $html = '<div class="entry-meta">%2$s %1$s %3$s %4$s</div>';

    $attribution = '';

    if ( is_single() ) {
      $attribution = $this->get_link_attribution();
    }

    $output = sprintf(
      $html,
      $bsq,
      $this->get_entry_time(),
      $this->get_permalink(),
      $attribution
    );

    echo $output;

  }

  public function get_link_attribution() {

    if ( !has_post_format('link') ) return '';

    $bsq = '<span class="separator">▪</span>';

    $html = array();
    $source = apply_filters('link_attribution_source', '');
    $via = apply_filters('link_attribution_via', '');

    if ( !empty($source) ) {
      $source_html = '<span class="source"><a href="%1$s" target="_blank">source</a></span>';
      $source_html = sprintf($source_html, esc_url($source));
      $html[] = "{$source_html}";
    }

    if ( !empty($via) ) {
      $via_html = '<span class="via"><a href="%1$s" target="_blank">via</a></span>';
      $via_html = sprintf($via_html, esc_url($via));
      $html[] = "{$via_html}";
    }

    $output = join($bsq, $html);

    if ( strlen($output) > 0 ) {
      $output = "$bsq {$output}";
    }

    return $output;

  }

  public function get_permalink() {

    $html = '<span class="permalink"><a href="%1$s">∞</a></span>';

    $output = sprintf($html,
      esc_url( get_permalink() )
    );

    return $output;

  }

  public function get_byline() {

    $html = '<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>';

    $permalink = esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );
    $name = esc_html( get_the_author() );

    $output = sprintf(
      $html,
      $permalink,
      $name
    );

    return $output;

  }

  public function get_entry_footer() {
    $category_list = get_the_category_list( ', ' );
    $categories = get_the_category();


    $tag_list = get_the_tag_list( '', ', ' );
    $tags = get_the_tags();

    $output = '';

    if ( $categories != false && count($categories) > 0 && $categories[0]->slug != 'uncategorized' ) {
      $html = '<div class="entry-categories">%1$s: %2$s</div>';
      $output .= sprintf($html, _n('Category', 'Categories', count($categories)), $category_list );
    }

    if ( $tags != false && count($tags) > 0 ) {
      $html = '<div class="entry-tags">%1$s: %2$s</div>';
      $output .= sprintf($html, _n('Tagged', 'Tagged', count($tags)), $tag_list );
    }

    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
      $html = '<div class="updated-on"><time class="updated" datetime="%1$s">Updated: %2$s</time></div>';
      $output .= sprintf( $html,
        esc_attr( get_the_modified_date( 'c' ) ),
        esc_html( get_the_modified_date() )
      );
    }

    if ( true ) {
      $html = '<div class="posted-on"><time class="entry-date published" datetime="%1$s">Published: %2$s</time></div>';
      $output .= sprintf(
        $html,
        esc_attr( get_the_date('c') ),
        esc_html( get_the_date() )
      );      
    }

    echo $output;
  }

  public function get_entry_time() {
    $html = '<span class="posted-on"><time class="entry-date published" datetime="%1$s">%2$s</time></span>';

    $output = sprintf(
      $html,
      esc_attr( get_the_date('c') ),
      esc_html( get_the_date() )
    );

    return $output;

  }

  public function get_widget_count_class($location = '') {
    $count = $this->get_widget_count($location);

    $template = 'widget-count-%1$s';

    return sprintf($template, $count);
  }

  public function get_widget_count($location = '') {
    if ($location == '') {
      return 0;
    }

    $sidebars = wp_get_sidebars_widgets();

    if ( !isset($sidebars[$location]) ) {
      return 0;
    }

    return count($sidebars[$location]);

  }

  public function get_front_links_query() {
    $arguments = array(
      'posts_per_page' => 5,
      'tax_query' => array(
        array(
          'taxonomy' => 'post_format',
          'field' => 'slug',
          'terms' => 'post-format-link'
        )
      )
    );

    $query = new WP_Query($arguments);

    return $query;

  }

  public function get_front_standard_query() {
    $arguments = array(
      'posts_per_page' => 5,
      'tax_query' => array(
        array(
            'taxonomy' => 'post_format',
            'field' => 'slug',
            'terms' => array('post-format-link'),
            'operator' => 'NOT IN'
        )
      )
    );

    $query = new WP_Query($arguments);

    return $query;
  }

  public function get_front_page_query() {

    $arguments = array(
      'posts_per_page' => 25,
    );

    $query = new WP_Query($arguments);

    return $query;

  }

  
}