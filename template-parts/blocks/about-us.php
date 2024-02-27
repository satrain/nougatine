<?php
/* Block Name: About us - Homepage */
$title = get_field('title');
$description = get_field('description');
$button = get_field('button');
$video_poster = get_field('video_poster');
$video_url = get_field('video_url');

$direction_1 = 'right';
$direction_2 = 'left';

if (get_locale() == 'he_IL') {
    $direction_1 = 'left';
    $direction_2 = 'right';
} 
?>

<div class="hp-about-us">
    <div class="container">
        <h2><?= $title ?></h2>
        <div class="hp-about-us-wrapper">
            <div class="copy">
                <p data-aos="fade-<?= $direction_1 ?>" data-aos-duration="1000"><?= $description ?></p>
                <a data-aos="fade-<?= $direction_1 ?>" data-aos-duration="1100" href="<?= $button['url'] ?>" class="btn btn-primary"><?= $button['title'] ?></a>
            </div>
            <div class="video-wrapper" data-aos="fade-<?= $direction_2 ?>" data-aos-duration="1100" style="background: url('<?= $video_poster ?>');">
                <div class="video-wrapper-overlay"></div>
                <div class="play-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="33" height="40" viewBox="0 0 33 40" fill="none">
                        <path d="M33 20L-1.79446e-06 39.0526L-1.28837e-07 0.94744L33 20Z" fill="#C2996F"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="hp-about-us-video-modal">
    <div class="modal-close-area"></div>
    <div class="close">X</div>
    <div class="wrapper">
        <video width="100%" height="100%" controls autoplay muted>
            <source src="<?= $video_url ?>" type="video/mp4">
        </video>
    </div>
</div>