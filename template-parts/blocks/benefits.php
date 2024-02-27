<?php 
/* Block Name: Benefits */
$items = get_field('items');
?>
<div class="sub-hero benefits">
    <div class="container">
        <div class="benefits-wrapper">
            <?php foreach($items as $item): ?>
                <div class="item">
                    <img src="<?= $item['icon'] ?>" alt="Benefits icon">
                    <div class="item-copy">
                        <h3><?= $item['title'] ?></h3>
                        <p><?= $item['description'] ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>