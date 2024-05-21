<?php
/* Template Name: Custom Shop Template */
get_header();

$categories = get_terms( array(
	'taxonomy'     => 'product_cat',
	'hide_empty'   => true,
	'exclude_tree' => array(
		get_term_by( 'slug', 'recommended-menus', 'product_cat' )->term_id ?? null,
		get_term_by( 'slug', 'recommended-menus-he', 'product_cat' )->term_id ?? null,
	),
) );
?>
<div class="product-catalog product-catalog-template page template">
	<div class="product-catalog-hero">
		<div class="background-overlay"></div>
		<div class="container">
			<h1><?php pll_e( 'Hospitality Trays' ) ?></h1>
			<p><?php pll_e( "Ready to make your event unforgettable? Browse through our array of offerings and discover the perfect food for you!" ) ?></p>
		</div>
	</div>
	<div class="categories product-categories">
		<div class="container">
			<div class="categories-dropdown">
				<div class="dropdown-button" id="catDropdown">
					<h3><?php pll_e( "Choose category" ) ?></h3>
					<svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24" fill="none">
						<path d="M4.16576 7.48164C4.07029 7.39142 3.95799 7.32089 3.83526 7.27408C3.71253 7.22726 3.58178 7.20508 3.45048 7.20879C3.31918 7.21251 3.18989 7.24205 3.07001 7.29573C2.95012 7.3494 2.84198 7.42617 2.75176 7.52164C2.66155 7.61711 2.59102 7.72942 2.5442 7.85215C2.49739 7.97488 2.4752 8.10562 2.47892 8.23693C2.48263 8.36823 2.51217 8.49751 2.56585 8.6174C2.61953 8.73728 2.69629 8.84542 2.79176 8.93564L11.7918 17.4356C11.9774 17.6112 12.2233 17.709 12.4788 17.709C12.7343 17.709 12.9801 17.6112 13.1658 17.4356L22.1668 8.93564C22.2643 8.84602 22.3431 8.7379 22.3985 8.61758C22.454 8.49725 22.4849 8.36711 22.4896 8.23472C22.4943 8.10232 22.4727 7.97031 22.4259 7.84636C22.3792 7.7224 22.3083 7.60897 22.2173 7.51265C22.1264 7.41632 22.0172 7.33904 21.8961 7.28527C21.775 7.2315 21.6445 7.20233 21.512 7.19945C21.3796 7.19656 21.2479 7.22002 21.1246 7.26847C21.0013 7.31691 20.8888 7.38937 20.7938 7.48164L12.4788 15.3336L4.16576 7.48164Z" fill="#C2996F"/>
					</svg>
				</div>
				<div class="dropdown-content">
					<?php
					foreach ( $categories as $category ) {
						// Get category thumbnail
						$thumbnail_id  = get_term_meta( $category->term_id, 'thumbnail_id', true );
						$thumbnail_url = wp_get_attachment_url( $thumbnail_id );
						?>
						<a class="item" href="#<?= esc_html( $category->slug ) ?>">
							<img src="<?php echo esc_url( $thumbnail_url ) ?>" alt="<?php echo esc_html( $category->name ) ?>">
							<h3><?php echo esc_html( $category->name ) ?></h3>
						</a>
					<?php } ?>
				</div>
			</div>

			<h2><?php pll_e( "Choose category" ) ?></h2>

			<div class="categories-wrapper" id="categoriesWrapper">
				<?php
				foreach ( $categories as $category ) {
					// Get category thumbnail
					$thumbnail_id  = get_term_meta( $category->term_id, 'thumbnail_id', true );
					$thumbnail_url = wp_get_attachment_url( $thumbnail_id );
					?>
					<div class="product-category <?php if ( $category->count <= 0 ) { echo 'not-active'; } ?>">
						<a title="<?= $category->name ?>" href="#<?= esc_html( $category->term_id ) ?>">
							<?php
							if ( ! empty( $thumbnail_url ) ) {
								echo '<img class="product-category-image" src="' . esc_url( $thumbnail_url ) . '" alt="' . esc_attr( $category->name ) . '">';
							}
							?>

							<p><?php echo esc_html( $category->name ) ?></p>
						</a>
						<?php /* <p> <?php echo esc_html($category->slug) ?></p> */ ?>
					</div>
				<?php } ?>
			</div>

		</div>
	</div>

	<div class="product-catalog-wrapper">
		<div class="container">
			<?php

			// Loop through product categories and display products
			$product_categories = get_terms( array(
				'taxonomy'   => 'product_cat',
				'hide_empty' => true,
			) );

			$products_arr = [];

			$exclude_categories = array();

			// Find "Recommended Menus" category ID and its subcategories IDs
			// Check English version
			$recommended_menus    = get_term_by( 'slug', 'recommended-menus', 'product_cat' );
			$recommended_menus_he = get_term_by( 'slug', 'recommended-menus-he', 'product_cat' );
			if ( $recommended_menus ) {
				$exclude_categories[]       = $recommended_menus->term_id;
				$recommended_menus_children = get_term_children( $recommended_menus->term_id, 'product_cat' );
				if ( ! empty( $recommended_menus_children ) ) {
					$exclude_categories = array_merge( $exclude_categories, $recommended_menus_children );
				}
			}
			// check Hebrew version
			if ( $recommended_menus_he ) {
				$exclude_categories[]       = $recommended_menus_he->term_id;
				$recommended_menus_children = get_term_children( $recommended_menus_he->term_id, 'product_cat' );
				if ( ! empty( $recommended_menus_children ) ) {
					$exclude_categories = array_merge( $exclude_categories, $recommended_menus_children );
				}
			}

			foreach ( $product_categories as $category ) {
				// Exclude "Recommended Menus" and its subcategories from displaying
				if ( in_array( $category->term_id, $exclude_categories ) ) {
					continue;
				}

				$thumbnail_id  = get_term_meta( $category->term_id, 'thumbnail_id', true );
				$thumbnail_url = wp_get_attachment_url( $thumbnail_id );


				$args = array(
					'post_type'      => 'product',
					'posts_per_page' => - 1,
					'tax_query'      => array(
						array(
							'taxonomy' => 'product_cat',
							'field'    => 'term_id',
							'terms'    => $category->term_id,
						),
					),
				);

				$products = new WP_Query( $args );
				if ( $products->have_posts() ) {
					echo "<div class='product-catalog-category-wrapper'>";
					if ( $category->count > 0 ) {
						echo '<h3>' . $category->name . '<img src="' . $thumbnail_url . '"></h3>';
					}
					echo "<span class='category-anchor' id='" . esc_html( $category->term_id ) . "'></span>";

					while ( $products->have_posts() ) {
						$products->the_post();
						$price        = get_post_meta( get_the_ID(), '_price', true );
						$products_arr = [ 'id' => get_the_ID(), 'name' => get_the_title(), 'price' => $price, 'placement' => 'shop' ];
						get_template_part( 'template-parts/content', 'product', $products_arr );
					}
					echo "</div>";
				}

				wp_reset_postdata();
			}
			?>
		</div>
	</div>

	<div class="products-catalog-modal product-modal modal">
		<div class="modal-wrapper">
			<div class="modal-header">
                <span class="close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                        <path d="M25.7081 24.2926C25.801 24.3855 25.8747 24.4958 25.9249 24.6172C25.9752 24.7386 26.0011 24.8687 26.0011 25.0001C26.0011 25.1315 25.9752 25.2616 25.9249 25.383C25.8747 25.5044 25.801 25.6147 25.7081 25.7076C25.6151 25.8005 25.5048 25.8742 25.3835 25.9245C25.2621 25.9747 25.132 26.0006 25.0006 26.0006C24.8692 26.0006 24.7391 25.9747 24.6177 25.9245C24.4963 25.8742 24.386 25.8005 24.2931 25.7076L16.0006 17.4138L7.70806 25.7076C7.52042 25.8952 7.26592 26.0006 7.00056 26.0006C6.73519 26.0006 6.4807 25.8952 6.29306 25.7076C6.10542 25.5199 6 25.2654 6 25.0001C6 24.7347 6.10542 24.4802 6.29306 24.2926L14.5868 16.0001L6.29306 7.70757C6.10542 7.51993 6 7.26543 6 7.00007C6 6.7347 6.10542 6.48021 6.29306 6.29257C6.4807 6.10493 6.73519 5.99951 7.00056 5.99951C7.26592 5.99951 7.52042 6.10493 7.70806 6.29257L16.0006 14.5863L24.2931 6.29257C24.4807 6.10493 24.7352 5.99951 25.0006 5.99951C25.2659 5.99951 25.5204 6.10493 25.7081 6.29257C25.8957 6.48021 26.0011 6.7347 26.0011 7.00007C26.0011 7.26543 25.8957 7.51993 25.7081 7.70757L17.4143 16.0001L25.7081 24.2926Z"
                              fill="#8E99A5"/>
                    </svg>
                </span>
			</div>
			<div class="modal-content">
				<div class="left-side">
					<div class="image-holder">
						<img class="product-image" src="/wp-content/uploads/2024/02/Item3.jpeg" alt="Product image">
						<div class="zoom-in">
							<img src="<?= ASSETS_URI ?>/images/product-popup-zoom-image.svg" alt="Zoom in">
						</div>
					</div>
					<div class="tags-holder">
						<div class="tag item">
							<div class="icon">
								<img src="/wp-content/uploads/2024/03/mdi_heart.svg" alt="Tag icon">
							</div>
							<p><?php pll_e( "Customers Favorite" ) ?></p>
						</div>
						<div class="tag item">
							<div class="icon">
								<img src="/wp-content/uploads/2024/03/fa6-solid_children.svg" alt="Tag icon">
							</div>
							<p><?php pll_e( "Suitable For Children" ) ?></p>
						</div>
					</div>
				</div>
				<div class="separator"></div>
				<div class="right-side">
					<div class="content">
						<div class="main-content-wrapper">
							<div class="title">
								<h2>Italian cake filled with cream cheese</h2>
								<div class="price-wrapper">
									<span class="price">₪120</span>
									<a class="out-of-stock-btn"><?php pll_e( "Out of stock" ) ?></a>
								</div>
							</div>
							<div class="separator-line"></div>
							<div class="main-content">
								<p class="description"></p>
								<form class="price-options"></form>
								<div class="section product-containing">

									<a class="read-more load-product-containing-list">
										<?php pll_e( "Read More" ) ?>
										<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
											<path d="M3.40604 6.23539C3.32648 6.16021 3.23289 6.10144 3.13062 6.06242C3.02835 6.02341 2.91939 6.00492 2.80997 6.00802C2.70055 6.01111 2.59282 6.03573 2.49291 6.08046C2.39301 6.1252 2.30289 6.18917 2.22771 6.26873C2.15253 6.34829 2.09375 6.44187 2.05474 6.54415C2.01572 6.64642 1.99724 6.75538 2.00033 6.8648C2.00343 6.97422 2.02805 7.08195 2.07278 7.18186C2.11751 7.28176 2.18148 7.37188 2.26104 7.44706L9.76104 14.5304C9.91577 14.6767 10.1206 14.7582 10.3335 14.7582C10.5465 14.7582 10.7513 14.6767 10.906 14.5304L18.4069 7.44706C18.4882 7.37237 18.5538 7.28228 18.6 7.18201C18.6462 7.08173 18.672 6.97328 18.6759 6.86296C18.6798 6.75263 18.6618 6.64262 18.6228 6.53932C18.5839 6.43602 18.5248 6.3415 18.449 6.26123C18.3732 6.18096 18.2822 6.11655 18.1813 6.07175C18.0804 6.02694 17.9716 6.00263 17.8613 6.00023C17.7509 5.99783 17.6411 6.01738 17.5384 6.05775C17.4356 6.09812 17.3419 6.1585 17.2627 6.23539L10.3335 12.7787L3.40604 6.23539Z"
											      fill="#C2996F"/>
										</svg>
									</a>
								</div>
								<div class="choose-options-wrapper"></div>
							</div>
							<div class="separator-line personalized-message-separator"></div>
							<div class="additional-content">
								<div class="personalized-message">
									<p></p>
									<input type="text" name="" class="personalized-message-input" placeholder="<?php pll_e( 'Type your personalized message...' ) ?>">
								</div>
							</div>
						</div>
						<div class="bottom-part">
							<div class="additional-options">
								<a class="btn-additional-options"><?php pll_e( "Additional Options" ) ?></a>
								<div class="additional-options-modal product-modal modal">
									<div class="wrapper">
                                        <span class="close">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M19.281 18.2198C19.3507 18.2895 19.406 18.3722 19.4437 18.4632C19.4814 18.5543 19.5008 18.6519 19.5008 18.7504C19.5008 18.849 19.4814 18.9465 19.4437 19.0376C19.406 19.1286 19.3507 19.2114 19.281 19.281C19.2114 19.3507 19.1286 19.406 19.0376 19.4437C18.9465 19.4814 18.849 19.5008 18.7504 19.5008C18.6519 19.5008 18.5543 19.4814 18.4632 19.4437C18.3722 19.406 18.2895 19.3507 18.2198 19.281L12.0004 13.0607L5.78104 19.281C5.64031 19.4218 5.44944 19.5008 5.25042 19.5008C5.05139 19.5008 4.86052 19.4218 4.71979 19.281C4.57906 19.1403 4.5 18.9494 4.5 18.7504C4.5 18.5514 4.57906 18.3605 4.71979 18.2198L10.9401 12.0004L4.71979 5.78104C4.57906 5.64031 4.5 5.44944 4.5 5.25042C4.5 5.05139 4.57906 4.86052 4.71979 4.71979C4.86052 4.57906 5.05139 4.5 5.25042 4.5C5.44944 4.5 5.64031 4.57906 5.78104 4.71979L12.0004 10.9401L18.2198 4.71979C18.3605 4.57906 18.5514 4.5 18.7504 4.5C18.9494 4.5 19.1403 4.57906 19.281 4.71979C19.4218 4.86052 19.5008 5.05139 19.5008 5.25042C19.5008 5.44944 19.4218 5.64031 19.281 5.78104L13.0607 12.0004L19.281 18.2198Z"
                                                      fill="#C2996F"/>
                                            </svg>
                                        </span>
										<svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" viewBox="0 0 52 52" fill="none">
											<path d="M44.3948 16.2933C44.3825 16.2362 44.3825 16.1771 44.3948 16.12C44.3843 16.07 44.3843 16.0183 44.3948 15.9683V15.7733L44.2648 15.4483C44.212 15.3596 44.1463 15.2793 44.0698 15.21L43.8748 15.0367H43.7665L35.2298 9.64166L27.1698 4.65833C26.9833 4.51041 26.7699 4.40004 26.5414 4.33333H26.3681C26.1745 4.301 25.9768 4.301 25.7831 4.33333H25.5664C25.3148 4.38899 25.0735 4.48405 24.8514 4.61499L8.66645 14.69L8.47145 14.8417L8.27645 15.015L8.05978 15.1667L7.95145 15.2967L7.82145 15.6217V15.8167V15.9467C7.8004 16.0903 7.8004 16.2363 7.82145 16.38V35.295C7.82071 35.6632 7.91383 36.0255 8.092 36.3478C8.27018 36.67 8.52754 36.9415 8.83978 37.1367L25.0898 47.19L25.4148 47.32H25.5881C25.9547 47.4363 26.3482 47.4363 26.7148 47.32H26.8881L27.2131 47.19L43.3331 37.2883C43.6454 37.0932 43.9027 36.8217 44.0809 36.4994C44.2591 36.1772 44.3522 35.8149 44.3514 35.4467V16.5317C44.3514 16.5317 44.3948 16.38 44.3948 16.2933ZM25.9998 9.03499L29.8564 11.4183L17.7448 18.915L13.8664 16.5317L25.9998 9.03499ZM23.8331 41.535L11.9164 34.255V20.41L23.8331 27.7767V41.535ZM25.9998 23.9633L21.8614 21.4717L33.9731 13.9533L38.1331 16.5317L25.9998 23.9633ZM40.0831 34.19L28.1664 41.6V27.7767L40.0831 20.41V34.19Z"
											      fill="#C2996F"/>
										</svg>
										<p class="modal-title"><?php pll_e( "Additional Options" ) ?></p>
										<div class="additional-options-list"></div>
										<a class="btn btn-primary btn-save-my-collection"><?php pll_e( "Save my collection" ) ?></a>
									</div>
								</div>
							</div>
							<div class="quantity-add-to-cart">
								<div class="product-quantity">
									<?php
									echo '<div class="custom-quantity">';
									echo '<span class="input-number-button minus">-</span>';
									echo '<input type="number" name="quantity" min="1" value="1"  class="custom-quantity-number">';
									echo '<span class="input-number-button plus">+</span>';
									echo '</div>';
									?>
								</div>
								<a href="#" class="btn btn-primary btn-add-to-cart active" data-product_quantity="1">
									<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
										<path d="M19.2497 14.6667H6.41634C6.17323 14.6667 5.94007 14.5701 5.76816 14.3982C5.59625 14.2263 5.49967 13.9931 5.49967 13.75C5.49967 13.5069 5.59625 13.2737 5.76816 13.1018C5.94007 12.9299 6.17323 12.8333 6.41634 12.8333H15.9863C16.5993 12.8334 17.1946 12.6286 17.6779 12.2516C18.1612 11.8747 18.5047 11.347 18.6538 10.7525L20.1663 4.80334C20.2007 4.66804 20.2037 4.5267 20.1751 4.39008C20.1465 4.25346 20.087 4.12517 20.0013 4.015C19.9122 3.90201 19.7977 3.81159 19.6671 3.75108C19.5365 3.69056 19.3935 3.66164 19.2497 3.66667H6.19634C6.00722 3.13175 5.65728 2.66842 5.19448 2.3402C4.73169 2.01197 4.17871 1.83493 3.61134 1.83334H2.74967C2.50656 1.83334 2.2734 1.92991 2.10149 2.10182C1.92958 2.27373 1.83301 2.50689 1.83301 2.75C1.83301 2.99312 1.92958 3.22628 2.10149 3.39818C2.2734 3.57009 2.50656 3.66667 2.74967 3.66667H3.61134C3.82074 3.66057 4.02591 3.72637 4.1927 3.85313C4.35948 3.97989 4.47782 4.15995 4.52801 4.36334L4.58301 4.80334L6.16884 11C5.4395 11.0328 4.75306 11.354 4.26054 11.893C3.76803 12.4319 3.50977 13.1444 3.54259 13.8738C3.57541 14.6031 3.89662 15.2895 4.43555 15.7821C4.97448 16.2746 5.687 16.5328 6.41634 16.5H6.58134C6.43058 16.9154 6.38214 17.361 6.44011 17.799C6.49808 18.2371 6.66077 18.6547 6.91438 19.0166C7.168 19.3784 7.50508 19.6738 7.89708 19.8778C8.28908 20.0817 8.72446 20.1882 9.16634 20.1882C9.60822 20.1882 10.0436 20.0817 10.4356 19.8778C10.8276 19.6738 11.1647 19.3784 11.4183 19.0166C11.6719 18.6547 11.8346 18.2371 11.8926 17.799C11.9505 17.361 11.9021 16.9154 11.7513 16.5H13.9147C13.7639 16.9154 13.7155 17.361 13.7734 17.799C13.8314 18.2371 13.9941 18.6547 14.2477 19.0166C14.5013 19.3784 14.8384 19.6738 15.2304 19.8778C15.6224 20.0817 16.0578 20.1882 16.4997 20.1882C16.9416 20.1882 17.3769 20.0817 17.7689 19.8778C18.1609 19.6738 18.498 19.3784 18.7516 19.0166C19.0052 18.6547 19.1679 18.2371 19.2259 17.799C19.2839 17.361 19.2354 16.9154 19.0847 16.5H19.2497C19.4928 16.5 19.7259 16.4034 19.8979 16.2315C20.0698 16.0596 20.1663 15.8265 20.1663 15.5833C20.1663 15.3402 20.0698 15.1071 19.8979 14.9352C19.7259 14.7632 19.4928 14.6667 19.2497 14.6667ZM18.0763 5.5L16.8755 10.3033C16.8253 10.5067 16.707 10.6868 16.5402 10.8135C16.3734 10.9403 16.1682 11.0061 15.9588 11H8.04801L6.67301 5.5H18.0763ZM9.16634 18.3333C8.98504 18.3333 8.80781 18.2796 8.65707 18.1789C8.50632 18.0781 8.38883 17.935 8.31945 17.7675C8.25007 17.6 8.23192 17.4157 8.26729 17.2378C8.30266 17.06 8.38996 16.8967 8.51816 16.7685C8.64636 16.6403 8.80969 16.553 8.98751 16.5176C9.16532 16.4822 9.34964 16.5004 9.51713 16.5698C9.68463 16.6392 9.8278 16.7567 9.92852 16.9074C10.0292 17.0581 10.083 17.2354 10.083 17.4167C10.083 17.6598 9.98643 17.8929 9.81452 18.0649C9.64261 18.2368 9.40946 18.3333 9.16634 18.3333ZM16.4997 18.3333C16.3184 18.3333 16.1411 18.2796 15.9904 18.1789C15.8397 18.0781 15.7222 17.935 15.6528 17.7675C15.5834 17.6 15.5653 17.4157 15.6006 17.2378C15.636 17.06 15.7233 16.8967 15.8515 16.7685C15.9797 16.6403 16.143 16.553 16.3208 16.5176C16.4987 16.4822 16.683 16.5004 16.8505 16.5698C17.018 16.6392 17.1611 16.7567 17.2619 16.9074C17.3626 17.0581 17.4163 17.2354 17.4163 17.4167C17.4163 17.6598 17.3198 17.8929 17.1479 18.0649C16.9759 18.2368 16.7428 18.3333 16.4997 18.3333Z"
										      fill="white"/>
									</svg>
									<?php pll_e( "Add to cart" ) ?>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="image-modal full-size-image-modal">
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
</div>

<?php get_footer(  ); ?>
