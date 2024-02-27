<?php
/* Block Name: CTA Mid Box */
$title = get_field('title');
$description = get_field('description');
$button = get_field('button');
$background = get_field('background');
if(!empty($block['className'])): $custom_class = $block['className']; else: $custom_class = ''; endif;
?>

<div class="need-further-information <?= $custom_class ?>">
    <div class="half-section-background" style="background: url('<?= $background ?>')"></div>
    <div class="container">
        <div class="box" data-aos="fade-up" data-aos-duration="500">
            <h2><?= $title ?></h2>
            <p><?= $description ?></p>
            <?php if(!empty($button)): ?> <a href="<?= $button['url'] ?>" class="btn btn-primary"><?= $button['title'] ?></a> <?php endif; ?>
        </div>
    </div>
</div>