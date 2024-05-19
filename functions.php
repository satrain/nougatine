<?php

if ( ! defined( '_S_VERSION' ) ) {
	define( '_S_VERSION', '1.0.1' );
}

@ini_set( 'upload_max_size', '128M' );

@ini_set( 'post_max_size', '128M' );

@ini_set( 'max_execution_time', '300' );

/**
 * include constants
 */
require_once 'inc/constants.php';

/**
 * include CPTs'
 */
require_once 'inc/testimonials-cpt.php';
require_once 'inc/faq-cpt.php';
require_once 'inc/gallery-cpt.php';

/**
 * include acf import (ACF Blocks)
 */
require_once 'inc/setup-custom-fields.php';

/**
 * include acf blocks
 */
require_once 'inc/acf_blocks.php';

/**
 * include custom Polylang strings
 */
require_once 'inc/translations.php';

/** NM customizations */
require_once 'inc/settings-checkout-timers.php';
require_once 'inc/settings-checkout.php';
require_once 'inc/settings-clap-co-il.php';
require_once 'inc/settings-enqueue-dequeue.php';

remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_enqueue_scripts', 'wp_enqueue_classic_theme_styles' );

add_action( 'after_setup_theme', 'alokin_add_theme_support' );
add_action( 'widgets_init', 'alokin_widgets_init' );
add_action( 'wp_enqueue_scripts', 'remove_wp_block_library_css', 100 );
add_action( 'wp_enqueue_scripts', 'alokin_enqueue_assets' );

add_action( 'woocommerce_cart_calculate_fees', 'add_custom_delivery_charge', 20 );

add_filter( 'nav_menu_css_class', 'add_active_class_to_menu_item', 10, 2 );
add_filter( 'woocommerce_cart_item_quantity', 'custom_cart_item_quantity_html', 10, 3 );
add_filter( 'body_class', 'add_class_to_body' );

add_action( 'wp_ajax_update_cart_item_quantity', 'update_cart_item_quantity' );
add_action( 'wp_ajax_nopriv_update_cart_item_quantity', 'update_cart_item_quantity' );
add_action( 'wp_ajax_modal_load_product_data', 'modal_load_product_data' );
add_action( 'wp_ajax_nopriv_modal_load_product_data', 'modal_load_product_data' );
add_action( 'wp_ajax_custom_ajax_add_to_cart', 'custom_ajax_add_to_cart' );
add_action( 'wp_ajax_nopriv_custom_ajax_add_to_cart', 'custom_ajax_add_to_cart' );
add_action( 'wp_ajax_get_side_cart_products_html', 'get_side_cart_products_html' );
add_action( 'wp_ajax_nopriv_get_side_cart_products_html', 'get_side_cart_products_html' );
add_action( 'wp_ajax_remove_item_from_cart', 'remove_item_from_cart' );
add_action( 'wp_ajax_nopriv_remove_item_from_cart', 'remove_item_from_cart' );
add_action( 'wp_ajax_handle_delivery_charge', 'handle_delivery_charge' );
add_action( 'wp_ajax_nopriv_handle_delivery_charge', 'handle_delivery_charge' );
add_action( 'wp_ajax_search_faqs', 'search_faqs' );
add_action( 'wp_ajax_nopriv_search_faqs', 'search_faqs' ); // Allow non-logged in users to use the function
add_action( 'wp_ajax_woocommerce_get_cart', 'woocommerce_get_cart' );
add_action( 'wp_ajax_nopriv_woocommerce_get_cart', 'woocommerce_get_cart' );
add_action( 'wp_ajax_remove_delivery_charge', 'remove_delivery_charge' );
add_action( 'wp_ajax_nopriv_remove_delivery_charge', 'remove_delivery_charge' );
add_filter( 'walker_nav_menu_start_el', 'add_tooltip_to_menu_items', 10, 4 );


/**
 * Add theme support
 */
function alokin_add_theme_support() {
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );

	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'nougatine' ),
		)
	);

	$args = array(
		'height'      => 50,
		'width'       => 200,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
	);
	add_theme_support( 'custom-logo', $args );
	add_image_size( 'gallery-size', 800, 460, array( 'center', 'center' ) );

}

function alokin_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'nougatine' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'nougatine' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Language Switcher', 'nougatine' ),
			'id'            => 'language_switcher_widget_area',
			'description'   => esc_html__( 'Add widgets here to display language switcher.', 'nougatine' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'WooCommerce Cart', 'nougatine' ),
			'id'            => 'woocommerce_cart_widget_area',
			'description'   => esc_html__( 'Add WooCommerce cart widget here.', 'nougatine' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Search', 'nougatine' ),
			'id'            => 'search_widget_area',
			'description'   => esc_html__( 'Add search widget here.', 'nougatine' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}

function remove_wp_block_library_css() {
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'wc-blocks-style' );
}

function alokin_enqueue_assets() {
	wp_register_style( 'swiper_style', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css' );
	wp_enqueue_style( 'swiper_style' );
	wp_register_script( 'swiper_script', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js' );
	wp_enqueue_script( 'swiper_script' );

	wp_register_style( 'slick_theme_style', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css' );
	wp_enqueue_style( 'slick_theme_style' );
	wp_register_style( 'slick_style', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css' );
	wp_enqueue_style( 'slick_style' );
	wp_register_script( 'slick_script', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js' );
	wp_enqueue_script( 'slick_script' );

	wp_enqueue_style( 'lightbox-style', 'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css' );
	wp_enqueue_script( 'lightbox-script', 'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js', array( 'jquery' ), '', true );

//	wp_register_style( 'aos_style', 'https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css' );
//	wp_enqueue_style( 'aos_style' );
//	wp_register_script( 'aos_script', 'https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js' );
//	wp_enqueue_script( 'aos_script' );

	wp_register_style( 'main_style', get_template_directory_uri() . '/assets/css/theme.min.css', array(), _S_VERSION, 'all' );
	wp_enqueue_style( 'main_style' );
	wp_enqueue_script( 'main-script', get_template_directory_uri() . '/assets/js/script.min.js', array( 'jquery' ), _S_VERSION, true );
	wp_localize_script( 'main-script', 'ajax_object', array(
		'ajax_url' => admin_url( 'admin-ajax.php' ),
		'root'     => esc_url_raw( rest_url() ),
		'nonce'    => wp_create_nonce( 'wp_rest' ),
	) );

	if ( is_checkout() || is_cart() ) {
		wp_enqueue_script( 'checkout-script', get_template_directory_uri() . '/assets/js/checkout.min.js', array( 'jquery' ), _S_VERSION, true );

		$disabled_dates = get_option( 'disabled_dates', '' );
		$disabled_dates = array_map( 'trim', explode( ',', $disabled_dates ) );

		$start_time = get_option( 'timeslots_start_time' );
		$end_time   = get_option( 'timeslots_end_time' );
		$interval   = get_option( 'timeslots_interval' );
		wp_enqueue_style( 'pikaday', 'https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css', array(), null );
		wp_enqueue_script( 'pikaday', 'https://cdn.jsdelivr.net/npm/pikaday/pikaday.js', array( 'moment' ), null, true );

		wp_enqueue_script( 'jquery-ui', 'https://code.jquery.com/ui/1.12.1/jquery-ui.js', array( 'jquery' ), '1.12.1', true );
		wp_enqueue_script( 'jquery-ui-dialog', 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.dialog.min.js', array( 'jquery', 'jquery-ui' ), '1.12.1', true );

		wp_enqueue_style( 'jquery-ui', '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css' );

		wp_localize_script( 'main-script', 'pickersTime', array(
			'startTime' => $start_time,
			'endTime'   => $end_time,
			'interval'  => $interval,
		) );

		wp_localize_script( 'pikaday', 'pickersDate', array(
			'disabledDates' => $disabled_dates,
		) );
	}

	if ( is_page_template( 'templates/faq.php' ) ) {
		wp_enqueue_script( 'faq-script', get_template_directory_uri() . '/assets/js/faq.min.js', array( 'jquery' ), _S_VERSION, true );
	}

}

function add_active_class_to_menu_item( $classes, $item ) {
	if ( in_array( 'current-menu-item', $classes ) ) {
		$classes[] = 'active';
	}

	return $classes;
}

function custom_cart_item_quantity_html( $product_quantity, $cart_item_key, $cart_item ) {
	// Get the current quantity
	$quantity = $cart_item['quantity'];

	// Modify the HTML structure of the quantity input field here
	$html = '<div class="custom-quantity">';
	$html .= '<span class="input-number-button decrement-quantity">-</span>';
	$html .= '<input type="number" name="quantity" value="' . esc_attr( $quantity ) . '" data-cart-item-key="' . esc_attr( $cart_item_key ) . '" class="custom-input-number">';
	$html .= '<span class="input-number-button increment-quantity">+</span>';
	$html .= '</div>';

	return $html;
}

function update_cart_item_quantity() {
	if ( isset( $_POST['cart_item_key'] ) && isset( $_POST['quantity'] ) ) {
		$cart_item_key = sanitize_text_field( $_POST['cart_item_key'] );
		$quantity      = intval( $_POST['quantity'] );

		// Update cart item quantity
		WC()->cart->set_quantity( $cart_item_key, $quantity );

		// Calculate subtotal
		$subtotal = WC()->cart->get_subtotal();

		// Return JSON response
		wp_send_json_success( array(
			'subtotal' => wc_price( $subtotal ),
		) );
	} else {
		wp_send_json_error( 'Invalid request.' );
	}

	wp_die();
}

function modal_load_product_data() {
	$product_data = [];

	$product_id           = $_POST['product_id'];
	$personalized_message = get_field( 'personalized_message', $product_id );
	$bundle_items         = get_field( 'bundle_items', $product_id );
	$select_options       = get_field( 'select_options', $product_id );
	$additional_options   = get_field( 'additional_options', $product_id );
	$product_variation    = [];
	$variation_ids        = [];
	$variation_prices     = [];
	$labels               = [];

	if ( ! empty( $personalized_message ) ) {
		$product_data['personalized_message'] = $personalized_message;
	}

	if ( ! empty( $bundle_items ) ) {
		$product_data['bundle_items'] = $bundle_items;
	}

	if ( ! empty( $select_options ) ) {
		$product_data['select_options'] = $select_options;
	}

	if ( ! empty( $additional_options ) ) {
		$product_data['additional_options'] = $additional_options;
	}

	// Ensure the WC_Product_Factory class is loaded
	if ( class_exists( 'WC_Product_Factory' ) ) {
		$product_factory = new WC_Product_Factory();
		$product         = $product_factory->get_product( $product_id );
	} else {
		// Fallback if the product factory isn't available
		$product = wc_get_product( $product_id );
	}

	// Check if product exists and is a variable product
	if ( $product && $product->is_type( 'variable' ) ) {
		$variations = $product->get_available_variations();

		if ( ! empty( $variations ) ) {

			foreach ( $variations as $variation ) {
				$variation_id       = $variation['variation_id'];
				$variation_price    = $variation['display_price'];
				$variation_ids[]    = $variation_id;
				$variation_prices[] = $variation_price;

				// Construct the label with attributes and price
				$attributes = array();
				foreach ( $variation['attributes'] as $attribute => $value ) {
					$attributes[] = $value;
				}
				$label    = implode( ', ', $attributes ) . ' ' . wc_price( $variation_price );
				$labels[] = $label;
			}

			$product_variation['ids']    = $variation_ids;
			$product_variation['prices'] = $variation_prices;
			$product_variation['labels'] = $labels;

		}
	}

	if ( ! empty( $product_variation ) ) {
		$product_data['product_variation'] = $product_variation;
	}

	$product_data['product_description'] = wc_get_product( $product_id )->get_short_description();

	$product_obj              = wc_get_product( $product_id );
	$product_data['in_stock'] = true;
	if ( ! $product_obj->is_in_stock() ) {
		$product_data['in_stock'] = false;
	}

	return wp_send_json_success( $product_data );

	wp_die();
}

function get_product_variations( $product_id ) {
	$product_variation = [];
	// Ensure the WC_Product_Factory class is loaded
	if ( class_exists( 'WC_Product_Factory' ) ) {
		$product_factory = new WC_Product_Factory();
		$product         = $product_factory->get_product( $product_id );
	} else {
		// Fallback if the product factory isn't available
		$product = wc_get_product( $product_id );
	}

	// Check if product exists and is a variable product
	if ( $product && $product->is_type( 'variable' ) ) {
		$variations = $product->get_available_variations();

		if ( ! empty( $variations ) ) {

			foreach ( $variations as $variation ) {
				$variation_id       = $variation['variation_id'];
				$variation_price    = $variation['display_price'];
				$variation_ids[]    = $variation_id;
				$variation_prices[] = $variation_price;

				// Construct the label with attributes and price
				$attributes = array();
				foreach ( $variation['attributes'] as $attribute => $value ) {
					$attributes[] = $value;
				}
				$label    = implode( ', ', $attributes ) . ' ' . wc_price( $variation_price );
				$labels[] = $label;
			}

			$product_variation['ids']    = $variation_ids;
			$product_variation['prices'] = $variation_prices;
			$product_variation['labels'] = $labels;

		}
	}

	return $product_variation;
}

function custom_ajax_add_to_cart() {
	$product_id   = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $_POST['product_id'] ) );
	$quantity     = empty( $_POST['quantity'] ) ? 1 : wc_stock_amount( $_POST['quantity'] );
	$variation_id = isset( $_POST['variation_id'] ) ? absint( $_POST['variation_id'] ) : 0; // Defaults to 0 if not set

	$passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity, $variation_id );

	if ( $passed_validation ) {
		if ( $variation_id ) {
			$cart_item_key = WC()->cart->add_to_cart( $product_id, $quantity, $variation_id );
		} else {
			$cart_item_key = WC()->cart->add_to_cart( $product_id, $quantity );
		}

		if ( $cart_item_key ) {
			do_action( 'woocommerce_ajax_added_to_cart', $product_id );
			echo json_encode( [ 'success' => true, 'message' => 'Product added' ] );
		} else {
			echo json_encode( [ 'success' => false, 'message' => 'Failed to add product' ] );
		}
	} else {
		echo json_encode( [ 'success' => false, 'message' => 'Failed to add product' ] );
	}

	wp_die();
}

function get_side_cart_products_html() {
	$subtotal = WC()->cart->get_subtotal();
	ob_start(); // Start output buffering

	foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
		$_product          = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
		$product_id        = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
		$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
		$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
		$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );

		// Echo out the structure for each product
		?>
		<div class="product">
			<?php echo $thumbnail; ?>
			<div class="product-content">
                <span class="delete-item product-remove" data-product-id="<?= $product_id ?>">
                <a>x</a>
                </span>
				<p class="product-title"><?php echo $product_name; ?></p>
				<div class="product-price-qty">
					<p class="quantity">x<?php echo $cart_item['quantity']; ?></p>
					<p class="price"><?php echo WC()->cart->get_product_price( $_product ); ?></p>
				</div>
			</div>
		</div>
		<?php
	}

	$side_cart_html = ob_get_clean(); // Get the buffered content into a variable
	$object_to_send = [ 'success' => true, 'html' => $side_cart_html, 'totalPrice' => $subtotal ];
	wp_send_json_success( $object_to_send ); // Send this content back as a JSON response
	wp_die(); // End the request here
}

function remove_item_from_cart() {
	$product_id = isset( $_POST['product_id'] ) ? sanitize_text_field( $_POST['product_id'] ) : 0;

	if ( ! empty( $product_id ) ) {
		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			if ( $cart_item['product_id'] == $product_id ) {
				WC()->cart->remove_cart_item( $cart_item_key );
				break;
			}
		}
		$subtotal = WC()->cart->get_subtotal();
		ob_start(); // Start output buffering

		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product          = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id        = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
			$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
			$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
			$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );

			// Echo out the structure for each product
			?>
			<div class="product">
				<?php echo $thumbnail; ?>
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
								echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), truncateString( $_product->get_name(), 15 ) ), $cart_item, $cart_item_key ) );
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
			<?php
		}

		$side_cart_html = ob_get_clean(); // Get the buffered content into a variable
		$result         = [ 'success' => true, 'html' => $side_cart_html, 'totalPrice' => $subtotal ]; // get_side_cart_contents_html() should generate the updated sidecart HTML
	} else {
		$result = [ 'success' => false ];
	}

	wp_send_json_success( $result );
	wp_die();
}

function truncateString( $string, $maxLength ) {
	return mb_strimwidth( $string, 0, $maxLength, "..." );
}

function handle_delivery_charge() {
	if ( isset( $_POST['city_price'] ) ) {
		$delivery_price = intval( $_POST['city_price'] );
		WC()->session->set( 'custom_delivery_charge', $delivery_price );

		echo $delivery_price;
	}
	wp_die();
}

function add_custom_delivery_charge( $cart ) {
	if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
		return;
	}

	$delivery_charge = WC()->session->get( 'custom_delivery_charge' );
	// if ($delivery_charge > 0) {
	$cart->add_fee( __( 'Delivery', 'woocommerce' ), $delivery_charge );
	// }
}

function remove_delivery_charge() {
	WC()->session->set( 'custom_delivery_charge', 0 );
	wp_die(); // Properly close the AJAX call
}

function search_faqs() {
	$search_term = $_POST['search_term'];

	$args = array(
		'post_type'              => 'faqs',
		's'                      => $search_term,
		'posts_per_page'         => - 1, // Retrieve all matching FAQs
		'orderby'                => 'title', // Order by title
		'order'                  => 'ASC',
		'search_post_title_only' => true,
	);

	$query = new WP_Query( $args );

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			// Output HTML for each FAQ item
			?>
			<div class="faq item">
				<p class="title">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
						<path d="M18 12.998H13V17.998C13 18.2633 12.8946 18.5176 12.7071 18.7052C12.5196 18.8927 12.2652 18.998 12 18.998C11.7348 18.998 11.4804 18.8927 11.2929 18.7052C11.1054 18.5176 11 18.2633 11 17.998V12.998H6C5.73478 12.998 5.48043 12.8927 5.29289 12.7052C5.10536 12.5176 5 12.2633 5 11.998C5 11.7328 5.10536 11.4785 5.29289 11.2909C5.48043 11.1034 5.73478 10.998 6 10.998H11V5.99805C11 5.73283 11.1054 5.47848 11.2929 5.29094C11.4804 5.1034 11.7348 4.99805 12 4.99805C12.2652 4.99805 12.5196 5.1034 12.7071 5.29094C12.8946 5.47848 13 5.73283 13 5.99805V10.998H18C18.2652 10.998 18.5196 11.1034 18.7071 11.2909C18.8946 11.4785 19 11.7328 19 11.998C19 12.2633 18.8946 12.5176 18.7071 12.7052C18.5196 12.8927 18.2652 12.998 18 12.998Z" fill="#C2996F"/>
					</svg>
					<?php the_title(); ?>
				</p>
				<p class="content"><?php the_field( 'content', get_the_ID() ); ?></p>
			</div>
			<?php
		}
	} else {
		pll_e( "No FAQs found." );
	}

	wp_reset_postdata();

	die();
}

function add_class_to_body( $classes ) {
	if ( get_locale() == 'he_IL' ) {
		$classes[] = 'lang-he';
	}

	return $classes;
}

function woocommerce_get_cart() {
	// Check the nonce
	if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'wp_rest' ) ) {
		wp_send_json_error( array( 'message' => 'Invalid nonce' ) );
	}

	$cart = WC()->cart;

	$cart_items = array();

	foreach ( $cart->get_cart() as $cart_item ) {
		$product              = wc_get_product( $cart_item['product_id'] );
		$price_per_item       = wc_price( $product->get_price() );
		$total_price_for_item = wc_price( $cart_item['quantity'] * $product->get_price() );
		$cart_items[]         = array(
			'name'                 => $product->get_name(),
			'quantity'             => $cart_item['quantity'],
			'price_per_item'       => $price_per_item,
			'total_price_for_item' => $total_price_for_item,
			'line_total'           => wc_price( $cart_item['line_total'] ),
		);
	}

	$subtotal = $cart->get_cart_subtotal();
	$total    = $cart->get_cart_total();

	wp_send_json_success( array( 'items' => $cart_items, 'subtotal' => $subtotal, 'total' => $total ) );
}

function add_tooltip_to_menu_items( $item_output, $item, $depth, $args ) {
	return '<a href="' . esc_attr( $item->url ) . '" title="' . esc_attr( $item->title ) . '">' . esc_html( $item->title ) . '</a>';
}

