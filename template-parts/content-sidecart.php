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
                                <span class="delete-item product-remove" data-product-id="<?= $product_id ?>">
                                <a>x</a>
                                </span>
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
										<div class="product-price-qty">
											<p class="quantity">x<?php echo $cart_item['quantity']; ?></p>
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
				<div class="need-a-quote">
					<img class="background-image" src="/wp-content/uploads/2024/04/CroppSandwiches.png" alt="Sandwiches">
					<p class="title"><?php pll_e( 'Need a quote?' ) ?></p>
					<p class="description"><?php pll_e( "Share your selection with your family, friends or coworkers to get their opinion!" ) ?></p>
					<a href="<?php echo esc_url( wp_nonce_url( add_query_arg( array( 'cart-pdf' => '1' ), wc_get_cart_url() ), 'cart-pdf' ) ); ?>" class="btn btn-primary export-btn">
						<svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24" fill="none">
							<path d="M20.5 8.94C20.4896 8.84813 20.4695 8.75763 20.44 8.67V8.58C20.3919 8.47718 20.3278 8.38267 20.25 8.3L14.25 2.3C14.1673 2.22222 14.0728 2.15808 13.97 2.11H13.88C13.7784 2.05174 13.6662 2.01434 13.55 2H7.5C6.70435 2 5.94129 2.31607 5.37868 2.87868C4.81607 3.44129 4.5 4.20435 4.5 5V19C4.5 19.7956 4.81607 20.5587 5.37868 21.1213C5.94129 21.6839 6.70435 22 7.5 22H17.5C18.2956 22 19.0587 21.6839 19.6213 21.1213C20.1839 20.5587 20.5 19.7956 20.5 19V9C20.5 9 20.5 9 20.5 8.94ZM14.5 5.41L17.09 8H15.5C15.2348 8 14.9804 7.89464 14.7929 7.70711C14.6054 7.51957 14.5 7.26522 14.5 7V5.41ZM18.5 19C18.5 19.2652 18.3946 19.5196 18.2071 19.7071C18.0196 19.8946 17.7652 20 17.5 20H7.5C7.23478 20 6.98043 19.8946 6.79289 19.7071C6.60536 19.5196 6.5 19.2652 6.5 19V5C6.5 4.73478 6.60536 4.48043 6.79289 4.29289C6.98043 4.10536 7.23478 4 7.5 4H12.5V7C12.5 7.79565 12.8161 8.55871 13.3787 9.12132C13.9413 9.68393 14.7044 10 15.5 10H18.5V19Z" fill="white"/>
						</svg>
						<?php pll_e( "Export as pdf" ) ?>
					</a>
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
		<div class="more-products"></div>
	</div>
</div>
