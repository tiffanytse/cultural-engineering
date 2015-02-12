<?php


//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );


//* Add excerpt to pages
add_action( 'init', 'my_add_excerpts_to_pages' );
function my_add_excerpts_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
}

//* Add featured image above title for individual page
add_action( 'genesis_entry_header', 'single_post_featured_image', 5 );

function single_post_featured_image() {	
	if ( ! is_singular( 'page' ) )
    return;
    $img = genesis_get_image( array( 'format' => 'html', 'size' => genesis_get_option( 'image_size' ), 'attr' => array( 'class' => 'post-image' ) ) );
    printf( '%s', $img );
}

//* Customize the post meta function
add_filter( 'genesis_post_meta', 'sp_post_meta_filter' );
function sp_post_meta_filter($post_meta) {
  if ( !is_page() ) {
  	$post_meta = '[post_tags before=" <i></i><span>Tagged: </span> "]';
  	return $post_meta;
  }
}


//* Customize the entry meta in the entry header (requires HTML5 theme support)
add_filter( 'genesis_post_info', 'sp_post_info_filter' );
function sp_post_info_filter($post_info) {
  $post_info = '[post_date] [post_edit]';
  return $post_info;
}

//* Add Push Menu Scripts
add_action( 'wp_enqueue_scripts', 'culturalengineering_load_scripts');
function culturalengineering_load_scripts() {

    // CSS
    wp_enqueue_style( 'culturalengineering_mmenu_css' , CHILD_URL . '/css/jquery.mmenu.css' , null );
    wp_enqueue_style( 'culturalengineering_positioning_css' , CHILD_URL . '/css/jquery.mmenu.positioning.css' , null );
    
    // JS
    wp_enqueue_script( 'culturalengineering_mmenu_js' , CHILD_URL . '/js/jquery.mmenu.min.js' , array( 'jquery' ), '4.2.6', FALSE ); // mmenu js
    wp_enqueue_script( 'culturalengineering_headerscript_js' , CHILD_URL . '/js/headerscript.js' , array( 'jquery' ), '1.0', FALSE ); // custom header j

}
  // Add ID attribute to primary wrapper
  add_filter( 'genesis_attr_nav-primary', 'culturalengineering_primary_nav_id' );
  function culturalengineering_primary_nav_id( $attributes ) {

      $attributes['id'] = 'menu';
      return $attributes;

  }
  /* Navigation functions */
  add_action( 'genesis_before', 'culturalengineering_nav_control', 1 );
  function culturalengineering_nav_control() {
      ?>
      <div id="mobile-header">
          <a href="#menu">
              <i class="i-menu"></i>
              <span>Mobile Menu</span>
          </a>
      </div>
      <?php
  }

//* Add Child Page Shortcode
function wpb_list_child_pages() { 
  global $post; 
  $pageChildren =  get_pages( array( 'child_of' => $post->ID, 'orderby'       => 'post_date', 'hierarchical' => '0' ) );
  if ( $pageChildren ) {
    foreach ( $pageChildren as $pageChild ) {
      echo '<section class="issue-blocks issue-'. $pageChild->ID .'"><div class="inner"><a href="'. get_permalink($pageChild->ID) .'">'. get_the_post_thumbnail($pageChild->ID, 'medium').'<h2>' . $pageChild->post_title .'</h2>';
      if ($pageChild->post_excerpt){
        echo '<p>'. $pageChild->post_excerpt.'</p>';
      }
      echo get_post_meta($pageChild->ID, 'custom-field-name', true);
      echo '</div></section></a>';
    }
  }
}
add_shortcode('wpb_childpages', 'wpb_list_child_pages');

// Custom Field Key Info
function get_custom_field_data($key, $echo = false) {
  global $post;
  $value = get_post_meta($post->ID, $key, true);
  if($echo == false) {
    return $value;
  } else { 
    echo $value;
  }
}

//* Customize the credits
add_filter( 'genesis_footer_creds_text', 'sp_footer_creds_text' );
function sp_footer_creds_text() {

  echo '<div class="creds first"><p>';
  echo 'Copyright &copy; ';
  echo date('Y');
  echo ' &middot; <a href="http://sawvideo.com">SAW Video Media Art Centre</a> &middot; Design and Development by <a href="http://tiffanytse.ca" title="Tiffany Tse">Tiffany Tse</a>';
  echo '</p></div>';
}

// Show Footer Widget Areas only on homepage
add_theme_support( 'genesis-footer-widgets', 3 );
add_action( 'genesis_after_content_sidebar_wrap', 'sk_footer_widget_areas' );
function sk_footer_widget_areas() {

  if ( is_home() || is_front_page() || is_page('contact') || is_page('about') || is_page('artists'))
    return;

  remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );

}


// add theme support for a footer navigation menus
add_theme_support( 'genesis-menus', array( 
  'primary' => 'Primary Navigation Menu' ,
  'secondary' => 'Secondary Navigation Menu' ,
  'footer_1' => 'Footer Navigation Menu 1',
  'footer_2' => 'Footer Navigation Menu 2',
  'footer_3' => 'Footer Navigation Menu 3',
  'footer_4' => 'Footer Navigation Menu 4'
) );



// display the Footer Navigation
add_action('genesis_footer', 'wdm_add_footer_menu');
function wdm_add_footer_menu()
{
    echo '<div class="presented-by col-1">';
    echo '<p class="by-line">A Project of SAW Video Media Art Centre</p>';
    echo '<a href="http://sawvideo.com" class="sawvideo">SAW Video</a>';
    echo '<div class="sponsors">';
    echo '<p>Funding Sponsors</p>';
    echo '<a href="http://www.canadacouncil.ca/" class="cc" target="_blank" title="Canada Council for the Arts">Canada Council for the Arts</a>';
    echo '<a href="http://ottawa.ca/en/liveculture/community-arts-and-social-engagement" class="case"  target="_blank" title="Community Arts + Social Engagement">Community Arts + Social Engagement</a>';
    echo '<a href="http://www.arts.on.ca/site4.aspx" class="oac" target="_blank" title="Ontario Arts Council">Ontario Arts Council</a>';
    echo '<a href="http://ottawa.ca/en" target="_blank" title="City of Ottawa" class="ottawa">City of Ottawa</a>';

    echo '</div>';
    echo '</div>';
    wp_nav_menu(array(
      'sort_column' => 'menu_order',
      'container_id' => 'footer_1' ,
      'menu_class' => 'menu-tertiary',
      'theme_location' => 'footer_1',
      'depth' => 1,
      'items_wrap'  => '<div class="col-2"><h6>Issues</h6><ul id="%1$s" class="%2$s">%3$s</ul></div>'
    ) );
    wp_nav_menu(array(
      'sort_column' => 'menu_order',
      'menu'            => 'Footer Navigation Menu 1',
      'container_id' => 'footer_2' ,
      'menu_class' => 'menu-tertiary',
      'theme_location' => 'footer_2',
      'depth' => 1,
      'items_wrap'  => '<div class="col-3"><h6>Artists</h6><ul id="%1$s" class="%2$s">%3$s</ul></div>'
    ) );
    wp_nav_menu(array(
      'sort_column' => 'menu_order',
      'menu'            => 'Footer Navigation Menu 1',
      'container_id' => 'footer_3' ,
      'menu_class' => 'menu-tertiary',
      'theme_location' => 'footer_3',
      'depth' => 1,
      'items_wrap'  => '<div class="col-3"><h6>About</h6><ul id="%1$s" class="%2$s">%3$s</ul></div>'
    ) );
    wp_nav_menu(array(
      'sort_column' => 'menu_order',
      'menu'            => 'Footer Navigation Menu 1',
      'container_id' => 'footer_4' ,
      'menu_class' => 'menu-tertiary',
      'theme_location' => 'footer_4',
      'depth' => 1,
      'items_wrap'  => '<div class="col-3"><h6>Follow Us</h6><ul id="%1$s" class="%2$s">%3$s</ul></div>'
    ) );
}
