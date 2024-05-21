<?php

/**
 * Enqueue and dequeue scripts and styles
 */
class EnqueueDequeue {
	/**
	 * register default hooks and actions for WordPress
	 *
	 * @return void
	 */
	public function __construct() {
//		add_action( 'wp_enqueue_scripts', [ $this, 'dequeueStylesScripts' ] );
//		add_filter( 'style_loader_tag', [ $this, 'preloadStyles' ], 10, 2 );

		if ( ! is_user_logged_in() ) {
//			add_filter( 'script_loader_tag', [ $this, 'defferScripts' ], 999, 2 );
		}

	}

	/**
	 * Dequeue styles and scripts
	 */
	public function dequeueStylesScripts() {
		$remove_styles = [
			'wp-block-library',
			'wc-blocks-vendors-style',
			'wc-blocks-style',
			'woocommerce-inline-inline' .
			'litespeed-cache',
			'admin-bar',
			'wp-emoji-styles',
			'woocommerce-inline',
			'global-styles',
			'classic-theme-styles',
		];

		if ( ! is_user_logged_in() ) {
			foreach ( $remove_styles as $style ) {
				wp_dequeue_style( $style );
				wp_deregister_style( $style );
			}
		}

		wp_deregister_script( 'wp-embed' );
		wp_deregister_script( 'wp-emoji-release' );

		if ( function_exists( 'is_woocommerce' ) && ! is_checkout() ):
			wp_dequeue_script( 'wc-cart-fragments' );
			wp_dequeue_script( 'wc-country-select' );
			wp_dequeue_script( 'wc-address-i18n' );
			wp_dequeue_script( 'wc-cart' );
			wp_dequeue_script( 'select2' );
			wp_dequeue_script( 'selectWoo' );
			wp_dequeue_script( 'comment-reply' );
			wp_dequeue_script( 'jquery-payment' );
			wp_dequeue_script( 'wc-add-payment-method' );
			wp_dequeue_script( 'wc-checkout' );
			wp_dequeue_script( 'jquery-blockui' );
			wp_dequeue_script( 'wc-order-attribution' );
			wp_dequeue_script( 'sourcebuster-js' );
		endif;

		if ( function_exists( 'is_woocommerce' ) ):
			if ( ! is_product() ):
				wp_dequeue_script( 'wc-single-product' );
				wp_dequeue_script( 'flexslider' );
				wp_dequeue_script( 'photoswipe' );
				wp_dequeue_script( 'photoswipe-ui-default' );
				wp_dequeue_script( 'prettyPhoto' );
				wp_dequeue_script( 'prettyPhoto-init' );
				wp_dequeue_script( 'zoom' );
			endif;

//			wp_dequeue_script( 'wc-add-to-cart-variation' );
//			wp_dequeue_script( 'wc-add-to-cart' );
			wp_dequeue_script( 'jquery-blockui' );
		endif;
	}

	/**
	 * @param $tag
	 * @param $handle
	 *
	 * @return array|mixed|string|string[]|null
	 */
	public function defferScripts( $tag, $handle ) {
		$deffered_script = [
			'swiper_script',
			'slick_script',
			'lightbox-script',
			'jquery-dgwt-wcas'
		];

		if ( in_array( $handle, $deffered_script, true ) ) {
			return str_replace( ' src', ' defer="defer" src', $tag );
		}

		$async_script = [
			'jquery-migrate',
		];

		if ( in_array( $handle, $async_script, true ) ) {
			return str_replace( ' src', ' async="async" src', $tag );
		}

		// Deffer all scripts
		return $tag;
	}

	/**
	 * Enqueue styles for pages
	 */
	public function preloadStyles( $html, $handle ) {
		$noncritical = [
			'slick_style',
			'slick_theme_style',
			'lightbox-style',
			'swiper_style',
		];

		if ( in_array( $handle, $noncritical ) ) {
			return str_replace( "rel='stylesheet'", "rel='preload' as='style' onload=\"this.onload=null;this.rel='stylesheet'\"", $html );
		}

		return $html;
	}
}

new EnqueueDequeue();
