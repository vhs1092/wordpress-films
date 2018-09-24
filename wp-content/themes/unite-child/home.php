<?php
/**
 * Template Name: home
 *
 * This is the template that displays full width page without sidebar
 *
 */

get_header();

while (have_posts()): the_post();
    the_title();
    the_content();


    the_films();
endwhile;

get_footer();
?> 