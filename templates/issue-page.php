<?php

/**
* Template Name: Issue Page Template
* Description: Used as a page template to show page contents, followed by a loop 
* through the "Issue" category
*/

// Add our custom loop

add_action( 'genesis_loop', 'wpb_list_child_pages' );

genesis();

