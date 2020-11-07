<?php
/**
 *	Functions
 */ 

// Tutorial Page
function woomarqt_register_tutorials_menu_page() {
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
add_action( 'admin_menu', 'woomarqt_register_tutorials_menu_page' );

// Advanced Custom Fields Options Page
if ( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=>  'WooMarqt',
		'menu_title'	=>  'WooMarqt',
		'menu_slug' 	=>  'woomarqt-settings',
		'capability'	=>  'edit_posts',
        'redirect'		=>  false,
        'icon_url'		=>  'dashicons-menu-alt',
		'position'		=>  3
    ));
    
    acf_add_options_sub_page(array(
		'page_title' 	=> 'Header',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'woomarqt-settings',
    ));
    
    acf_add_options_sub_page(array(
		'page_title' 	=> 'Footer',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'woomarqt-settings',
	));
}

// Custom Post Types
$custom_post_types = get_field('custom_post_types', 'option');

if ( $custom_post_types['faqs'] ) {
    function woomarqt_faqs() {
        register_post_type('woomarqt_faqs',
            array(
                'labels'    =>  array(
                    'name'              =>      __('FAQ\'s', 'woomarqt'),
                    'singular_name'     =>      __('FAQ', 'woomarqt'),
                    'add_new'           =>      __('Nieuwe FAQ', 'woomarqt'),
                ),
                    'public'            =>      true,
                    'has_archive'       =>      true,
                    'menu_icon' 		=>      'dashicons-welcome-learn-more',
                    'menu_position'     =>      100,
            )
        );
    }
    add_action('init', 'woomarqt_faqs');
}

if ( $custom_post_types['looks'] ) {
    function woomarqt_looks() {
        register_post_type('woomarqt_looks',
            array(
                'labels'    =>  array(
                    'name'              =>      __('Looks', 'woomarqt'),
                    'singular_name'     =>      __('Look', 'woomarqt'),
                    'add_new'           =>      __('Nieuwe look', 'woomarqt'),
                ),
                    'public'            =>      true,
                    'has_archive'       =>      true,
                    'menu_icon' 		=>      'dashicons-heart',
                    'menu_position'     =>      100,
            )
        );
    }
    add_action('init', 'woomarqt_looks');
}

if ( $custom_post_types['vacatures'] ) {
    function woomarqt_vacatures() {
        register_post_type('woomarqt_vacatures',
            array(
                'labels'    =>  array(
                    'name'              =>      __('Vacatures', 'woomarqt'),
                    'singular_name'     =>      __('Vacature', 'woomarqt'),
                    'add_new'           =>      __('Nieuwe vacature', 'woomarqt'),
                ),
                    'public'            =>      true,
                    'has_archive'       =>      true,
                    'menu_icon' 		=>      'dashicons-groups',
                    'menu_position'     =>      100,
            )
        );
    }
    add_action('init', 'woomarqt_vacatures');
}

// Load Custom WooMarqt Styles 
function custom_woomarqt_styles() {    

    wp_register_style('menu', get_template_directory_uri() . '/css/menu.min.css', array(),  filemtime(get_theme_file_path('/css/menu.min.css')), 'all');
    wp_enqueue_style('menu'); // Menu

    wp_register_style('input', get_template_directory_uri() . '/css/input.min.css', array(),  filemtime(get_theme_file_path('/css/input.min.css')), 'all');
    wp_enqueue_style('input'); // Menu

    if(is_admin()){
        wp_register_style( 'admin-css', get_template_directory_uri() . '/admin/css/admin.min.css', array(), filemtime(get_theme_file_path('/admin/css/admin.min.css'), 'all') );
        wp_enqueue_style( 'admin-css' );
    }
}

add_action('init', 'custom_woomarqt_styles'); // Add Stylesheets