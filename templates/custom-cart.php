<?php
/* Template Name: Custom Cart */
get_header();
global $woocommerce;
?>

<?php
$items = $woocommerce->cart->get_cart();

if (!empty($items)) {
    echo '<div class="cart-products">';
    foreach ($items as $item => $values) {
        $_product = $values['data']->post;
        echo '<p>' . $_product->post_title . '</p>';
    }
    echo '</div>';
} else {
    echo '<p>Your cart is empty.</p>';
}
?>

<?php get_footer('basic') ?>