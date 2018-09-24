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

/**
 * Add custom text fields
 *  Release Date and Ticket Price
 */
function add_custom_text_fields()
{
    $posts = ['films', 'detail_films'];
    foreach ($posts as $post) {
        add_meta_box(
            'wporg_box_id', // Unique ID
            'Detail Films', // Box title
            'custom_fields_html', // Content callback, must be of type callable
            $post // Post type
        );
    }
}
add_action('add_meta_boxes', 'add_custom_text_fields');

/**
 * Custom fields html
 */
function custom_fields_html($post)
{
    $value1 = get_post_meta($post->ID, 'price_meta_key', true);
    $value = get_post_meta($post->ID, 'release_meta_key', true);
    ?>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <label for="ticket_price">Ticket Price: </label>
        <input type="text" value="<?php echo $value1 ?>" name="ticket_price" id="ticket_price">
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <label for="release_date">Release Date: </label>
        <input type="date"  value="<?php echo $value ?>" name="release_date" id="release_date">
    </div>
    <?php

}

/**
 * Save custom text fields data
 */
function save_custom_texts($post_id)
{
    if (array_key_exists('ticket_price', $_POST)) {
        //*dave ticket price
        update_post_meta(
            $post_id,
            'price_meta_key',
            $_POST['ticket_price']
        );
    }
    if (array_key_exists('release_date', $_POST)) {
        //*save relesase date
        update_post_meta(
            $post_id,
            'release_meta_key',
            $_POST['release_date']
        );
    }
}
add_action('save_post', 'save_custom_texts');

/**
 * Get films
 */
function get_films()
{
    //films desc order
    $args = array(
        'post_type' => 'films',
        'orderby' => 'id',
        'order' => 'DESC'
    );

    // WP_Query arguments
    $recent_posts = wp_get_recent_posts($args);

    echo '<h4>List films</h4>';
    //*print films
    foreach ($recent_posts as $recent) {
        $post_thumbnail_id = get_post_thumbnail_id($recent["ID"]);
        $img = wp_get_attachment_image_url($post_thumbnail_id, 'full');
        $price = get_post_meta($recent["ID"], 'price_meta_key', true);
        $date = get_post_meta($recent["ID"], 'release_meta_key', true);

        $genres = get_the_terms($recent["ID"], 'genre_film', true);
        $countries = get_the_terms($recent["ID"], 'country_film', true);

        $html = '<div class="panel col-lg-4 col-md-4 col-sm-12 col-lxs-12">';
        $html .= '<div class="panel-body">';
        $html .= '<a href="' . get_permalink($recent["ID"]) . '" title="Look ' . esc_attr($recent["post_title"]) . '" >';
        $html .= '<div class="col-lg-12 col-md-12 col-sm-12 col-lxs-12">';
        $html .= '<img src="' . $img . '">';
        $html .= '</div>';
        $html .= '<div class="col-lg-12 col-md-12 col-sm-12 col-lxs-12">';
        $html .= '<h4>' . $recent["post_title"] . '</h4>';
        $html .= '<p>' . $date . '</p>';
        $html .= '<p>' . $price . '</p>';

        $html .= '<p>';
        foreach ($genres as $genre) {
            $html .= $genre->name . ', ';
        }
        $html .= '</p>';

        $html .= '<p>';
        foreach ($countries as $country) {
            $html .= $country->name . ', ';
        }
        $html .= '</p>';

        $html .= '</div>';
        $html .= '</a>';
        $html .= '</div>';
        $html .= '</div>';

        echo $html;
    }

}

add_action('the_films', 'get_films', 1);

/**
 * Last five films shortcode
 */
function last_films_shortcode()
{
    $args = array(
        'post_type' => 'films',
        'orderby' => 'id',
        'order' => 'DESC',
        'posts_per_page' => 5,
    );
    
    // WP_Query arguments
    $recent_posts = wp_get_recent_posts($args);

    echo '<h4>Recent films</h4>';

    foreach ($recent_posts as $recent) {
        $post_thumbnail_id = get_post_thumbnail_id($recent["ID"]);
        $img = wp_get_attachment_image_url($post_thumbnail_id, 'full');

        $html = '<div class="panel col-lg-12 col-md-12 col-sm-12 col-lxs-12">';
        $html .= '<div class="panel-body">';
        $html .= '<a href="' . get_permalink($recent["ID"]) . '" title="Look ' . esc_attr($recent["post_title"]) . '" >';
        $html .= '<div class="col-lg-4 col-md-4 col-sm-12 col-lxs-12">';
        $html .= '<img src="' . $img . '">';
        $html .= '</div>';
        $html .= '<div class="col-lg-8 col-md-8 col-sm-12 col-lxs-12">';
        $html .= '<h4>' . $recent["post_title"] . '</h4>';
        $html .= '<p>' . wp_trim_words($recent["post_content"], 10) . '</p>';
        $html .= '</div>';
        $html .= '</a>';
        $html .= '</div>';
        $html .= '</div>';

        echo $html;
    }
}

add_shortcode('last_films', 'last_films_shortcode');
