jQuery(function($) {
	$('.custom-add-to-cart').click(function(event) {

		event.preventDefault();

		const data = {
			product_id: event.target.dataset.product_id,
			quantity: 1,
		}

		$.ajax({
			type: 'POST',
			url: wc_add_to_cart_params.wc_ajax_url.toString().replace('%%endpoint%%', 'add_to_cart'),
			data: data,
			dataType: 'json',
			beforeSend: function(xhr) {
				// you can set the button loading state here
			},
			complete: function(res) {
				// you can remove the button loading state here
			},
			success: function(res) {
				$(document.body).trigger('added_to_cart', [res.fragments, res.cart_hash]);
			},
		});
	});

	// Listen to the 'added_to_cart' event
	$(document.body).on('added_to_cart', function(event, fragments, cart_hash) {
		$('.mini-cart').html(fragments['div.widget_shopping_cart_content']);
	});
});
