<?php 
/* Block Name: Video with Title */
$title = get_field('title');
$video_poster = get_field('video_poster');
$video_url = get_field('video_url');
?>

<div class="our-story">
    <div class="container">
        <h2><?= $title ?></h2>
        <div class="video-wrapper">
            <div class="video-wrapper-overlay"></div>
            <video width="372" height="372" poster="<?= $video_poster ?>">
                <source src="<?= $video_url ?>" type="video/mp4">
            </video>
            <div class="play-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="33" height="40" viewBox="0 0 33 40" fill="none">
                    <path d="M33 20L-1.79446e-06 39.0526L-1.28837e-07 0.94744L33 20Z" fill="#C2996F"/>
                </svg>
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