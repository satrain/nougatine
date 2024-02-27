<?php 
/* Block Name: Homepage Hero */
$title = get_field('title');
$description = get_field('description');
$button_1 = get_field('button_1');
$button_2 = get_field('button_2');
$background = get_field('background');

$direction = 'right';

if (get_locale() == 'he_IL') {
    $direction = 'left';
} 
?>

<div class="hero" style="background-image: url('<?= $background ?>');">
    <div class="container">
        <div class="hero-copy">
            <h1 data-aos="fade-<?= $direction ?>" data-aos-duration="1000"><?= $title ?></h1>
            <p data-aos="fade-<?= $direction ?>" data-aos-duration="1500"><?= $description ?></p>
            <div class="buttons-wrapper" data-aos="fade-<?= $direction ?>" data-aos-duration="2000">
                <a href="<?= $button_1['url'] ?>" class="btn btn-primary"><?= $button_1['title'] ?></a>
                <a href="<?= $button_2['url'] ?>" class="btn btn-secondary"><?= $button_2['title'] ?></a>
            </div>
        </div>
    </div>
</div>