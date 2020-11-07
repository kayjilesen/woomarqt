<?php
/**
 *	Functions
 */

// Tutorial Page
function clocky_register_tutorials_menu_page() {
    add_menu_page(
        __( 'Tutorials', 'clocky' ),
        'Tutorials',
        'edit_posts',
        'tutorials',
        '',
        'dashicons-video-alt3',
        99
    );
}
add_action( 'admin_menu', 'clocky_register_tutorials_menu_page' );

// Advanced Custom Fields Options Page
if ( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=>  'Clocky',
		'menu_title'	=>  'Clocky',
		'menu_slug' 	=>  'clocky-settings',
		'capability'	=>  'edit_posts',
        'redirect'		=>  false,
        'icon_url'		=>  'dashicons-menu-alt',
		'position'		=>  3
    ));
    
    acf_add_options_sub_page(array(
		'page_title' 	=> 'Header',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'clocky-settings',
    ));
    
    acf_add_options_sub_page(array(
		'page_title' 	=> 'Footer',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'clocky-settings',
	));
}

// Custom Post Types
$custom_post_types = get_field('custom_post_types', 'option');

if ( $custom_post_types['faqs'] ) {
    function clocky_faqs() {
        register_post_type('clocky_faqs',
            array(
                'labels'    =>  array(
                    'name'              =>      __('FAQ\'s', 'clocky'),
                    'singular_name'     =>      __('FAQ', 'clocky'),
                    'add_new'           =>      __('Nieuwe FAQ', 'clocky'),
                ),
                    'public'            =>      true,
                    'has_archive'       =>      true,
                    'menu_icon' 		=>      'dashicons-welcome-learn-more',
                    'menu_position'     =>      100,
            )
        );
    }
    add_action('init', 'clocky_faqs');
}

if ( $custom_post_types['looks'] ) {
    function clocky_looks() {
        register_post_type('clocky_looks',
            array(
                'labels'    =>  array(
                    'name'              =>      __('Looks', 'clocky'),
                    'singular_name'     =>      __('Look', 'clocky'),
                    'add_new'           =>      __('Nieuwe look', 'clocky'),
                ),
                    'public'            =>      true,
                    'has_archive'       =>      true,
                    'menu_icon' 		=>      'dashicons-heart',
                    'menu_position'     =>      100,
            )
        );
    }
    add_action('init', 'clocky_looks');
}

if ( $custom_post_types['vacatures'] ) {
    function clocky_vacatures() {
        register_post_type('clocky_vacatures',
            array(
                'labels'    =>  array(
                    'name'              =>      __('Vacatures', 'clocky'),
                    'singular_name'     =>      __('Vacature', 'clocky'),
                    'add_new'           =>      __('Nieuwe vacature', 'clocky'),
                ),
                    'public'            =>      true,
                    'has_archive'       =>      true,
                    'menu_icon' 		=>      'dashicons-groups',
                    'menu_position'     =>      100,
            )
        );
    }
    add_action('init', 'clocky_vacatures');
}