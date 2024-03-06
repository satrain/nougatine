<?php 

$title = get_field('title');
$description = get_field('description');

$args = array(
    'post_type'      => 'customers_gallery',
    'posts_per_page' => -1,
);

$faqs_query = new WP_Query($args);

?>

<h2><?= $title ?></h2>
<div class="gallery-slider-wrapper">
    <?php 
        if ($faqs_query->have_posts()) {
            while ($faqs_query->have_posts()) {
                $faqs_query->the_post();
    ?>
                <div class="item">
                    <img src="<?php the_field('image', get_the_ID()); ?>" alt="Customer image">
                    <p class="slide-description"><?php the_field('title', get_the_ID()); ?></p>
                </div>

                <?php 
            }

            wp_reset_postdata();
        }
    ?>
</div>
<p class="main-description"><?= $description ?></p>

<div class="gallery-image-modal">
    <div class="modal-close-area"></div>
    <div class="close">X</div>
    <div class="wrapper">
        <img src="" alt="Image">
    </div>
</div>