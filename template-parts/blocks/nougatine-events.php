<?php 
/* Block Name: Nougatine Events */
$title = get_field('title');
$description = get_field('description');
$button = get_field('button');
$images = get_field('images');

$direction_1 = 'right';
$direction_2 = 'left';

if (get_locale() == 'he_IL') {
    $direction_1 = 'left';
    $direction_2 = 'right';
} 
?>

<div class="nougatine-events">
    <div class="container">
        <h2><?= $title ?></h2>
        <div class="wrapper">
            <div class="content">
                <p data-aos="fade-<?= $direction_1 ?>" data-aos-duration="1000"><?= $description ?></p>
                <a data-aos="fade-<?= $direction_1 ?>" data-aos-duration="1100" href="<?= $button['url'] ?>" class="btn btn-primary"><?= $button['title'] ?></a>
            </div>
            <div class="gallery" data-aos="fade-<?= $direction_2 ?>" data-aos-duration="1100">
                <div class="nougatine-events-slider">
                    <?php foreach($images as $image): ?>
                        <img src="<?= $image['image'] ?>" alt="image">
                    <?php endforeach; ?>
                </div>
            </div>
            <a href="<?= $button['url'] ?>" class="btn btn-primary btn-mobile"><?= $button['title'] ?></a>
        </div>
    </div>
</div>