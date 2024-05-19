<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined( 'ABSPATH' ) || exit;

$load_items = false;
if ( WC()->cart->get_cart_contents_count() > 3 ) {
	$load_items = true;
}

?>
<div class="shop_table woocommerce-checkout-review-order-table ">
	<div class="products-list">

		<div class="list <?= $load_items ? 'load_items' : '' ?>">
			<?php
			do_action( 'woocommerce_review_order_before_cart_contents' );

			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					?>
					<div class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item product', $cart_item, $cart_item_key ) ); ?>">
						<?php
						$product   = $cart_item['data'];
						$image_url = wp_get_attachment_image_url( $product->get_image_id(), 'thumbnail' );
						?>

						<div class="content">
							<img src="<?= $image_url ?>" alt="Product image">
							<p><?= $_product->get_name()  ?></p>
						</div>
						<div class="price-amount">
							<span class="amount">×<?= $cart_item['quantity'] ?></span>
							<p class="price"><?= WC()->cart->get_product_price( $_product ) ?></p>
						</div>

					</div>
					<?php
				}
			}

			do_action( 'woocommerce_review_order_after_cart_contents' );
			?>
		</div>
		<?php
		if ( $load_items ) { ?>
			<a class="btn btn-secondary btn-see-whole-order">
				<?php pll_e( "See whole order" ) ?>
				<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
					<path d="M3.40604 6.23503C3.32648 6.15984 3.23289 6.10107 3.13062 6.06206C3.02835 6.02304 2.91939 6.00456 2.80997 6.00765C2.70055 6.01075 2.59282 6.03536 2.49291 6.0801C2.39301 6.12483 2.30289 6.1888 2.22771 6.26836C2.15253 6.34792 2.09375 6.44151 2.05474 6.54378C2.01572 6.64606 1.99724 6.75501 2.00033 6.86443C2.00343 6.97385 2.02805 7.08159 2.07278 7.18149C2.11751 7.2814 2.18148 7.37151 2.26104 7.44669L9.76104 14.53C9.91577 14.6763 10.1206 14.7578 10.3335 14.7578C10.5465 14.7578 10.7513 14.6763 10.906 14.53L18.4069 7.44669C18.4882 7.37201 18.5538 7.28191 18.6 7.18164C18.6462 7.08137 18.672 6.97292 18.6759 6.86259C18.6798 6.75226 18.6618 6.64225 18.6228 6.53895C18.5839 6.43566 18.5248 6.34113 18.449 6.26086C18.3732 6.1806 18.2822 6.11619 18.1813 6.07138C18.0804 6.02658 17.9716 6.00227 17.8613 5.99986C17.7509 5.99746 17.6411 6.01701 17.5384 6.05738C17.4356 6.09775 17.3419 6.15814 17.2627 6.23503L10.3335 12.7784L3.40604 6.23503Z" fill="#C2996F"/>
				</svg>
			</a>
		<?php } ?>
	</div>
	<div class="totals_wrapper">
		<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

		<div class="total-subtotal">
			<div class="subtotal">
				<p><?php pll_e( "Subtotal" ) ?></p>
				<span class="price"> <?php wc_cart_totals_subtotal_html(); ?></span>
			</div>
			<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
				<div class="delivery-price-wrapper active">
					<p><?php pll_e( "Delivery" ) ?></p>
					<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

					<?php wc_cart_totals_shipping_html(); ?>

					<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>
				</div>
				<div class="separator"></div>
			<?php endif; ?>
			<div class="total">
				<p><?php pll_e( "Total" ) ?></p>
				<span class="price"><?php wc_cart_totals_order_total_html() ?></span>
			</div>
		</div>
		<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>
	</div>
</div>
