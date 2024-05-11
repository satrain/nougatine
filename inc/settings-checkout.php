<?php

class WooCommerceCustomCheckout {
	public function __construct() {
		add_action( 'woocommerce_custom_payment_output', 'woocommerce_checkout_payment', 20 );
		add_action( 'woocommerce_checkout_order_review', array( $this, 'remove_woocommerce_checkout_payment' ), 1 );
		add_action( 'wp_footer', array( $this, 'delivery_city_checkout' ) );

		add_action( 'delivery_checkout_fields', array( $this, 'delivery_checkout_fields' ) );
		add_action( 'woocommerce_checkout_update_order_meta', array( $this, 'delivery_fields_update_order_meta' ) );
		add_action( 'woocommerce_checkout_process', array( $this, 'delivery_fields_process' ) );
		add_action( 'woocommerce_admin_order_data_after_billing_address', array( $this, 'display_delivery_fields_in_admin_order' ) );

		add_action( 'wp_ajax_update_delivery_city', array( $this, 'update_delivery_city' ) );
		add_action( 'wp_ajax_nopriv_update_delivery_city', array( $this, 'update_delivery_city' ) );
		add_action( 'wp_ajax_remove_item_from_cart_nm', array( $this, 'remove_item_from_cart_nm' ) );
		add_action( 'wp_ajax_nopriv_remove_item_from_cart_nm', array( $this, 'remove_item_from_cart_nm' ) );


		add_filter( 'woocommerce_checkout_fields', array( $this, 'remove_order_notes' ) );
		add_filter( 'woocommerce_shipping_packages', array( $this, 'modifyShippingPackages' ) );
		add_filter( 'woocommerce_checkout_cart_item_quantity', array( $this, 'add_delete_link_to_checkout_item' ), 10, 3 );
		add_filter( 'woocommerce_cart_item_name', array( $this, 'add_image_to_checkout_item' ), 10, 3 );
	}

	public function add_delete_link_to_checkout_item( $quantity_html, $cart_item, $cart_item_key ) {
		$product = $cart_item['data'];
		if ( $product ) {
			$quantity_html .= '<a href="#" class="remove" data-product_id="' . $product->get_id() . '" data-cart_item_key="' . $cart_item_key . '">
  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M14.0003 17.9992C14.2655 17.9992 14.5199 17.8938 14.7074 17.7063C14.8949 17.5187 15.0003 17.2644 15.0003 16.9992V14.9992C15.0003 14.734 14.8949 14.4796 14.7074 14.2921C14.5199 14.1045 14.2655 13.9992 14.0003 13.9992C13.7351 13.9992 13.4807 14.1045 13.2932 14.2921C13.1056 14.4796 13.0003 14.734 13.0003 14.9992V16.9992C13.0003 17.2644 13.1056 17.5187 13.2932 17.7063C13.4807 17.8938 13.7351 17.9992 14.0003 17.9992ZM10.0003 17.9992C10.2655 17.9992 10.5199 17.8938 10.7074 17.7063C10.8949 17.5187 11.0003 17.2644 11.0003 16.9992V14.9992C11.0003 14.734 10.8949 14.4796 10.7074 14.2921C10.5199 14.1045 10.2655 13.9992 10.0003 13.9992C9.73506 13.9992 9.48071 14.1045 9.29317 14.2921C9.10564 14.4796 9.00028 14.734 9.00028 14.9992V16.9992C9.00028 17.2644 9.10564 17.5187 9.29317 17.7063C9.48071 17.8938 9.73506 17.9992 10.0003 17.9992ZM19.0003 5.99917H17.6203L15.8903 2.54917C15.8374 2.42223 15.7589 2.30755 15.6598 2.2123C15.5606 2.11705 15.4428 2.04329 15.3138 1.99561C15.1848 1.94794 15.0474 1.92738 14.9101 1.93522C14.7728 1.94306 14.6386 1.97913 14.5159 2.04118C14.3932 2.10323 14.2846 2.18992 14.1969 2.29584C14.1092 2.40176 14.0443 2.52463 14.0062 2.65677C13.9681 2.78891 13.9577 2.92748 13.9756 3.06382C13.9935 3.20016 14.0394 3.33135 14.1103 3.44917L15.3803 5.99917H8.62028L9.89028 3.44917C9.98735 3.21608 9.99264 2.9549 9.9051 2.71806C9.81756 2.48122 9.64367 2.28627 9.41834 2.17234C9.19301 2.05841 8.93292 2.03393 8.6903 2.10383C8.44767 2.17373 8.24046 2.33282 8.11028 2.54917L6.38028 5.99917H5.00028C4.29347 6.00992 3.61316 6.26992 3.07933 6.7333C2.5455 7.19669 2.19245 7.8337 2.08245 8.53198C1.97245 9.23026 2.11256 9.94496 2.47807 10.55C2.84358 11.1551 3.41101 11.6116 4.08028 11.8392L4.82028 19.2992C4.8949 20.0417 5.24363 20.7298 5.79835 21.2291C6.35308 21.7283 7.07398 22.0029 7.82028 21.9992H16.2003C16.9466 22.0029 17.6675 21.7283 18.2222 21.2291C18.7769 20.7298 19.1257 20.0417 19.2003 19.2992L19.9403 11.8392C20.611 11.611 21.1793 11.1527 21.5446 10.5457C21.9098 9.93857 22.0484 9.2218 21.9359 8.52232C21.8233 7.82283 21.4667 7.18576 20.9294 6.72395C20.3921 6.26214 19.7087 6.00538 19.0003 5.99917ZM17.1903 19.0992C17.1654 19.3467 17.0492 19.5761 16.8643 19.7425C16.6793 19.9089 16.439 20.0004 16.1903 19.9992H7.81028C7.56151 20.0004 7.32121 19.9089 7.1363 19.7425C6.9514 19.5761 6.83515 19.3467 6.81028 19.0992L6.10028 11.9992H17.9003L17.1903 19.0992ZM19.0003 9.99917H5.00028C4.73506 9.99917 4.48071 9.89382 4.29317 9.70628C4.10564 9.51874 4.00028 9.26439 4.00028 8.99917C4.00028 8.73396 4.10564 8.4796 4.29317 8.29207C4.48071 8.10453 4.73506 7.99917 5.00028 7.99917H19.0003C19.2655 7.99917 19.5199 8.10453 19.7074 8.29207C19.8949 8.4796 20.0003 8.73396 20.0003 8.99917C20.0003 9.26439 19.8949 9.51874 19.7074 9.70628C19.5199 9.89382 19.2655 9.99917 19.0003 9.99917Z" fill="white"/>
                                                </svg>
</a>';
		}

		return $quantity_html;
	}

	public function add_image_to_checkout_item( $product_name, $cart_item, $cart_item_key ) {
		if(is_checkout()){
			$product = $cart_item['data'];
			if ( $product ) {
				$product_name = '<img src="' . wp_get_attachment_image_url( $product->get_image_id(), 'thumbnail' ) . '" alt="' . $product->get_name() . '">' . $product_name;
			}
		}
		return $product_name;
	}

	public function remove_item_from_cart_nm() {
		$cart_item_key = $_POST['cart_item_key'];
		WC()->cart->remove_cart_item( $cart_item_key );
		wp_send_json_success();
	}

	public function remove_woocommerce_checkout_payment() {
		remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
	}

	public function remove_order_notes( $fields ) {
		unset( $fields['order']['order_comments'] );

		return $fields;
	}

	public function delivery_city_checkout() {
		if ( is_checkout() ) {
			?>
			<script type="text/javascript">
				jQuery(function ($) {
					$('#pickup_fields').hide();
					$('#shipping_fields').hide();

					$('input[name=choose_delivery]').change(function () {
						if (this.value === 'pickup') {
							$('#pickup_fields').show();
							$('#shipping_fields').hide();
						} else if (this.value === 'shipping') {
							$('#pickup_fields').hide();
							$('#shipping_fields').show();
						}
					});

					$('body').on('change', 'select[name=delivery_city]', function () {
						$.ajax({
							type: 'POST',
							url: wc_checkout_params.ajax_url,
							data: {
								action: 'update_delivery_city',
								update_delivery_city: $(this).val(),
							},
							success: function (response) {
								$('body').trigger('update_checkout');
							}
						});
					});
				});
			</script>
			<?php
		}
	}

	public function delivery_checkout_fields( $checkout ) {
		echo '<div id="choose_delivery">';

		woocommerce_form_field( 'choose_delivery', array(
			'type'     => 'radio',
			'class'    => array( 'form-row-wide' ),
			'options'  => array(
				'shipping' => pll__( 'Delivery' ),
				'pickup'   => pll__( 'Collect In Store' ),
			),
			'required' => true,
		), $checkout->get_value( 'choose_delivery' ) );

		echo '<div id="pickup_fields">';

		woocommerce_form_field( 'pickup_time', array(
			'type'     => 'time',
			'class'    => array( 'form-row-wide', 'pickup-field' ),
			'label'    => pll__( 'Pickup Time' ),
			'required' => true,
		), $checkout->get_value( 'pickup_time' ) );

		woocommerce_form_field( 'pickup_date', array(
			'type'     => 'date',
			'class'    => array( 'form-row-wide', 'pickup-field' ),
			'label'    => pll__( 'Pickup Date' ),
			'required' => true,
		), $checkout->get_value( 'pickup_date' ) );

		echo '</div>';

		echo '<div id="shipping_fields">';

		woocommerce_form_field( 'delivery_city', array(
			'type'     => 'select',
			'class'    => array( 'form-row-wide', 'shipping-field' ),
			'label'    => pll__( 'City' ),
			'options'  => array(
				'250' => pll__( "Ornit, Elkana, Bat Yam, Holon" ),
				'170' => pll__( "Haifa and the surrounding area" ),
				'140' => pll__( "Airport City, Beer Ya'akov" ),
				'100' => pll__( "Bnei Brak, Givatayim, Savion" ),
			),
			'required' => true,
		), $checkout->get_value( 'delivery_city' ) );

		echo '<div class="half">';

		woocommerce_form_field( 'shipping_date', array(
			'type'     => 'text',
			'class'    => array( 'form-row-wide', 'shipping-field' ),
			'label'    => pll__( 'Delivery Date' ),
			'required' => true,
		), $checkout->get_value( 'shipping_date' ) );

		woocommerce_form_field( 'shipping_time', array(
			'type'     => 'text',
			'class'    => array( 'form-row-wide', 'shipping-field' ),
			'label'    => pll__( 'Delivery Time' ),
			'required' => true,
		), $checkout->get_value( 'shipping_time' ) );


		echo '</div></div></div>';
	}

	public function delivery_fields_update_order_meta( $order_id ) {
		if ( ! empty( $_POST['choose_delivery'] ) ) {
			update_post_meta( $order_id, 'Choose Delivery', sanitize_text_field( $_POST['choose_delivery'] ) );
		}

		if ( $_POST['choose_delivery'] == 'pickup' ) {
			if ( ! empty( $_POST['pickup_time'] ) ) {
				update_post_meta( $order_id, 'Pickup Time', sanitize_text_field( $_POST['pickup_time'] ) );
			}

			if ( ! empty( $_POST['pickup_date'] ) ) {
				update_post_meta( $order_id, 'Pickup Date', sanitize_text_field( $_POST['pickup_date'] ) );
			}
		}

		if ( $_POST['choose_delivery'] == 'shipping' ) {
			if ( ! empty( $_POST['delivery_city'] ) ) {
				update_post_meta( $order_id, 'Delivery City', sanitize_text_field( $_POST['delivery_city'] ) );
			}

			if ( ! empty( $_POST['shipping_time'] ) ) {
				update_post_meta( $order_id, 'Shipping Time', sanitize_text_field( $_POST['shipping_time'] ) );
			}

			if ( ! empty( $_POST['shipping_date'] ) ) {
				update_post_meta( $order_id, 'Shipping Date', sanitize_text_field( $_POST['shipping_date'] ) );
			}
		}
	}

	public function delivery_fields_process() {
		if ( ! $_POST['choose_delivery'] ) {
			wc_add_notice( __( 'Please select delivery method.' ), 'error' );
		}

		if ( $_POST['choose_delivery'] == 'pickup' ) {
			if ( ! $_POST['pickup_time'] || ! $_POST['pickup_date'] ) {
				wc_add_notice( __( 'Please fill in both pickup time and date.' ), 'error' );
			}
		}

		if ( $_POST['choose_delivery'] == 'shipping' ) {
			if ( ! $_POST['delivery_city'] || ! $_POST['shipping_time'] || ! $_POST['shipping_date'] ) {
				wc_add_notice( __( 'Please fill in all shipping fields.' ), 'error' );
			}
		}
	}

	public function display_delivery_fields_in_admin_order( $order ) {
		$delivery_method = get_post_meta( $order->get_id(), 'Choose Delivery', true );
		$pickup_time     = get_post_meta( $order->get_id(), 'Pickup Time', true );
		$pickup_date     = get_post_meta( $order->get_id(), 'Pickup Date', true );
		$shipping_city   = get_post_meta( $order->get_id(), 'Delivery City', true );
		$shipping_time   = get_post_meta( $order->get_id(), 'Shipping Time', true );
		$shipping_date   = get_post_meta( $order->get_id(), 'Shipping Date', true );

		echo '<p><strong>Delivery method:</strong> ' . $delivery_method . '</p>';

		if ( $delivery_method == 'pickup' ) {
			echo '<p><strong>Pickup Time:</strong> ' . $pickup_time . '</p>';
			echo '<p><strong>Pickup Date:</strong> ' . $pickup_date . '</p>';
		}

		if ( $delivery_method == 'shipping' ) {
			echo '<p><strong>Shipping City:</strong> ' . $shipping_city . '</p>';
			echo '<p><strong>Shipping Time:</strong> ' . $shipping_time . '</p>';
			echo '<p><strong>Shipping Date:</strong> ' . $shipping_date . '</p>';
		}
	}

	public function update_delivery_city() {
		$update_delivery_city = $_POST['update_delivery_city'];
		WC()->session->set( 'update_delivery_city', $update_delivery_city );
		wp_die();
	}

	public function modifyShippingPackages( $packages ) {
		$update_delivery_city = WC()->session->get( 'update_delivery_city' );

		if ( $update_delivery_city == 100 ) {
			$newRates = array_filter( $packages[0]['rates'], function ( $shippingRate ) {
				return $shippingRate->id === 'flat_rate:5';
			} );

			$packages[0]['rates'] = $newRates;
			$session              = WC()->session;
			$session->set( 'shipping_method_counts', [ count( $newRates ) ] );
			$session->set( 'chosen_shipping_methods', [ $newRates[0]->id ] );
		}

		if ( $update_delivery_city == 140 ) {
			$newRates = array_filter( $packages[0]['rates'], function ( $shippingRate ) {
				return $shippingRate->id === 'flat_rate:6';
			} );

			$packages[0]['rates'] = $newRates;

			$session = WC()->session;
			$session->set( 'shipping_method_counts', [ count( $newRates ) ] );
			$session->set( 'chosen_shipping_methods', [ $newRates[0]->id ] );
		}

		if ( $update_delivery_city == 170 ) {
			$newRates = array_filter( $packages[0]['rates'], function ( $shippingRate ) {
				return $shippingRate->id === 'flat_rate:7';
			} );

			$packages[0]['rates'] = $newRates;

			$session = WC()->session;
			$session->set( 'shipping_method_counts', [ count( $newRates ) ] );
			$session->set( 'chosen_shipping_methods', [ $newRates[0]->id ] );
		}

		if ( $update_delivery_city == 250 ) {
			$newRates = array_filter( $packages[0]['rates'], function ( $shippingRate ) {
				return $shippingRate->id === 'flat_rate:8';
			} );

			$packages[0]['rates'] = $newRates;

			$session = WC()->session;
			$session->set( 'shipping_method_counts', [ count( $newRates ) ] );
			$session->set( 'chosen_shipping_methods', [ $newRates[0]->id ] );
		}

		return $packages;
	}
}

// Instantiate the class
$woocommerceCustomCheckout = new WooCommerceCustomCheckout();
?>
