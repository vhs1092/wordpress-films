<?php

/**
 * Get styles from parent theme 
 */
function unite_child_theme() {

 $parent_style = 'parent-style';

 wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
 wp_enqueue_style( 'child-style',
 get_stylesheet_directory_uri() . '/style.css',
 array( $parent_style ),
 wp_get_theme()->get('Version')
 );
}
add_action( 'wp_enqueue_scripts', 'unite_child_theme' );

/**
 * Create post films function
 */
function create_post_films()
{
    register_post_type('films',
        array(
            'labels' => array(
                'name' => __('Films'),
                'singular_name' => __('Film'),
            ),
            'public' => true,
            'has_archive' => true,
			'supports' => array('title','editor','thumbnail')
        )
    );
}
add_action('init', 'create_post_films');


