<?php

/**
* Template Name: Home Page Template
* Description: Used as a page template to show newest Issue and  featured page contents.
*/
// Remove header and content
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );


// Add custom content to page
add_action( 'genesis_after_header', 'banner_issue'); // newest issue


function banner_issue() {
	$args = array(
		'category_name' => 'home-page-banner', // replace with your category slug
		'orderby'       => 'post_date',
		'order'         => 'DESC',
		'posts_per_page'=> '1', // overrides posts per page in theme settings
	);
	$loop = new WP_Query( $args );
	if( $loop->have_posts() ) {
		// loop through posts
		while( $loop->have_posts() ): $loop->the_post();
		// variables
		$feature_img_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );

		echo '<section class="banner-issue clearfix" style="background-image:url('. $feature_img_src .');">';
		echo '<div class="site-inner">';
		echo '<div class="description">'; 
		echo '<h2>' . get_the_title() . '</h2>';
		echo the_content();
		echo '<a class="newest-issue-url" href="';
			if(function_exists('get_custom_field_data')) { 
				get_custom_field_data('feature-url', true);
			}
		echo '">';
			if(function_exists('get_custom_field_data')) { 
				get_custom_field_data('feature-button-name', true);
			}
		echo '</a>';
		echo '</div>';
		echo '</div>';
	    echo '</section>';
		endwhile;
	}
	wp_reset_postdata();
}

genesis();