<?php
$cart_count    = '';
$cart_subtotal = '';
if ( function_exists( 'WC' ) ) {
	$cart_count    = WC()->cart->get_cart_contents_count();
	$cart_subtotal = WC()->cart->get_cart_subtotal();
}
?>

<div class="nougatine-sidecart">
	<div class="sidecart-wrapper">
		<div class="sidecart-content">
			<div class="upper">
                <span class="close-sidecart">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M19.281 18.2198C19.3507 18.2895 19.406 18.3722 19.4437 18.4632C19.4814 18.5543 19.5008 18.6519 19.5008 18.7504C19.5008 18.849 19.4814 18.9465 19.4437 19.0376C19.406 19.1286 19.3507 19.2114 19.281 19.281C19.2114 19.3507 19.1286 19.406 19.0376 19.4437C18.9465 19.4814 18.849 19.5008 18.7504 19.5008C18.6519 19.5008 18.5543 19.4814 18.4632 19.4437C18.3722 19.406 18.2895 19.3507 18.2198 19.281L12.0004 13.0607L5.78104 19.281C5.64031 19.4218 5.44944 19.5008 5.25042 19.5008C5.05139 19.5008 4.86052 19.4218 4.71979 19.281C4.57906 19.1403 4.5 18.9494 4.5 18.7504C4.5 18.5514 4.57906 18.3605 4.71979 18.2198L10.9401 12.0004L4.71979 5.78104C4.57906 5.64031 4.5 5.44944 4.5 5.25042C4.5 5.05139 4.57906 4.86052 4.71979 4.71979C4.86052 4.57906 5.05139 4.5 5.25042 4.5C5.44944 4.5 5.64031 4.57906 5.78104 4.71979L12.0004 10.9401L18.2198 4.71979C18.3605 4.57906 18.5514 4.5 18.7504 4.5C18.9494 4.5 19.1403 4.57906 19.281 4.71979C19.4218 4.86052 19.5008 5.05139 19.5008 5.25042C19.5008 5.44944 19.4218 5.64031 19.281 5.78104L13.0607 12.0004L19.281 18.2198Z"
                              fill="#2C2B2E"/>
                    </svg>
                </span>
				<p class="sidecart-title"><?php pll_e( 'Your cart' ) ?> <span class="quantity">(<?= $cart_count ?>)</span></p>
				<!-- Sidecart empty state --->
				<div class="empty-cart">
					<img src="<?= ASSETS_URI ?>/images/empty-cart.png" alt="Shopping cart">
					<h3><?php pll_e( "Your cart is empty" ) ?></h3>
					<p><?php pll_e( "Craft your ideal menu with ease from our diverse selection of culinary delights." ) ?></p>
				</div>
				<div class="sidecart-products">
					<div class="container">

						<?php
						foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
							$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
							$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
							/**
							 * Filter the product name.
							 *
							 * @param string $product_name Name of the product in the cart.
							 * @param array $cart_item The product in the cart.
							 * @param string $cart_item_key Key for the product in the cart.
							 *
							 * @since 2.1.0
							 */
							$product_name = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
							if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
								$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
								?>
								<div class="product">
									<?php
									$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
									echo $thumbnail;
									?>
									<!-- <img class="product-image" src="/wp-content/uploads/2024/04/01-1-2.png" alt=""> -->
									<div class="product-content">
										<div class="product-info">
											<p class="product-title">
												<?php
												if ( ! $product_permalink ) {
													echo wp_kses_post( $product_name . '&nbsp;' );
												} else {
													/**
													 * This filter is documented above.
													 *
													 * @since 2.1.0
													 */
													echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
												}
												?>
											</p>
											<span class="delete-item product-remove" data-product-id="<?= $product_id ?>">
                               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
<path d="M13.3333 3.99967H10.6667V3.33301C10.6667 2.80257 10.456 2.29387 10.0809 1.91879C9.70581 1.54372 9.1971 1.33301 8.66667 1.33301H7.33333C6.8029 1.33301 6.29419 1.54372 5.91912 1.91879C5.54405 2.29387 5.33333 2.80257 5.33333 3.33301V3.99967H2.66667C2.48986 3.99967 2.32029 4.06991 2.19526 4.19494C2.07024 4.31996 2 4.48953 2 4.66634C2 4.84315 2.07024 5.01272 2.19526 5.13775C2.32029 5.26277 2.48986 5.33301 2.66667 5.33301H3.33333V12.6663C3.33333 13.1968 3.54405 13.7055 3.91912 14.0806C4.29419 14.4556 4.8029 14.6663 5.33333 14.6663H10.6667C11.1971 14.6663 11.7058 14.4556 12.0809 14.0806C12.456 13.7055 12.6667 13.1968 12.6667 12.6663V5.33301H13.3333C13.5101 5.33301 13.6797 5.26277 13.8047 5.13775C13.9298 5.01272 14 4.84315 14 4.66634C14 4.48953 13.9298 4.31996 13.8047 4.19494C13.6797 4.06991 13.5101 3.99967 13.3333 3.99967ZM6.66667 3.33301C6.66667 3.1562 6.7369 2.98663 6.86193 2.8616C6.98695 2.73658 7.15652 2.66634 7.33333 2.66634H8.66667C8.84348 2.66634 9.01305 2.73658 9.13807 2.8616C9.2631 2.98663 9.33333 3.1562 9.33333 3.33301V3.99967H6.66667V3.33301ZM11.3333 12.6663C11.3333 12.8432 11.2631 13.0127 11.1381 13.1377C11.013 13.2628 10.8435 13.333 10.6667 13.333H5.33333C5.15652 13.333 4.98695 13.2628 4.86193 13.1377C4.7369 13.0127 4.66667 12.8432 4.66667 12.6663V5.33301H11.3333V12.6663Z"
      fill="#868686"/>
</svg> <a><?= pll_e( 'Remove' ) ?></a>
                                </span>
										</div>

										<div class="product-price-qty">
											<p class="quantity"><?php echo $cart_item['quantity']; ?></p>
											<p class="price">
												<?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); ?>
											</p>
										</div>
									</div>
								</div>
							<?php }
						} ?>
					</div>
				</div>
			</div>
			<div class="bottom">
				<?php
				$title    = get_field( 'title', 'option' );
				$products = get_field( 'products','option' );

				?>
				<div class="best-sellers">
					<div class="container">
						<h2><?= $title ?></h2>
						<div class="best-sellers-wrapper">
							<?php
							foreach ( $products as $product ):
								$price        = get_post_meta( $product->ID, '_price', true );
								$products_arr = [ 'id' => $product->ID, 'name' => $product->post_title, 'price' => $price, 'placement' => 'slider' ];
								get_template_part( 'template-parts/content', 'product', $products_arr );
							endforeach;

							?>
						</div>
					</div>
				</div>
				<div class="payment">
					<div class="subtotal">
						<p><?php pll_e( "Subtotal" ) ?></p>
						<span class="price"><?= $cart_subtotal ?></span>
					</div>
					<?php
					$secure_payment = '/לבדוק/';
					$cart           = '/עגלת-הקניות-שלך/';
					if ( get_locale() !== 'he_IL' ) {
						$secure_payment = wc_get_checkout_url();
						$cart           = wc_get_cart_url();
					}
					?>
					<a href="<?= $secure_payment ?>" class="btn btn-primary btn-secure-payment"><?php pll_e( "Secure Payment" ) ?></a>
					<a href="<?= $cart ?>" class="btn btn-secondary"><?php pll_e( "Shopping Cart" ) ?></a>
				</div>
			</div>
		</div>
		<div class="more-products">
			<?php
			$title    = get_field( 'title', 'option' );
			$products = get_field( 'products','option' );

			?>
			<div class="best-sellers">
				<div class="container">
					<h2><?= $title ?></h2>
					<div class="best-sellers-slider">
						<?php
						foreach ( $products as $product ):
							$price        = get_post_meta( $product->ID, '_price', true );
							$products_arr = [ 'id' => $product->ID, 'name' => $product->post_title, 'price' => $price, 'placement' => 'slider' ];
							get_template_part( 'template-parts/content', 'product', $products_arr );
						endforeach;

						?>
					</div>
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
											echo '<span class="input-number-button decrement-quantity">-</span>';
											echo '<input type="number" name="quantity" value="1" data-cart-item-key="" class="custom-input-number">';
											echo '<span class="input-number-button increment-quantity">+</span>';
											echo '</div>';
											?>
										</div>
										<a href="#" class="btn btn-primary btn-add-to-cart">
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
	</div>
</div>
