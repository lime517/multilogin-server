<?php

// Admin

if( function_exists('acf_add_options_page') ) {

  acf_add_options_page(array(
		'page_title' 	=> 'Seamless Login Users',
		'menu_title'	=> 'Seamless Login Users',
		'menu_slug' 	=> 'seamless-login-users',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

}
