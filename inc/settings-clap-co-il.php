<?php

class OrderDataSender {
	private $api_url;
	private $api_token;
	private $logger;

	public function __construct() {
		$this->api_url   = get_option( 'api_url' );
		$this->api_token = get_option( 'api_token' );

		add_action( 'woocommerce_thankyou', [ $this, 'send_order_data_to_api' ] );
		add_action( 'admin_menu', array( $this, 'add_api_settings_page' ) );
		add_action( 'admin_init', array( $this, 'register_api_settings' ) );

		$this->logger = new WC_Logger();
	}

	public function send_order_data_to_api( $order_id ) {
		if ( get_transient( "order_processed_$order_id" ) !== false ) {
			return;
		}

		$order = wc_get_order( $order_id );

		$delivery_method = get_post_meta( $order->get_id(), 'Choose Delivery', true );
		$pickup_time     = get_post_meta( $order->get_id(), 'Pickup Time', true );
		$pickup_date     = get_post_meta( $order->get_id(), 'Pickup Date', true );
		$shipping_time   = get_post_meta( $order->get_id(), 'Shipping Time', true );
		$shipping_date   = get_post_meta( $order->get_id(), 'Shipping Date', true );


		$delivery_date = $delivery_method == 'shipping' ? $shipping_date : $pickup_date;
		$delivery_hour = $delivery_method == 'shipping' ? $shipping_time : $pickup_time;
		$date          = DateTime::createFromFormat( 'd.m.Y', $delivery_date );

		$client_fullname = $order->get_billing_first_name() . ' ' . $order->get_billing_last_name();
		$client_phone    = $order->get_billing_phone();
		$delivery_type   = $delivery_method == 'shipping' ? 'delivery' : 'self';
		$delivery_day    = $date->format( 'Y-m-d' );;
		$delivery_time    = $delivery_hour;
		$delivery_address = $delivery_method == 'shipping' ? $order->get_shipping_address_1() : '';
		$menu_title       = 'Woocommerce Order'; // Update this as per your requirement
		$menu_products    = []; // Update this as per your requirement

		foreach ( $order->get_items() as $item_id => $item ) {
			$product       = $item->get_product();
			$product_title = $product->get_name();
			$product_price = $product->get_price();

			$menu_products[] = [
				'quantity' => $item->get_quantity(),
				'product'  => [
					'price'      => $product_price,
					'title'      => $product_title,
					'department' => [
						'key'   => 4,
						'value' => 'kitchen',
					],
				],
			];
		}

		// Prepare the data for the API
		$data = [
			'client'   => [
				'fullname' => $client_fullname,
				'phone'    => $client_phone,
			],
			'delivery' => [
				'type'      => $delivery_type,
				'day'       => $delivery_day,
				'startHour' => $delivery_time,
				'address'   => $delivery_address,
			],
			'menu'     => [
				'title'    => $menu_title,
				'products' => $menu_products,
			],
		];

		// Send the data to the API
		$response = wp_remote_post( $this->api_url, [
			'headers' => [
				'x-api-key'    => $this->api_token,
				'Content-Type' => 'application/json',
			],
			'body'    => json_encode( $data ),
		] );

		// Handle the response
		if ( is_wp_error( $response ) ) {
			$error_message = $response->get_error_message();
			$this->logger->add( 'api_error', "Order ID: $order_id, Error: $error_message, Request: " . json_encode( $data ) );
		} else {
			$this->logger->add( 'api_success', "Order ID: $order_id, Response: " . wp_remote_retrieve_body( $response ) . ", Request: " . json_encode( $data ) );
		}

		// Set a transient to mark the order as processed
		set_transient( "order_processed_$order_id", true, HOUR_IN_SECONDS );
	}

	public function add_api_settings_page() {
		add_options_page(
			'API Settings',
			'API Settings',
			'manage_options',
			'api-settings',
			array( $this, 'display_api_settings_page' )
		);
	}

	public function register_api_settings() {
		register_setting( 'api-settings-group', 'api_url' );
		register_setting( 'api-settings-group', 'api_token' );

		add_settings_section(
			'api-settings-section',
			'API Settings',
			null,
			'api-settings'
		);

		add_settings_field(
			'api_url',
			'API URL',
			array( $this, 'display_api_url_field' ),
			'api-settings',
			'api-settings-section'
		);

		add_settings_field(
			'api_token',
			'API Token',
			array( $this, 'display_api_token_field' ),
			'api-settings',
			'api-settings-section'
		);
	}

	public function display_api_settings_page() {
		?>
		<div class="wrap">
			<h1>API Settings</h1>
			<form method="post" action="options.php">
				<?php
				settings_fields( 'api-settings-group' );
				do_settings_sections( 'api-settings' );
				submit_button();
				?>
			</form>
		</div>
		<?php
	}

	public function display_api_url_field() {
		?>
		<input type="text" name="api_url" value="<?php echo esc_attr( get_option( 'api_url' ) ); ?>"/>
		<?php
	}

	public function display_api_token_field() {
		?>
		<input type="text" name="api_token" value="<?php echo esc_attr( get_option( 'api_token' ) ); ?>"/>
		<?php
	}
}

new OrderDataSender();
