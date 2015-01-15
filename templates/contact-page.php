<?php

/**
* Template Name: Contact Page Template
* Description: Used as a page template to show page contents, and custom map 
*/

// Add our custom loop

add_action( 'genesis_loop', 'custom_map', 5);

function custom_map() { 
  echo do_shortcode('[google_maps id="50"]');
}

genesis();

