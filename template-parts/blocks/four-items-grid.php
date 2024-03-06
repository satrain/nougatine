<?php 
/* Block Name: Four Items Grid */
$title = get_field('title');
$items = get_field('items');
?>

<div class="dedicated-to-events">
    <div class="container">
        <h2><?= $title ?></h2>
        <div class="dedicated-wrapper">
            <?php foreach($items as $item): ?>
                <div class="item">
                    <div class="icon">
                        <img src="<?= $item['image'] ?>" alt="Icon">
                    </div>
                    <p><?= $item['description'] ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>