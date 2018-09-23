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

/**
 * Register Films taxonomies
 *  Genre, Country, Year and Actors
 */
function register_films_taxonomies()
{
    //taxonomies
    $taxonomies = array(
        array(
            'slug' => 'genre_film',
            'single_name' => 'Genre',
            'plural_name' => 'Genres',
            'post_type' => 'films',
            'rewrite' => array('slug' => 'genre'),
        ),
        array(
            'slug' => 'country_film',
            'single_name' => 'Country',
            'plural_name' => 'Countries',
            'post_type' => 'films',
            'rewrite' => array('slug' => 'country'),
        ),
        array(
            'slug' => 'year_film',
            'single_name' => 'Year',
            'plural_name' => 'Years',
            'post_type' => 'films',
            'rewrite' => array('slug' => 'year'),
        ),
        array(
            'slug' => 'actor_film',
            'single_name' => 'Actor',
            'plural_name' => 'Actors',
            'post_type' => 'films',
            'rewrite' => array('slug' => 'actor'),
        ),
    );

    //create taxonomies dinamically
    foreach ($taxonomies as $taxonomy) {
        $labels = array(
            'name' => $taxonomy['plural_name'],
            'singular_name' => $taxonomy['single_name'],
            'search_items' => 'Search ' . $taxonomy['plural_name'],
            'all_items' => 'All ' . $taxonomy['plural_name'],
            'parent_item' => 'Parent ' . $taxonomy['single_name'],
            'parent_item_colon' => 'Parent ' . $taxonomy['single_name'] . ':',
            'edit_item' => 'Edit ' . $taxonomy['single_name'],
            'update_item' => 'Update ' . $taxonomy['single_name'],
            'add_new_item' => 'Add New ' . $taxonomy['single_name'],
            'new_item_name' => 'New ' . $taxonomy['single_name'] . ' Name',
            'menu_name' => $taxonomy['plural_name'],
        );

        $rewrite = isset($taxonomy['rewrite']) ? $taxonomy['rewrite'] : array('slug' => $taxonomy['slug']);
        $hierarchical = isset($taxonomy['hierarchical']) ? $taxonomy['hierarchical'] : true;

        // Register taxonomies
        register_taxonomy($taxonomy['slug'], $taxonomy['post_type'], array(
            'hierarchical' => $hierarchical,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => $rewrite,
        ));
    }
}
add_action('init', 'register_films_taxonomies');
