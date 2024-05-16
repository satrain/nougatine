<?php

/**
 * Class NM_Settings_Checkout_Timers
 *
 * Configure the tools submenu page.
 */
class NM_Settings_Checkout_Timers {

	/**
	 * Capability required by the user to access the Checkout Timers menu entry.
	 *
	 * @var string $capability
	 */
	private $capability = 'manage_options';

	/**
	 * Array of fields that should be displayed in the settings page.
	 *
	 * @var array $fields
	 */
	private $fields = [
		[
			'id'          => 'disabled_dates',
			'label'       => 'Disable Date',
			'description' => '',
			'type'        => 'text',
			'callback'    => 'disabled_dates_field_callback',
		],
		[
			'id'          => 'timeslots_start_time',
			'label'       => 'Start Time (24-hour format):',
			'description' => '',
			'type'        => 'text',
			'callback'    => 'timeslots_start_time_field_callback',
		],
		[
			'id'          => 'timeslots_end_time',
			'label'       => 'End Time (24-hour format):',
			'description' => '',
			'type'        => 'text',
			'callback'    => 'timeslots_end_time_field_callback',
		],
		[
			'id'          => 'timeslots_interval',
			'label'       => 'Interval (in minutes)',
			'description' => '',
			'type'        => 'text',
			'callback'    => 'timeslots_interval_field_callback',
		],
	];

	/**
	 * Tools constructor.
	 */
	function __construct() {
		add_action( 'admin_init', [ $this, 'settings_init' ] );
		add_action( 'admin_menu', [ $this, 'options_page' ] );
		add_action( 'admin_footer', [ $this, 'enqueue_datepicker_script' ] );
	}

	/**
	 * Register the settings and all fields.
	 */
	function settings_init(): void {

		register_setting( 'checkout-timers', 'disabled_dates', 'sanitize_text_field' );
		register_setting( 'checkout-timers', 'timeslots_start_time' );
		register_setting( 'checkout-timers', 'timeslots_end_time' );
		register_setting( 'checkout-timers', 'timeslots_interval' );

		add_settings_section(
			'checkout-timers-section',
			__( '', 'checkout-timers' ),
			[ $this, 'render_section' ],
			'checkout-timers'
		);


		/* Register All The Fields. */
		foreach ( $this->fields as $field ) {
			// Register a new field in the main section.
			add_settings_field(
				$field['id'],
				__( $field['label'], 'checkout-timers' ),
				[ $this, $field['callback'] ],
				'checkout-timers',
				'checkout-timers-section',
				[
					'label_for' => $field['id'],
					'class'     => 'nm_row',
					'field'     => $field,
				]
			);
		}
	}

	/**
	 * Add a subpage to the WordPress Tools menu.
	 */
	function options_page(): void {
		add_submenu_page(
			'tools.php',
			'Checkout Timers',
			'Checkout Timers',
			$this->capability,
			'checkout-timers',
			[ $this, 'render_options_page' ],
		);
	}

	/**
	 * Render the settings page.
	 */
	function render_options_page(): void {

		if ( ! current_user_can( $this->capability ) ) {
			return;
		}

		if ( isset( $_GET['settings-updated'] ) ) {
			add_settings_error( 'nm_messages', 'nm_messages', __( 'Settings Saved', 'checkout-timers' ), 'updated' );
		}

		settings_errors( 'nm_messages' );
		?>
		<div class="wrap">
			<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
			<h2 class="description"></h2>
			<form action="options.php" method="post">
				<?php
				settings_fields( 'checkout-timers' );
				do_settings_sections( 'checkout-timers' );
				submit_button( 'Save Settings' );
				?>
			</form>
		</div>
		<?php
	}

	function disabled_dates_field_callback() {
		$disabled_dates = get_option( 'disabled_dates', '' );
		echo '<input autocomplete="off" type="text" id="disabled_dates" name="disabled_dates" value="' . $disabled_dates . '" />';
	}


	function timeslots_start_time_field_callback() {
		$start_time = get_option('timeslots_start_time');
		echo '<input type="time" name="timeslots_start_time" value="' . esc_attr($start_time) . '" />';
	}

	function timeslots_end_time_field_callback() {
		$end_time = get_option('timeslots_end_time');
		echo '<input type="time" name="timeslots_end_time" value="' . esc_attr($end_time) . '" />';
	}

	function timeslots_interval_field_callback() {
		$interval = get_option('timeslots_interval');
		echo '<input type="number" name="timeslots_interval" value="' . esc_attr($interval) . '" />';
	}

	function sanitize_array( $input ) {
		return array_map( 'sanitize_text_field', $input );
	}

	/**
	 * Render a section on a page, with an ID and a text label.
	 *
	 * @param array $args {
	 *     An array of parameters for the section.
	 *
	 * @type string $id The ID of the section.
	 * }
	 * @since 1.0.0
	 *
	 */
	function render_section( array $args ): void {
		?>
		<p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( '', 'checkout-timers' ); ?></p>
		<?php
	}

	function enqueue_datepicker_script() {
		if ( get_current_screen()->base == 'tools_page_checkout-timers' ) {
			wp_enqueue_script( 'jquery-ui-datepicker' );
			wp_enqueue_style( 'jquery-ui', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css' );
			wp_enqueue_script( 'jquery-timepicker', 'https://cdn.jsdelivr.net/npm/timepicker@1.14.1/jquery.timepicker.min.js', array( 'jquery' ), '1.14.1', true );
			wp_enqueue_style( 'jquery-timepicker', 'https://cdn.jsdelivr.net/npm/timepicker@1.14.1/jquery.timepicker.min.css', array(), '1.14.1' );
			?>
			<script>
				jQuery(document).ready(function ($) {
					var dates = $('#disabled_dates').val().split(',');
					$('#disabled_dates').datepicker({
						dateFormat: 'dd.mm.yy',
						beforeShowDay: function (date) {
							var string = jQuery.datepicker.formatDate('dd.mm.yy', date);
							return [true, dates.indexOf(string) != -1 ? 'selected-date' : ''];
						},
						onSelect: function (dateText, inst) {
							var index = dates.indexOf(dateText);
							if (index == -1) {
								dates.push(dateText);
							} else {
								dates.splice(index, 1);
							}
							$('#disabled_dates').val(dates.join(','));
						}
					});

					function initTimepicker() {
						$(".timepicker").timepicker({
							"timeFormat": "H:i"
						});
					}

					initTimepicker();

					$("#add_start_time").click(function () {
						var input = $("<input type=\"text\" name=\"start_times[]\" class=\"timepicker\" />");
						$(this).before(input);
						initTimepicker();
					});

					$("#add_end_time").click(function () {
						var input = $("<input type=\"text\" name=\"end_times[]\" class=\"timepicker\" />");
						$(this).before(input);
						initTimepicker();
					});
				});
			</script>
			<style>
				.selected-date a {
					background: red !important;
					border: 1px solid red;
				}

				.timepicker, #add_start_time, #add_end_time {
					margin-top: 10px;
					display: block;
				}
			</style>
			<?php
		}
	}
}

new NM_Settings_Checkout_Timers();

