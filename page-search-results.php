<?php
/*
Template Name: Search Results
*/

get_header();

// Prevent 404 status
global $wp_query;
$wp_query->is_404 = false;
status_header(200);

// Load the plugin’s custom search page
include WP_PLUGIN_DIR . '/live-search-optimizer/includes/search-page-template.php';

get_footer();