<?php


//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );


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
  	$post_meta = '[post_tags before="Tagged: "]';
  	return $post_meta;
  }
}


//* Customize the credits
add_filter( 'genesis_footer_creds_text', 'sp_footer_creds_text' );
function sp_footer_creds_text() {
  echo '<div class="presented-by one-half">';
  echo '<p class="by-line">A Project of SAW Video</p>';
  echo '<a href="http://sawvideo.com" class="sawvideo">SAW Video</a>';
  echo '</div>';
	echo '<div class="creds first"><p>';
	echo 'Copyright &copy; ';
	echo date('Y');
	echo ' &middot; <a href="http://sawvideo.com">SAW Video</a> &middot; Design and Development by <a href="http://tiffanytse.ca" title="Tiffany Tse">Tiffany Tse</a>';
	echo '</p></div>';
}


//* Add Child Page Shortcode
function wpb_list_child_pages() { 
  global $post; 
  $pageChildren =  get_pages( array( 'child_of' => $post->ID, 'sort_column' => 'menu_order', 'hierarchical' => '0' ) );
  if ( $pageChildren ) {
    foreach ( $pageChildren as $pageChild ) {
      echo '<section class="issue-blocks"><a href="'. get_permalink($pageChild->ID) .'"><h2>' . $pageChild->post_title .'</h2>'. get_the_post_thumbnail($pageChild->ID).'</section></a>';
      if ($pageChild->post_excerpt){
        echo '<p>'.$pageChild->post_excerpt.'</p>';
      }
                  echo get_post_meta($pageChild->ID, 'custom-field-name', true);
    }
  }
}
add_shortcode('wpb_childpages', 'wpb_list_child_pages');

