<?php

/**
* Template Name: Artists Page Template
* Description: Used as a page template to show all entries in the Artist custom post type
*/
// Hide regular entry content
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );

// Add our custom loop
add_action( 'genesis_entry_content', 'artist_loop' );

function artist_loop() {

	$args = array(
		'post_type' => 'artists', // replace with your custom post type
		'orderby'       => 'post_date',
		'order'         => 'ASC',
		'posts_per_page'=> '12', // overrides posts per page in theme settings
	);

	$loop = new WP_Query( $args );
	if( $loop->have_posts() ) {

		// loop through posts
		while( $loop->have_posts() ): $loop->the_post();

		//echo '<a href="' . get_permalink() . '" class="clearfix one-fourth issue-blocks">';
		echo '<div class="artist">';
			echo '<div class="image-thumbnail">';
			echo get_the_post_thumbnail( $post_id, 'thumbnail' ); 
			echo '</div>';
			echo '<div class="artist-content">';
			echo '<h4>' . get_the_title() . '</h4>';
			echo the_content();
			echo '</div>';
		echo '</div>';
    echo '</a>';
		endwhile;
	}

	wp_reset_postdata();

}

genesis();