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
							<?php do_action( 'delivery_checkout_fields', $checkout ); ?>
							<div class="content-bottom">
								<a class="btn btn-primary btn-continue btn-step-1"><?php pll_e( "Continue" ) ?></a>

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

	<?php endif; ?>

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
