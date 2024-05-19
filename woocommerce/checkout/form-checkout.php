<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );

	return;
}

?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

	<?php if ( $checkout->get_checkout_fields() ) : ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

		<div class="col2-set custom-checkout" id="customer_details">
			<div class="checkout-wrapper">
				<div id="checkout-steps">
					<div class="steps-indicator">
						<div class="indicators-line"></div>
						<div class="step active current" data-step="1">
							<span class="step-number">1</span>
							<p><?php pll_e( "Delivery" ) ?></p>
						</div>
						<div class="step" data-step="2">
							<span class="step-number">2</span>
							<p><?php pll_e( "Details" ) ?></p>
						</div>
						<div class="step" data-step="3">
							<span class="step-number">3</span>
							<p><?php pll_e( "Payment" ) ?></p>
						</div>
					</div>

					<div class="content">
						<div class="step-content step-1 active" id="step-delivery">
							<div id="dateslot">
								<div id="datepicker"></div>
							</div>
							<div id="timeslots">
								<h3>
									<?php
									$interval = get_option( 'timeslots_interval' );
									$span     = $interval / 60;
									?>
									<?php pll_e( "זמן האספקה המשוער לתאריך הנבחר הוא בטווח של
 <span> $span  שעה (ות.</span> " ) ?>
								</h3>
							</div>

							<?php do_action( 'delivery_checkout_fields', $checkout ); ?>
							<div class="content-bottom">
								<a class="btn btn-primary btn-continue active btn-step-1"><?php pll_e( "Continue" ) ?></a>
								<div class="notice">
									<p><?php pll_e( "Orders on the website minimum 24 hours before the delivery date. If the order is immediate, please call" ) ?> <a href="tel:050-7274809">050-7274809</a></p>
								</div>
							</div>
						</div>
						<div class="step-content step-2" id="step-details">
							<?php do_action( 'woocommerce_checkout_billing' ); ?>
							<?php do_action( 'woocommerce_checkout_shipping' ); ?>
							<a class="btn btn-primary btn-continue btn-step-2"><?php pll_e( "Continue" ) ?></a>
						</div>
						<div class="step-content step-3" id="step-payment">
							<?php do_action( 'woocommerce_custom_payment_output', $checkout ); ?>
						</div>
						<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
					</div>
				</div>
				<div id="order-summary" class="hide-mobile">
					<div class="order-summary-wrapper">
						<div class="order-summary-card">
							<h3 class="card-title"><?php pll_e( "Your Order" ) ?></h3>
							<div class="separator hide-mobile"></div>

							<div class="products">
								<div class="edit-order">
									<div class="left-side">
										<a href="<?php echo wc_get_cart_url() ?>"><?php pll_e( "Edit order" ) ?></a>
										<div class="order-count-price">
											<?php
											$cart_subtotal = WC()->cart->get_cart_subtotal();
											$cart_count    = WC()->cart->get_cart_contents_count();
											?>
											<div class="count"><?= $cart_count ?><?php pll_e( "items" ) ?></div>
											<div class="price"><?= $cart_subtotal ?></div>
										</div>
									</div>
									<div class="trash">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
											<path d="M14.0003 17.9992C14.2655 17.9992 14.5199 17.8938 14.7074 17.7063C14.8949 17.5187 15.0003 17.2644 15.0003 16.9992V14.9992C15.0003 14.734 14.8949 14.4796 14.7074 14.2921C14.5199 14.1045 14.2655 13.9992 14.0003 13.9992C13.7351 13.9992 13.4807 14.1045 13.2932 14.2921C13.1056 14.4796 13.0003 14.734 13.0003 14.9992V16.9992C13.0003 17.2644 13.1056 17.5187 13.2932 17.7063C13.4807 17.8938 13.7351 17.9992 14.0003 17.9992ZM10.0003 17.9992C10.2655 17.9992 10.5199 17.8938 10.7074 17.7063C10.8949 17.5187 11.0003 17.2644 11.0003 16.9992V14.9992C11.0003 14.734 10.8949 14.4796 10.7074 14.2921C10.5199 14.1045 10.2655 13.9992 10.0003 13.9992C9.73506 13.9992 9.48071 14.1045 9.29317 14.2921C9.10564 14.4796 9.00028 14.734 9.00028 14.9992V16.9992C9.00028 17.2644 9.10564 17.5187 9.29317 17.7063C9.48071 17.8938 9.73506 17.9992 10.0003 17.9992ZM19.0003 5.99917H17.6203L15.8903 2.54917C15.8374 2.42223 15.7589 2.30755 15.6598 2.2123C15.5606 2.11705 15.4428 2.04329 15.3138 1.99561C15.1848 1.94794 15.0474 1.92738 14.9101 1.93522C14.7728 1.94306 14.6386 1.97913 14.5159 2.04118C14.3932 2.10323 14.2846 2.18992 14.1969 2.29584C14.1092 2.40176 14.0443 2.52463 14.0062 2.65677C13.9681 2.78891 13.9577 2.92748 13.9756 3.06382C13.9935 3.20016 14.0394 3.33135 14.1103 3.44917L15.3803 5.99917H8.62028L9.89028 3.44917C9.98735 3.21608 9.99264 2.9549 9.9051 2.71806C9.81756 2.48122 9.64367 2.28627 9.41834 2.17234C9.19301 2.05841 8.93292 2.03393 8.6903 2.10383C8.44767 2.17373 8.24046 2.33282 8.11028 2.54917L6.38028 5.99917H5.00028C4.29347 6.00992 3.61316 6.26992 3.07933 6.7333C2.5455 7.19669 2.19245 7.8337 2.08245 8.53198C1.97245 9.23026 2.11256 9.94496 2.47807 10.55C2.84358 11.1551 3.41101 11.6116 4.08028 11.8392L4.82028 19.2992C4.8949 20.0417 5.24363 20.7298 5.79835 21.2291C6.35308 21.7283 7.07398 22.0029 7.82028 21.9992H16.2003C16.9466 22.0029 17.6675 21.7283 18.2222 21.2291C18.7769 20.7298 19.1257 20.0417 19.2003 19.2992L19.9403 11.8392C20.611 11.611 21.1793 11.1527 21.5446 10.5457C21.9098 9.93857 22.0484 9.2218 21.9359 8.52232C21.8233 7.82283 21.4667 7.18576 20.9294 6.72395C20.3921 6.26214 19.7087 6.00538 19.0003 5.99917ZM17.1903 19.0992C17.1654 19.3467 17.0492 19.5761 16.8643 19.7425C16.6793 19.9089 16.439 20.0004 16.1903 19.9992H7.81028C7.56151 20.0004 7.32121 19.9089 7.1363 19.7425C6.9514 19.5761 6.83515 19.3467 6.81028 19.0992L6.10028 11.9992H17.9003L17.1903 19.0992ZM19.0003 9.99917H5.00028C4.73506 9.99917 4.48071 9.89382 4.29317 9.70628C4.10564 9.51874 4.00028 9.26439 4.00028 8.99917C4.00028 8.73396 4.10564 8.4796 4.29317 8.29207C4.48071 8.10453 4.73506 7.99917 5.00028 7.99917H19.0003C19.2655 7.99917 19.5199 8.10453 19.7074 8.29207C19.8949 8.4796 20.0003 8.73396 20.0003 8.99917C20.0003 9.26439 19.8949 9.51874 19.7074 9.70628C19.5199 9.89382 19.2655 9.99917 19.0003 9.99917Z"
											      fill="white"/>
										</svg>
									</div>
								</div>
								<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>

								<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

								<div id="order_review" class="woocommerce-checkout-review-order">
									<?php do_action( 'woocommerce_checkout_order_review' ); ?>
								</div>

								<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>

	<?php endif; ?>
</form>
<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
