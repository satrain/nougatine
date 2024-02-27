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
            $blocks = function_exists('get_field') ? get_field('blocks') : []; 
            if(!empty($blocks)) {
                foreach ($blocks as $value) {
                    include THEME_FOLDER . "/template-parts/blocks/{$value['acf_fc_layout']}.php";
                }
            }
        ?>

    </div><!-- #content -->
</main><!-- #primary -->

<?php get_footer(); ?>