<?php
/* Block Name: Kosher Slider */
$title   = get_field( 'title' );
$content = get_field( 'content' );
$image   = get_field( 'image' );


if ( ! empty( $block['className'] ) ): $custom_class = $block['className'];
else: $custom_class = ''; endif;
?>

<div class="kosher-wrapper <?= $custom_class ?>">
	<div class="container">
		<h2 class="hide-mobile"><?= $title ?></h2>
		<h2 class="hide-desktop"><?= $title ?></h2>

		<div class="content">
			<p><?= $content ?></p>

			<div class="imageContent">
				<img src="<?= $image ?>" alt="Kosher image">
			</div>
		</div>
	</div>
</div>

<div class="image-modal-content full-size-image-modal">
	<div class="modal-wrapper">
            <span class="close">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                    <path d="M25.7071 24.2925C25.8 24.3854 25.8737 24.4957 25.924 24.6171C25.9743 24.7385 26.0001 24.8686 26.0001 25C26.0001 25.1314 25.9743 25.2615 25.924 25.3829C25.8737 25.5043 25.8 25.6146 25.7071 25.7075C25.6142 25.8004 25.5039 25.8741 25.3825 25.9244C25.2611 25.9747 25.131 26.0006 24.9996 26.0006C24.8682 26.0006 24.7381 25.9747 24.6167 25.9244C24.4953 25.8741 24.385 25.8004 24.2921 25.7075L15.9996 17.4138L7.70708 25.7075C7.51944 25.8951 7.26494 26.0006 6.99958 26.0006C6.73422 26.0006 6.47972 25.8951 6.29208 25.7075C6.10444 25.5199 5.99902 25.2654 5.99902 25C5.99902 24.7346 6.10444 24.4801 6.29208 24.2925L14.5858 16L6.29208 7.70751C6.10444 7.51987 5.99902 7.26537 5.99902 7.00001C5.99902 6.73464 6.10444 6.48015 6.29208 6.29251C6.47972 6.10487 6.73422 5.99945 6.99958 5.99945C7.26494 5.99945 7.51944 6.10487 7.70708 6.29251L15.9996 14.5863L24.2921 6.29251C24.4797 6.10487 24.7342 5.99945 24.9996 5.99945C25.2649 5.99945 25.5194 6.10487 25.7071 6.29251C25.8947 6.48015 26.0001 6.73464 26.0001 7.00001C26.0001 7.26537 25.8947 7.51987 25.7071 7.70751L17.4133 16L25.7071 24.2925Z"
                          fill="white"/>
                </svg>
            </span>
		<img src="" alt="Product image">
	</div>
</div>
