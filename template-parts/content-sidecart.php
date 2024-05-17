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
													echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), truncateString($_product->get_name(), 15) ), $cart_item, $cart_item_key ) );
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
					$secure_payment = wc_get_checkout_url();
					$cart           = wc_get_cart_url();
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
