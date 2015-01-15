<?php

/**
* Template Name: Issue 3 Template
* Description: Used as a page template to show page contents, followed by a loop 
* through the "Issue 3" category
*/

// Add our custom loop
add_action( 'genesis_loop', 'issue_loop' );

function issue_loop() {

	$args = array(
		'category_name' => 'issue-3', // replace with your category slug
		'orderby'       => 'post_date',
		'order'         => 'DESC',
		'posts_per_page'=> '12', // overrides posts per page in theme settings
	);

	$loop = new WP_Query( $args );
	if( $loop->have_posts() ) {

		// loop through posts
		while( $loop->have_posts() ): $loop->the_post();

		//$video_id = esc_attr( genesis_get_custom_field( 'cd_youtube_id' ) );
		//$video_thumbnail = '<img src="http://img.youtube.com/vi/' . $video_id . '/0.jpg" alt="" />';
		//$video_link = 'http://www.youtube.com/watch?v=' . $video_id;

		echo '<a href="' . get_permalink() . '" class="clearfix one-fourth">';
		echo '<div class="">';
			echo '<h4>' . get_the_title() . '</h4>';
			echo get_the_post_thumbnail( $post_id, 'medium' ); 
			echo the_excerpt();
		echo '</div>';
    echo '</a>';
		endwhile;
	}

	wp_reset_postdata();

}

genesis();