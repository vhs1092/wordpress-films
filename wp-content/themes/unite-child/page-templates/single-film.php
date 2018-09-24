<?php
/* Template Name: single-film
 * Template Post Type: films
 */

    get_header();
?>
    
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <?php
            while ( have_posts() ) : the_post();
        ?>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <?php the_post_thumbnail(); ?>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h1><?php the_title(); ?></h1>
                            <?php the_content(); ?>
                        </div>
                    </div>

                    <ul class="list-group">
                        <li class="list-group-item">
                            <b>Genre:</b> <?php $genres = get_the_terms(get_the_ID(), 'genre_film');
                                foreach ($genres as $genre) {
                                    echo $genre->name;
                                }?>
                        </li>
                        <li class="list-group-item">
                            <b>Actors:</b> <?php $actors = get_the_terms(get_the_ID(), 'actor_film');
                                foreach ($actors as $actor) {
                                    echo $actor->name . ", ";
                                }?>
                        </li>
                        <li class="list-group-item">
                            <b> Country</b>: <?php $countries = get_the_terms(get_the_ID(), 'country_film');
                                foreach ($countries as $country) {
                                    echo $country->name;
                                }?>
                        </li>
                        <li class="list-group-item">
                            <b> Release date: </b> <?php echo get_post_meta(get_the_ID(), 'release_meta_key', true);?>
                        </li>
                        <li class="list-group-item">
                            <b> Ticket Price:</b> <code style="font-size: 2rem;"><?php echo get_post_meta(get_the_ID(), 'price_meta_key', true); ?></code>
                        </li>
                    </ul>
                </div>
        <?php
            endwhile;
        ?>
    </div>
    <?php get_sidebar(); ?>
<?php
    get_footer();  
 ?>