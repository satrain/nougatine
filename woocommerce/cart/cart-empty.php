<?php
/**
 * Empty cart page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-empty.php.
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

defined( 'ABSPATH' ) || exit;

/*
 * @hooked wc_empty_cart_message - 10
 */
// do_action( 'woocommerce_cart_is_empty' );

$shop_link = '';

if(pll_current_language() == 'en') {
	$shop_link = '/en/products-catalog/';
}
else {
	$shop_link = '/קטלוג-מוצרים/';
}


if ( wc_get_page_id( 'shop' ) > 0 ) : ?>
	<div class="nougatine-cart-empty">
		<img src="<?= ASSETS_URI ?>/images/empty-cart.png" alt="Shopping cart">
		<h3><?php pll_e("Your cart is empty") ?></h3>
		<p><?php pll_e("Craft your ideal menu with ease from our diverse selection of culinary delights.") ?></p>
	</div>
<?php endif; ?>
