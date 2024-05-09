<?php
/**
 * Proceed to checkout button
 *
 * Contains the markup for the proceed to checkout button on the cart.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/proceed-to-checkout-button.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$checkout_url = '';

if (get_locale() == 'he_IL') {
	$checkout_url = '/לבדוק/';
}
else {
	$checkout_url = '/en/checkout/';
}
?>

<a href="<?php echo $checkout_url; ?>" class="checkout-button button alt wc-forward<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>">
	<svg xmlns="http://www.w3.org/2000/svg" width="29" height="28" viewBox="0 0 29 28" fill="none">
		<path d="M8.66634 17.5007H12.1663C12.4758 17.5007 12.7725 17.3777 12.9913 17.1589C13.2101 16.9401 13.333 16.6434 13.333 16.334C13.333 16.0246 13.2101 15.7278 12.9913 15.509C12.7725 15.2902 12.4758 15.1673 12.1663 15.1673H8.66634C8.35692 15.1673 8.06018 15.2902 7.84138 15.509C7.62259 15.7278 7.49967 16.0246 7.49967 16.334C7.49967 16.6434 7.62259 16.9401 7.84138 17.1589C8.06018 17.3777 8.35692 17.5007 8.66634 17.5007ZM22.6663 5.83398H6.33301C5.40475 5.83398 4.51451 6.20273 3.85813 6.85911C3.20176 7.51549 2.83301 8.40573 2.83301 9.33398V19.834C2.83301 20.7622 3.20176 21.6525 3.85813 22.3089C4.51451 22.9652 5.40475 23.334 6.33301 23.334H22.6663C23.5946 23.334 24.4848 22.9652 25.1412 22.3089C25.7976 21.6525 26.1663 20.7622 26.1663 19.834V9.33398C26.1663 8.40573 25.7976 7.51549 25.1412 6.85911C24.4848 6.20273 23.5946 5.83398 22.6663 5.83398ZM23.833 19.834C23.833 20.1434 23.7101 20.4402 23.4913 20.6589C23.2725 20.8777 22.9758 21.0007 22.6663 21.0007H6.33301C6.02359 21.0007 5.72684 20.8777 5.50805 20.6589C5.28926 20.4402 5.16634 20.1434 5.16634 19.834V12.834H23.833V19.834ZM23.833 10.5007H5.16634V9.33398C5.16634 9.02457 5.28926 8.72782 5.50805 8.50903C5.72684 8.29023 6.02359 8.16732 6.33301 8.16732H22.6663C22.9758 8.16732 23.2725 8.29023 23.4913 8.50903C23.7101 8.72782 23.833 9.02457 23.833 9.33398V10.5007Z" fill="white"/>
	</svg>
	<?php pll_e( 'Proceed to checkout' ); ?>
</a>
