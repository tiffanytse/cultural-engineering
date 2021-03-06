<?php

/**
* Template Name: Issue 8 Template
* Description: Used as a page template to show page contents, followed by a loop 
* through the "Issue 8" category
*/

// Add our custom loop
add_action( 'genesis_loop', 'issue_loop', 5 );

function issue_loop() {

	$args = array(
		'category_name' => 'issue-8', // replace with your category slug
		'orderby'       => 'post_date',
		'order'         => 'DESC',
		'posts_per_page'=> '12', // overrides posts per page in theme settings
	);

	$loop = new WP_Query( $args );
	if( $loop->have_posts() ) {

		// loop through posts
		while( $loop->have_posts() ): $loop->the_post();

		echo '<a href="' . get_permalink() . '" class="clearfix issue-blocks issue-display">';
		echo '<div class="inner">';
			echo get_the_post_thumbnail( $post_id, 'medium' ); 
			echo '<h4>' . get_the_title() . '</h4>';
			echo the_excerpt();
		echo '</div>';
    echo '</a>';
		endwhile;
	}

	wp_reset_postdata();

}

genesis();