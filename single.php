<?php get_header(); ?>

<main id="main-content">
    <?php
	
    while ( have_posts() ) :
        the_post();
		the_title( '<h1 class="entry-title">', '</h1>' ); 

          the_content();
    endwhile; 
    ?>
</main>

<?php get_footer(); ?>