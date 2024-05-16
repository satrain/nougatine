jQuery(document).ready(function($) {

    // check if the side cart is empty on initial load -> if it is NOT empty then hide .empty-cart wrapper
    var cartEmpty = isCartEmpty();
    if(cartEmpty) {
        $('.empty-cart').addClass('active');
        $('.payment a').each(function() {
            $(this).addClass('disabled');
            $(this).on('click', function(e) {
                e.preventDefault();
            })
        });
    }
    else {
        $('.empty-cart').removeClass('active');
        $('.payment a').each(function() {
            $(this).removeClass('disabled');
        });
    }

    // set initial products count for the sidecart
    setSidecartProductCount();
    
    $('.custom-add-to-cart').on('click', function(e) {
        e.preventDefault();
        
        // Find the closest .product parent to ensure we're getting the correct data
        var $productBlock = $(this).closest('.product-card');
        var product_id = $productBlock.data('product-id');
        var variation_id = $productBlock.find('.product-variation .option input[name="option"]:checked').val() || ''; // Empty for simple products
        // var quantity = $productBlock.find('.quantity').val();
        var quantity = 1;

        // check if the sidecart is empty
        var wasCartEmpty = isCartEmpty();

        var data = {
            action: 'custom_ajax_add_to_cart',
            product_id: product_id,
            quantity: quantity
        };

        // Only add variation_id to the data object if it's not empty
        if (variation_id) {
            data.variation_id = variation_id;
        }

        $.ajax({
            type: 'post',
            url: ajax_object.ajax_url,
            data: data,
            success: function(response) {
                var data = JSON.parse(response);
                if(data.success) {
                    // Make another AJAX call here to update the side cart
                    $.ajax({
                        url: ajax_object.ajax_url,
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            action: 'get_side_cart_products_html'
                        },
                        success: function(response) {
                            console.log(response)
                            // var html_data = JSON.parse(response);
                            if(response.success) {
                                $('.sidecart-products .container').html(response.data.html); // Inject new HTML
                                $('.payment .subtotal .price').html("₪" + response.data.totalPrice + ".00");
                                var itemsCount = $('.sidecart-products .container .product').length;
                                $('.sidecart-title .quantity').html('(' + itemsCount + ')')
                                setSidecartProductCount();
                            }

                            // if the sidecart is empty - when adding the first product open the sidecart
                            if(wasCartEmpty) {
                                $('.empty-cart').removeClass('active');
                                $('.nougatine-sidecart').addClass('active');
                            }

                            // remove disabled buttons since in this ajax response we definitely have at least 1 product
                            $('.payment a').each(function() {
                                $(this).removeClass('disabled');
                                $(this).off('click', function(e) {
                                    e.preventDefault();
                                })
                            });
                        }
                    });
                } else {
                    alert(data.message); // Process failure
                }
            }
        });
    });

    $('.sidecart-products .container').on('click', '.delete-item.product-remove', function(e) {
        e.preventDefault();
        console.log('clicked')
    
        var product_id = $(this).data('product-id'); // Make sure each button has a 'data-product-id' attribute
    
        $.ajax({
            url: ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'remove_item_from_cart',
                product_id: product_id
            },
            success: function(response) {
                if (response.success) {
                    // Update the sidecart to reflect the item removal
                    $('.sidecart-products .container').html(response.data.html); // Assuming the new HTML of the sidecart is returned
                    $('.payment .subtotal .price').html("₪" + response.data.totalPrice + ".00");
                    var itemsCount = $('.sidecart-products .container .product').length;
                    $('.sidecart-title .quantity').html('(' + itemsCount + ')')
                    setSidecartProductCount(); // update minicart counter
                    if(isCartEmpty()) {
                        $('.empty-cart').addClass('active');
                    }
                } else {
                    alert('Failed to remove item');
                }
            },
            error: function() {
                alert('Error removing item');
            }
        });
    });
    

    // check if the cart is empty
    function isCartEmpty() {
        let empty = true;
        let sidecartProducts = document.querySelector('.sidecart-products .container .product')
        if(sidecartProducts) {
            empty = false;
        }

        return empty;
    }

    // count products to set the product counter
    function setSidecartProductCount() {
        let sideCartCounter = document.querySelectorAll('.products-counter')
        let sidecartProductsCount = document.querySelectorAll('.sidecart-products .product')
        sideCartCounter.forEach(counter => {
            counter.querySelector('p').innerHTML = sidecartProductsCount.length
        })
    }

});