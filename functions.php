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
require_once 'inc/settings_checkout_timers.php';
require_once 'inc/settings-checkout.php';


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

}

add_action( 'after_setup_theme', 'alokin_add_theme_support' );

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

add_action( 'widgets_init', 'alokin_widgets_init' );

/**
 * Remove Feeds
 */
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );
function remove_wp_block_library_css() {
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'wc-blocks-style' );
}

add_action( 'wp_enqueue_scripts', 'remove_wp_block_library_css', 100 );
remove_action( 'wp_enqueue_scripts', 'wp_enqueue_classic_theme_styles' );

function alokin_enqueue_assets() {
	wp_register_style( 'swiper_style', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css' );
	wp_enqueue_style( 'swiper_style' );

	wp_register_style( 'slick_theme_style', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css' );
	wp_enqueue_style( 'slick_theme_style' );
	wp_register_style( 'slick_style', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css' );
	wp_enqueue_style( 'slick_style' );

	wp_enqueue_style( 'lightbox-style', 'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css' );

	wp_register_style( 'aos_style', 'https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css' );
	wp_enqueue_style( 'aos_style' );

	wp_register_style( 'main_style', get_template_directory_uri() . '/assets/css/theme.min.css', array(), _S_VERSION, 'all' );
	wp_enqueue_style( 'main_style' );

	wp_register_script( 'swiper_script', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js' );
	wp_enqueue_script( 'swiper_script' );

	wp_register_script( 'slick_script', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js' );
	wp_enqueue_script( 'slick_script' );

	wp_register_script( 'aos_script', 'https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js' );
	wp_enqueue_script( 'aos_script' );

	wp_enqueue_script( 'lightbox-script', 'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js', array( 'jquery' ), '', true );

	wp_enqueue_script( 'main-script', get_template_directory_uri() . '/assets/js/script.min.js', array( 'jquery' ), _S_VERSION, true );
	wp_localize_script( 'main-script', 'ajax_object', array(
		'ajax_url' => admin_url( 'admin-ajax.php' ),
	) );


	$disabled_dates     = get_option( 'disabled_dates', '' );
	$disabled_dates     = array_map( 'trim', explode( ',', $disabled_dates ) );
	$disabledStartTimes = get_option( 'start_times' );
	$disabledEndTimes   = get_option( 'end_times' );


	wp_enqueue_style( 'pikaday', 'https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css', array(), null );
	wp_enqueue_script( 'pikaday', 'https://cdn.jsdelivr.net/npm/pikaday/pikaday.js', array( 'moment' ), null, true );
	wp_enqueue_script( 'jquery-timepicker', 'https://cdn.jsdelivr.net/npm/timepicker@1.14.1/jquery.timepicker.min.js', array( 'jquery' ), '1.14.1', true );
	wp_enqueue_style( 'jquery-timepicker', 'https://cdn.jsdelivr.net/npm/timepicker@1.14.1/jquery.timepicker.min.css', array(), '1.14.1' );

	wp_localize_script( 'main-script', 'pickersTime', array(
		'disabledStartTimes' => $disabledStartTimes,
		'disabledEndTimes'   => $disabledEndTimes,
	) );

	wp_localize_script( 'pikaday', 'pickersDate', array(
		'disabledDates' => $disabled_dates,
	) );

	add_filter( 'script_loader_tag', function ( $tag, $handle ) {
		if ( 'pikaday' !== $handle ) {
			return $tag;
		}

		return str_replace( ' src', ' defer src', $tag );
	}, 10, 2 );
}

add_action( 'wp_enqueue_scripts', 'alokin_enqueue_assets' );

function add_active_class_to_menu_item( $classes, $item ) {
	if ( in_array( 'current-menu-item', $classes ) ) {
		$classes[] = 'active';
	}

	return $classes;
}

add_filter( 'nav_menu_css_class', 'add_active_class_to_menu_item', 10, 2 );


add_filter( 'woocommerce_cart_item_quantity', 'custom_cart_item_quantity_html', 10, 3 );
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

add_action( 'wp_ajax_update_cart_item_quantity', 'update_cart_item_quantity' );
add_action( 'wp_ajax_nopriv_update_cart_item_quantity', 'update_cart_item_quantity' );

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

add_action( 'wp_ajax_modal_load_product_data', 'modal_load_product_data' );
add_action( 'wp_ajax_nopriv_modal_load_product_data', 'modal_load_product_data' );
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

add_action( 'wp_ajax_custom_ajax_add_to_cart', 'custom_ajax_add_to_cart' );
add_action( 'wp_ajax_nopriv_custom_ajax_add_to_cart', 'custom_ajax_add_to_cart' );

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
                <span class="delete-item product-remove">
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
	wp_send_json_success( $side_cart_html ); // Send this content back as a JSON response
	wp_die(); // End the request here
}

add_action( 'wp_ajax_get_side_cart_products_html', 'get_side_cart_products_html' );
add_action( 'wp_ajax_nopriv_get_side_cart_products_html', 'get_side_cart_products_html' );

function remove_item_from_cart() {
	$product_id = isset( $_POST['product_id'] ) ? sanitize_text_field( $_POST['product_id'] ) : 0;

	if ( ! empty( $product_id ) ) {
		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			if ( $cart_item['product_id'] == $product_id ) {
				WC()->cart->remove_cart_item( $cart_item_key );
				break;
			}
		}
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
                    <span class="delete-item product-remove">
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
		$result         = [ 'success' => true, 'html' => $side_cart_html ]; // get_side_cart_contents_html() should generate the updated sidecart HTML
	} else {
		$result = [ 'success' => false ];
	}

	wp_send_json( $result );
	wp_die();
}

add_action( 'wp_ajax_remove_item_from_cart', 'remove_item_from_cart' );
add_action( 'wp_ajax_nopriv_remove_item_from_cart', 'remove_item_from_cart' );

function handle_delivery_charge() {
	if ( isset( $_POST['city_price'] ) ) {
		$delivery_price = intval( $_POST['city_price'] );
		WC()->session->set( 'custom_delivery_charge', $delivery_price );

		echo $delivery_price;
	}
	wp_die();
}

add_action( 'wp_ajax_handle_delivery_charge', 'handle_delivery_charge' );
add_action( 'wp_ajax_nopriv_handle_delivery_charge', 'handle_delivery_charge' );

function add_custom_delivery_charge( $cart ) {
	if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
		return;
	}

	$delivery_charge = WC()->session->get( 'custom_delivery_charge' );
	// if ($delivery_charge > 0) {
	$cart->add_fee( __( 'Delivery', 'woocommerce' ), $delivery_charge );
	// }
}

add_action( 'woocommerce_cart_calculate_fees', 'add_custom_delivery_charge', 20 );

function remove_delivery_charge() {
	WC()->session->set( 'custom_delivery_charge', 0 );
	wp_die(); // Properly close the AJAX call
}

add_action( 'wp_ajax_remove_delivery_charge', 'remove_delivery_charge' );
add_action( 'wp_ajax_nopriv_remove_delivery_charge', 'remove_delivery_charge' );

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

add_action( 'wp_ajax_search_faqs', 'search_faqs' );
add_action( 'wp_ajax_nopriv_search_faqs', 'search_faqs' ); // Allow non-logged in users to use the function

function add_class_to_body( $classes ) {
	if ( get_locale() == 'he_IL' ) {
		$classes[] = 'lang-he';
	}

	return $classes;
}

add_filter( 'body_class', 'add_class_to_body' );
