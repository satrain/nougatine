<?php
/**
 * Class WooRest
 *
 * Cart Rest API for Woocommerce
 */
class WooRest {
	/**
	 * register default hooks and actions for WordPress
	 *
	 * @return void
	 */
	function __construct() {
		add_action( 'rest_api_init', [ $this, 'registerRoutes' ] );
	}

	function registerRoutes() {
		register_rest_route( 'custom', '/add-to-cart', [
			'methods'             => 'GET',
			'callback'            => [ $this, 'addToCartCallback' ],
			'permission_callback' => '__return_true',
		] );
		register_rest_route( 'custom', '/update-cart', [
			'methods'             => 'POST',
			'callback'            => [ $this, 'updateCartCallback' ],
			'permission_callback' => '__return_true',
		] );
	}

	/**
	 * Custom add to cart function for Woocommerce
	 *
	 * @param WP_REST_Request $request
	 *
	 * @return WP_REST_Response
	 * @throws \Exception
	 * @throws GuzzleException
	 */
	function addToCartCallback( WP_REST_Request $request ): WP_REST_Response {
		$this->initWoocommerceCart();

		// If only refreshing cart, dont get all data
		if ( $request->get_param( 'refresh-cart' ) ) {
			$cart = WC()->cart;

			ob_start();
			get_template_part( 'views/partials/cart-popup', null, [ 'is_rest' => true ] );
			$layout = ob_get_clean();

			return new WP_REST_Response( [
				'cart_totals'   => $cart->get_cart_contents_count(),
				'cart_is_empty' => $cart->is_empty(),
				'layout'        => $layout,
			], 200 );
		}

		$product_id    = $request->get_param( 'product_id' );
		$product       = wc_get_product( $product_id );
		$quantity      = (int) $request->get_param( 'quantity' );
		$remove_id     = $request->get_param( 'remove' );
		$removed       = [];
		$added_to_cart = false;
		$custom_price  = $request->get_param( 'custom_price' );
		$refresh_page  = false;

		if ( $remove_id ) {
			$current_cart = WC()->cart;
			$removed      = $current_cart->remove_cart_item( $remove_id );
		} elseif ( $product_id ) {
			$added_to_cart = WC()->cart->add_to_cart( $product_id, 1, 0, [] );
		}

		// Get cart data
		$cart = WC()->cart;

		ob_start();
		get_template_part( 'views/partials/cart-popup', null, [ 'is_rest' => true ] );
		$layout = ob_get_clean();

		return new WP_REST_Response( [
			'cart'          => $cart,
			'contents'      => $cart->get_cart_contents(),
			'count'         => $cart->get_cart_contents_count(),
			'quantities'    => $cart->get_cart_item_quantities(),
			'cart_totals'   => $cart->get_cart_contents_count(),
			'cart_is_empty' => $cart->is_empty(),
			'layout'        => $layout,
			'removed'       => $removed,
			'notices'       => wc_print_notices( true ),
			'added_to_cart' => $added_to_cart,
		], 200 );
	}

	/**
	 * Custom refresh cart function for Woocommerce
	 *
	 * @param WP_REST_Request $request
	 *
	 * @return WP_REST_Response
	 * @throws \Exception
	 */
	function updateCartCallback( WP_REST_Request $request ): WP_REST_Response {
		$this->initWoocommerceCart();

		$data = json_decode( $request->get_body(), true );

		// Get cart data
		$cart = WC()->cart;

		if ( ! empty( $data ) && is_array( $data ) ) {
			foreach ( $data as $key => $qty ) {
				$cart_item_key = str_replace( 'cart[', '', $key );
				$cart_item_key = str_replace( '][qty]', '', $cart_item_key );
				$cart->set_quantity( $cart_item_key, $qty );
			}
		}

		$message = '<div class="woocommerce-message" role="alert">' . __( 'Korpa je ažurirana.', '' ) . '</div>';

		ob_start();
		get_template_part( 'views/partials/cart-popup', null, [ 'is_rest' => true ] );
		$layout = ob_get_clean();

		return new WP_REST_Response( [
			'cart'          => $cart,
			'contents'      => $cart->get_cart_contents(),
			'count'         => $cart->get_cart_contents_count(),
			'quantities'    => $cart->get_cart_item_quantities(),
			'cart_totals'   => $cart->get_cart_contents_count(),
			'cart_is_empty' => $cart->is_empty(),
			'layout'        => $layout,
			'message'       => $message,
		], 200 );
	}

	/**
	 * Init Woocommerce cart to connect to front end
	 *
	 * @return void
	 * @throws \Exception
	 *
	 */
	function initWoocommerceCart(): void {
		if ( defined( 'WC_ABSPATH' ) ) {
			include_once WC_ABSPATH . 'includes/wc-cart-functions.php';
			include_once WC_ABSPATH . 'includes/wc-notice-functions.php';
			include_once WC_ABSPATH . 'includes/wc-template-hooks.php';
		}

		if ( null === WC()->session ) {
			$session_class = apply_filters( 'woocommerce_session_handler', 'WC_Session_Handler' );

			WC()->session = new $session_class();
			WC()->session->init();
		}

		if ( null === WC()->customer ) {
			WC()->customer = new WC_Customer( get_current_user_id(), true );
		}

		if ( null === WC()->cart ) {
			WC()->cart = new WC_Cart();

			// We need to force a refresh of the cart contents from session here
			// (cart contents are normally refreshed on wp_loaded, which has already happened by this point).
			WC()->cart->get_cart();
		}
	}
}

new WooRest();
