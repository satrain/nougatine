<?php
/* Block Name: Clients Slider */
$title = get_field('title');
$images = get_field('images');
?>
<div class="clients">
    <div class="container">
        <h2><?= $title ?></h2>
        <div class="clients-slider">
            <?php foreach($images as $image): ?>
                <img src="<?= $image['image'] ?>" alt="image">
            <?php endforeach; ?>
        </div>
    </div>
</div>