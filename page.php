<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 */
get_header();
?>

<main id="primary" class="content-area">
    <div id="content" class="site-content" role="main">

        <?php
            the_content();
        ?>

    </div><!-- #content -->
</main><!-- #primary -->

<?php get_footer(); ?>