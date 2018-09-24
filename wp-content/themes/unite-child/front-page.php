<?php
	get_header(); 	
?>
	<?php while ( have_posts() ) : the_post(); ?>

	<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
		<h1><?php the_title(); ?></h1>
		<?php the_content();?>
		<?php get_films(); ?>
	</div>
<?php
	endwhile;
	get_sidebar();
 ?>

		
<?php
	get_footer();
?>