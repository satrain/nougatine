<?php

/**
 * Implements example command.
 */
class Example_Command extends WP_CLI_Command {


	/**
	 * Reads a CSV file and updates the shipping methods.
	 * ## EXAMPLES
	 *
	 *     wp example update_shipping_methods
	 *
	 * @when after_wp_load
	 */
	function update_shipping_methods( $args, $assoc_args ) {
		if (($handle = fopen("shipping.csv", "r")) !== FALSE) {
			// Get the shipping zone by its ID
			$zone_id = 668; // Replace this with your zone ID
			$zone = WC_Shipping_Zones::get_zone($zone_id);

			// Loop through each row in the CSV
			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
				// Add a flat rate shipping method to the zone
				$instance_id = $zone->add_shipping_method('flat_rate');

				// Get the instance of the shipping method
				$shipping_methods = $zone->get_shipping_methods();
				$shipping_method = $shipping_methods[$instance_id];

				// Set the cost of the shipping method
				// Set the cost of the shipping method
				$settings = array(
					'title' => $data[0], // Assuming the first column in your CSV is the title
					'cost' => $data[1], // Assuming the second column in your CSV is the cost
					'tax_status' => 'none', // Set tax status to none
				);

				update_option('woocommerce_' . $shipping_method->id . '_' . $shipping_method->instance_id . '_settings', $settings);

			}

			$zone->save();

			// Close the CSV file
			fclose($handle);
		}
	}

	public
	function delete_all_zones() {
		// Get all zones
		$zones = WC_Shipping_Zones::get_zones();

		// Loop over the zones and delete each one
		foreach ( $zones as $zone ) {
			$zone_id = $zone['zone_id'];
			$zone    = WC_Shipping_Zones::get_zone( $zone_id );
			$zone->delete();
		}

		// Delete the default zone (zone 0)
		$default_zone = new WC_Shipping_Zone( 0 );
		$default_zone->delete();
	}

	public
	function retrive() {
		// Get the zone
		$zone_id = 0; // Replace with your zone ID
		$zone    = WC_Shipping_Zones::get_zone( $zone_id );

// Get the shipping methods for this zone
		$shipping_methods = $zone->get_shipping_methods();

// Loop over the shipping methods and print their IDs and titles
		foreach ( $shipping_methods as $shipping_method ) {
			var_dump( $shipping_method );
			echo 'ID: ' . $shipping_method->id . ', Title: ' . $shipping_method->title . "\n";
		}
	}
}

WP_CLI::add_command( 'example', 'Example_Command' );

