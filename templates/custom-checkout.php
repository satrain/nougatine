<?php 
/* Template Name: Custom Checkout */
get_header();

if (get_locale() == 'he_IL') {
    $product_title = 'קיש פטריות, קוטר 24 ס"מ (מגיע פרוס ל-16 חתיכות)';
}
else {
    $product_title = "Mushroom quiche, diameter 24 cm (comes sliced into 16 pieces)";
}

$cart_subtotal = WC()->cart->get_cart_subtotal();
$cart_count = WC()->cart->get_cart_contents_count();
?>

<div class="custom-checkout">
    <div class="custom-checkout-title">
        <h1><?php pll_e("Checkout") ?></h1>
    </div>
    <div class="checkout-wrapper">
        <div id="checkout-steps">
            <!-- Step Indicators -->
            <div class="steps-indicator">
                <div class="indicators-line"></div>
                <div class="step active current" data-step="1">
                    <span class="step-number">1</span>
                    <p><?php pll_e("Delivery") ?></p>
                </div>
                <div class="step" data-step="2">
                    <span class="step-number">2</span>
                    <p><?php pll_e("Details") ?></p>
                </div>
                <div class="step" data-step="3">
                    <span class="step-number">3</span>
                    <p><?php pll_e("Payment") ?></p>
                </div>
            </div>
            
            <div class="content">
                <!-- Step 1: Delivery -->
                <div class="step-content step-1 active" id="step-delivery">
                    <div class="delivery-choice">
                        <div class="delivery active">
                            <svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" viewBox="0 0 52 52" fill="none">
                                <path d="M2.16699 27.0827V37.916C2.16699 38.4907 2.39527 39.0418 2.80159 39.4481C3.20792 39.8544 3.75902 40.0827 4.33366 40.0827H6.50033C6.50033 41.8066 7.18514 43.4599 8.40413 44.6789C9.62312 45.8979 11.2764 46.5827 13.0003 46.5827C14.7242 46.5827 16.3775 45.8979 17.5965 44.6789C18.8155 43.4599 19.5003 41.8066 19.5003 40.0827H32.5003C32.5003 41.8066 33.1851 43.4599 34.4041 44.6789C35.6231 45.8979 37.2764 46.5827 39.0003 46.5827C40.7242 46.5827 42.3775 45.8979 43.5965 44.6789C44.8155 43.4599 45.5003 41.8066 45.5003 40.0827H47.667C48.2416 40.0827 48.7927 39.8544 49.1991 39.4481C49.6054 39.0418 49.8337 38.4907 49.8337 37.916V11.916C49.8337 10.1921 49.1488 8.53881 47.9299 7.31982C46.7109 6.10084 45.0576 5.41602 43.3337 5.41602H23.8337C22.1098 5.41602 20.4564 6.10084 19.2375 7.31982C18.0185 8.53881 17.3337 10.1921 17.3337 11.916V16.2493H13.0003C11.9912 16.2493 10.996 16.4843 10.0934 16.9356C9.19088 17.3869 8.40578 18.0421 7.80032 18.8493L2.60033 25.7827C2.53695 25.8769 2.48598 25.9788 2.44866 26.086L2.31866 26.3243C2.22304 26.566 2.17166 26.8229 2.16699 27.0827ZM36.8337 40.0827C36.8337 39.6542 36.9607 39.2352 37.1988 38.8789C37.4369 38.5226 37.7753 38.2449 38.1712 38.0809C38.5671 37.917 39.0027 37.874 39.423 37.9576C39.8433 38.0412 40.2294 38.2476 40.5324 38.5506C40.8354 38.8536 41.0418 39.2397 41.1254 39.66C41.209 40.0803 41.166 40.5159 41.0021 40.9118C40.8381 41.3077 40.5604 41.6461 40.2041 41.8842C39.8478 42.1223 39.4288 42.2493 39.0003 42.2493C38.4257 42.2493 37.8746 42.0211 37.4683 41.6147C37.0619 41.2084 36.8337 40.6573 36.8337 40.0827ZM21.667 11.916C21.667 11.3414 21.8953 10.7903 22.3016 10.384C22.7079 9.97762 23.259 9.74935 23.8337 9.74935H43.3337C43.9083 9.74935 44.4594 9.97762 44.8657 10.384C45.272 10.7903 45.5003 11.3414 45.5003 11.916V35.7493H43.8103C43.2011 35.0791 42.4585 34.5435 41.6302 34.1771C40.8019 33.8106 39.9061 33.6213 39.0003 33.6213C38.0946 33.6213 37.1988 33.8106 36.3705 34.1771C35.5421 34.5435 34.7995 35.0791 34.1903 35.7493H21.667V11.916ZM17.3337 24.916H8.66699L11.267 21.4493C11.4688 21.1803 11.7305 20.9618 12.0314 20.8114C12.3322 20.661 12.664 20.5827 13.0003 20.5827H17.3337V24.916ZM10.8337 40.0827C10.8337 39.6542 10.9607 39.2352 11.1988 38.8789C11.4369 38.5226 11.7753 38.2449 12.1712 38.0809C12.5671 37.917 13.0027 37.874 13.423 37.9576C13.8433 38.0412 14.2294 38.2476 14.5324 38.5506C14.8354 38.8536 15.0418 39.2397 15.1254 39.66C15.209 40.0803 15.1661 40.5159 15.0021 40.9118C14.8381 41.3077 14.5604 41.6461 14.2041 41.8842C13.8478 42.1223 13.4289 42.2493 13.0003 42.2493C12.4257 42.2493 11.8746 42.0211 11.4683 41.6147C11.0619 41.2084 10.8337 40.6573 10.8337 40.0827ZM6.50033 29.2493H17.3337V35.2727C16.055 34.1299 14.3764 33.5387 12.6638 33.628C10.9512 33.7173 9.34326 34.4798 8.19032 35.7493H6.50033V29.2493Z" fill="#2C2B2E"/>
                            </svg>
                            <p><?php pll_e("Delivery") ?></p>
                        </div>
                        <div class="collect-in-store">
                            <svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" viewBox="0 0 52 52" fill="none">
                                <path d="M44.3948 16.2928C44.3825 16.2357 44.3825 16.1766 44.3948 16.1195C44.3843 16.0695 44.3843 16.0178 44.3948 15.9678V15.7728L44.2648 15.4478C44.212 15.3592 44.1463 15.2788 44.0698 15.2095L43.8748 15.0362H43.7665L35.2298 9.64117L27.1698 4.65784C26.9833 4.50992 26.7699 4.39955 26.5414 4.33284H26.3681C26.1745 4.30051 25.9768 4.30051 25.7831 4.33284H25.5664C25.3148 4.3885 25.0735 4.48356 24.8514 4.6145L8.66645 14.6895L8.47145 14.8412L8.27645 15.0145L8.05978 15.1662L7.95145 15.2962L7.82145 15.6212V15.8162V15.9462C7.8004 16.0898 7.8004 16.2358 7.82145 16.3795V35.2945C7.82071 35.6627 7.91383 36.025 8.092 36.3473C8.27018 36.6695 8.52754 36.941 8.83978 37.1362L25.0898 47.1895L25.4148 47.3195H25.5881C25.9547 47.4358 26.3482 47.4358 26.7148 47.3195H26.8881L27.2131 47.1895L43.3331 37.2878C43.6454 37.0927 43.9027 36.8212 44.0809 36.4989C44.2591 36.1767 44.3522 35.8144 44.3514 35.4462V16.5312C44.3514 16.5312 44.3948 16.3795 44.3948 16.2928ZM25.9998 9.0345L29.8564 11.4178L17.7448 18.9145L13.8664 16.5312L25.9998 9.0345ZM23.8331 41.5345L11.9164 34.2545V20.4095L23.8331 27.7762V41.5345ZM25.9998 23.9628L21.8614 21.4712L33.9731 13.9528L38.1331 16.5312L25.9998 23.9628ZM40.0831 34.1895L28.1664 41.5995V27.7762L40.0831 20.4095V34.1895Z" fill="#2C2B2E"/>
                            </svg>
                            <p><?php pll_e("Collect In Store") ?></p>
                        </div>
                    </div>
                    <div class="forms-wrapper">
                        <div class="form delivery-form active">
                            <form>
                                <div class="input-label-wrapper city-wrapper">
                                    <label for="deliveryCity"><?php pll_e("City") ?><span>*</span></label>
                                    <select class="delivery-city required" id="deliveryCity">
                                        <option disabled="disabled" selected><?php pll_e("City") ?></option>
                                        <option value="250"><?php pll_e("Ornit, Elkana, Bat Yam, Holon") ?></option>
                                        <option value="100"><?php pll_e("Bnei Brak, Givatayim, Savion") ?></option>
                                        <option value="140"><?php pll_e("Airport City, Beer Ya'akov") ?></option>
                                        <option value="170"><?php pll_e("Haifa and the surrounding area") ?></option>
                                    </select>
                                </div>
                                <div class="half-inputs-wrapper date-time">
                                    <div class="input-label-wrapper date-wrapper">
                                        <label for="deliveryDate"><?php pll_e("Delivery Date") ?><span>*</span></label>
                                            <input type="date" class="delivery-date required" id="deliveryDate" placeholder="<?php pll_e('Select Delivery Date') ?>">
                                    </div>
                                    <div class="input-label-wrapper time-wrapper">
                                        <label for="deliveryTime"><?php pll_e("Delivery Time") ?><span>*</span></label>
                                            <input type="time" class="delivery-time required" id="deliveryTime" placeholder="<?php pll_e('Select Delivery Time') ?>">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="form collect-in-store-form">
                            <form>
                                <div class="half-inputs-wrapper date-time">
                                    <div class="input-label-wrapper date-wrapper">
                                        <label for="pickupDate"><?php pll_e("Pickup Date") ?><span>*</span></label>
                                            <input type="date" class="pickup-date required" id="pickupDate" placeholder="<?php pll_e('Select Pickup Date') ?>">
                                    </div>

                                    <div class="input-label-wrapper date-wrapper">
                                        <label for="pickupTime"><?php pll_e("Pickup Time") ?><span>*</span></label>
                                            <input type="time" class="pickup-time required" id="pickupTime" placeholder="<?php pll_e('Select Time') ?>">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="content-bottom">
                        <div class="order-summary-btn-mobile">
                            <p>
                                <span class="counter">(<?= $cart_count ?>)</span>
                                <?php pll_e("SHOW ORDER SUMMARY") ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                  <path d="M4.08764 7.48359C3.99217 7.39338 3.87986 7.32285 3.75713 7.27603C3.63441 7.22922 3.50366 7.20703 3.37236 7.21075C3.24105 7.21446 3.11177 7.244 2.99188 7.29768C2.872 7.35136 2.76386 7.42812 2.67364 7.52359C2.58342 7.61907 2.51289 7.73137 2.46608 7.8541C2.41926 7.97683 2.39708 8.10758 2.40079 8.23888C2.40451 8.37018 2.43404 8.49947 2.48772 8.61935C2.5414 8.73924 2.61817 8.84738 2.71364 8.9376L11.7136 17.4376C11.8993 17.6131 12.1451 17.7109 12.4006 17.7109C12.6562 17.7109 12.902 17.6131 13.0876 17.4376L22.0886 8.9376C22.1862 8.84797 22.265 8.73986 22.3204 8.61953C22.3758 8.4992 22.4068 8.36906 22.4115 8.23667C22.4162 8.10427 22.3946 7.97227 22.3478 7.84831C22.3011 7.72435 22.2302 7.61092 22.1392 7.5146C22.0482 7.41828 21.9391 7.34099 21.818 7.28722C21.6969 7.23346 21.5663 7.20428 21.4339 7.2014C21.3015 7.19852 21.1698 7.22198 21.0465 7.27042C20.9232 7.31886 20.8107 7.39133 20.7156 7.4836L12.4006 15.3356L4.08764 7.48359Z" fill="#2C2B2E"/>
                                </svg>
                            </p>
                            <div class="price"><?= $cart_subtotal ?></div>
                        </div>
                        <div id="order-summary" class="order-summary-mobile">
                            <div class="order-summary-wrapper">
                                <div class="order-summary-card">
                                    <div class="products">
                                        <div class="edit-order">
                                            <div class="left-side">
                                                <a href="#"><?php pll_e("Edit order") ?></a>
                                                <div class="order-count-price">
                                                    <div class="count"><?= $cart_count ?> <?php pll_e("items") ?></div>
                                                    <div class="price"><?= $cart_subtotal ?></div>
                                                </div>
                                            </div>
                                            <div class="trash">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M14.0003 17.9992C14.2655 17.9992 14.5199 17.8938 14.7074 17.7063C14.8949 17.5187 15.0003 17.2644 15.0003 16.9992V14.9992C15.0003 14.734 14.8949 14.4796 14.7074 14.2921C14.5199 14.1045 14.2655 13.9992 14.0003 13.9992C13.7351 13.9992 13.4807 14.1045 13.2932 14.2921C13.1056 14.4796 13.0003 14.734 13.0003 14.9992V16.9992C13.0003 17.2644 13.1056 17.5187 13.2932 17.7063C13.4807 17.8938 13.7351 17.9992 14.0003 17.9992ZM10.0003 17.9992C10.2655 17.9992 10.5199 17.8938 10.7074 17.7063C10.8949 17.5187 11.0003 17.2644 11.0003 16.9992V14.9992C11.0003 14.734 10.8949 14.4796 10.7074 14.2921C10.5199 14.1045 10.2655 13.9992 10.0003 13.9992C9.73506 13.9992 9.48071 14.1045 9.29317 14.2921C9.10564 14.4796 9.00028 14.734 9.00028 14.9992V16.9992C9.00028 17.2644 9.10564 17.5187 9.29317 17.7063C9.48071 17.8938 9.73506 17.9992 10.0003 17.9992ZM19.0003 5.99917H17.6203L15.8903 2.54917C15.8374 2.42223 15.7589 2.30755 15.6598 2.2123C15.5606 2.11705 15.4428 2.04329 15.3138 1.99561C15.1848 1.94794 15.0474 1.92738 14.9101 1.93522C14.7728 1.94306 14.6386 1.97913 14.5159 2.04118C14.3932 2.10323 14.2846 2.18992 14.1969 2.29584C14.1092 2.40176 14.0443 2.52463 14.0062 2.65677C13.9681 2.78891 13.9577 2.92748 13.9756 3.06382C13.9935 3.20016 14.0394 3.33135 14.1103 3.44917L15.3803 5.99917H8.62028L9.89028 3.44917C9.98735 3.21608 9.99264 2.9549 9.9051 2.71806C9.81756 2.48122 9.64367 2.28627 9.41834 2.17234C9.19301 2.05841 8.93292 2.03393 8.6903 2.10383C8.44767 2.17373 8.24046 2.33282 8.11028 2.54917L6.38028 5.99917H5.00028C4.29347 6.00992 3.61316 6.26992 3.07933 6.7333C2.5455 7.19669 2.19245 7.8337 2.08245 8.53198C1.97245 9.23026 2.11256 9.94496 2.47807 10.55C2.84358 11.1551 3.41101 11.6116 4.08028 11.8392L4.82028 19.2992C4.8949 20.0417 5.24363 20.7298 5.79835 21.2291C6.35308 21.7283 7.07398 22.0029 7.82028 21.9992H16.2003C16.9466 22.0029 17.6675 21.7283 18.2222 21.2291C18.7769 20.7298 19.1257 20.0417 19.2003 19.2992L19.9403 11.8392C20.611 11.611 21.1793 11.1527 21.5446 10.5457C21.9098 9.93857 22.0484 9.2218 21.9359 8.52232C21.8233 7.82283 21.4667 7.18576 20.9294 6.72395C20.3921 6.26214 19.7087 6.00538 19.0003 5.99917ZM17.1903 19.0992C17.1654 19.3467 17.0492 19.5761 16.8643 19.7425C16.6793 19.9089 16.439 20.0004 16.1903 19.9992H7.81028C7.56151 20.0004 7.32121 19.9089 7.1363 19.7425C6.9514 19.5761 6.83515 19.3467 6.81028 19.0992L6.10028 11.9992H17.9003L17.1903 19.0992ZM19.0003 9.99917H5.00028C4.73506 9.99917 4.48071 9.89382 4.29317 9.70628C4.10564 9.51874 4.00028 9.26439 4.00028 8.99917C4.00028 8.73396 4.10564 8.4796 4.29317 8.29207C4.48071 8.10453 4.73506 7.99917 5.00028 7.99917H19.0003C19.2655 7.99917 19.5199 8.10453 19.7074 8.29207C19.8949 8.4796 20.0003 8.73396 20.0003 8.99917C20.0003 9.26439 19.8949 9.51874 19.7074 9.70628C19.5199 9.89382 19.2655 9.99917 19.0003 9.99917Z" fill="white"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="products-list">
                                            <div class="list">
                                                <?php 
                                                foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                                                    $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                                                    $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                                                    $image_url = wp_get_attachment_image_url( $_product->get_image_id(), 'thumbnail' );
                                                ?>
                                                    <div class="product">
                                                        <div class="content">
                                                            <img src="<?= $image_url ?>" alt="Product image">
                                                            <p><?= substr($_product->get_name(), 0, 30) . '...' ?></p>
                                                        </div>
                                                        <div class="price-amount">
                                                            <span class="amount">×<?= $cart_item['quantity'] ?></span>
                                                            <p class="price"><?= WC()->cart->get_product_price( $_product ) ?></p>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="total-subtotal">
                                            <div class="subtotal">
                                                <p><? pll_e("Subtotal") ?></p>
                                                <span class="price"><?= $cart_subtotal ?></span>
                                            </div>
                                            <div class="delivery-price-wrapper">
                                                <p><?php pll_e("Delivery") ?></p>
                                                <span class="delivery-price"></span>
                                            </div>
                                            <div class="separator"></div>
                                            <div class="total">
                                                <p><?php pll_e("Total") ?></p>
                                                <span class="price"><?= $cart_subtotal ?></span>
                                            </div>
                                        </div>
                                        <!-- <div class="coupon-code"></div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="btn btn-primary btn-continue btn-step-1"><?php pll_e("Continue") ?></a>
                        <div class="notice">
                            <p><?php pll_e("Orders on the website minimum 24 hours before the delivery date. If the order is immediate, please call") ?> <a href="tel:050-7274809">050-7274809</a></p>
                        </div>
                    </div>
                </div>
                
                <!-- Step 2: Details -->
                <div class="step-content step-2" id="step-details">
                    <!-- Personal and billing information form here -->
                    <div class="forms-wrapper">
                        <div class="form details-form active">
                            <form>
                                <div class="half-inputs-wrapper">
                                    <div class="input-label-wrapper">
                                        <label for="firstName"><?php pll_e("First Name") ?><span>*</span></label>
                                            <input type="text" class="first-name required" id="firstName" placeholder="<?php pll_e('Enter First Name') ?>">
                                    </div>
                                    <div class="input-label-wrapper">
                                        <label for="lastName"><?php pll_e("Last Name") ?><span>*</span></label>
                                            <input type="text" class="last-name required" id="lastName" placeholder="<?php pll_e('Enter Last Name') ?>">
                                    </div>
                                </div>
                                <div class="half-inputs-wrapper">
                                    <div class="input-label-wrapper">
                                        <label for="mobilePhone"><?php pll_e("Mobile Phone") ?><span>*</span></label>
                                            <input type="text" class="mobile-phone required" id="mobilePhone" placeholder="<?php pll_e('Enter Mobile Phone') ?>">
                                    </div>
                                    <div class="input-label-wrapper">
                                        <label for="email"><?php pll_e("Email") ?><span>*</span></label>
                                            <input type="email" class="email required" id="email" placeholder="<?php pll_e('Enter Email Address') ?>">
                                    </div>
                                </div>
                                <div class="half-inputs-wrapper">
                                    <div class="input-label-wrapper">
                                        <label for="city"><?php pll_e("City") ?><span>*</span></label>
                                            <input type="text" class="city required" id="city" placeholder="<?php pll_e('Enter City') ?>">
                                    </div>
                                    <div class="input-label-wrapper">
                                        <label for="street"><?php pll_e("Street") ?><span>*</span></label>
                                            <input type="text" class="street required" id="street" placeholder="<?php pll_e('Enter Street') ?>">
                                    </div>
                                </div>
                                <div class="half-inputs-wrapper">
                                    <div class="input-label-wrapper">
                                        <label for="houseNumber"><?php pll_e("House Number") ?><span>*</span></label>
                                            <input type="text" class="house-number required" id="houseNumber" placeholder="<?php pll_e('Enter House Number') ?>">
                                    </div>
                                    <div class="input-label-wrapper">
                                        <label for="apartmentNumber"><?php pll_e("Apartment Number") ?></label>
                                            <input type="text" class="apartment-number" id="apartmentNumber" placeholder="<?php pll_e('Enter Apartment Number') ?>">
                                    </div>
                                </div>
                                <div class="half-inputs-wrapper">
                                    <div class="input-label-wrapper">
                                        <label for="floor"><?php pll_e("Floor") ?></label>
                                            <input type="text" class="floor" id="floor" placeholder="<?php pll_e('Enter Floor Number') ?>">
                                    </div>
                                    <div class="input-label-wrapper">
                                        <label for="entrance"><?php pll_e("Entrance") ?></label>
                                            <input type="text" class="entrance" id="entrance" placeholder="<?php pll_e('Enter Entrance') ?>">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="different-name-invoice">
                            <div class="checkbox">
                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="8" viewBox="0 0 10 8" fill="none">
                                    <path d="M3.58601 6.08101L1.85101 4.34601C1.75752 4.25252 1.63072 4.2 1.49851 4.2C1.3663 4.2 1.2395 4.25252 1.14601 4.34601C1.05252 4.4395 1 4.5663 1 4.69851C1 4.76398 1.01289 4.8288 1.03795 4.88928C1.063 4.94976 1.09972 5.00472 1.14601 5.05101L3.23601 7.14101C3.43101 7.33601 3.74601 7.33601 3.94101 7.14101L9.23101 1.85101C9.3245 1.75752 9.37702 1.63072 9.37702 1.49851C9.37702 1.3663 9.3245 1.2395 9.23101 1.14601C9.13752 1.05252 9.01072 1 8.87851 1C8.7463 1 8.6195 1.05252 8.52601 1.14601L3.58601 6.08101Z" fill="white" stroke="white"/>
                                </svg>
                            </div>
                            <p><?php pll_e("I need the invoice on a different name") ?></p>
                        </div>
                        <div class="form billing-info-form">
                            <form>
                                <div class="half-inputs-wrapper">
                                    <div class="input-label-wrapper">
                                        <label for="BIFirstName"><?php pll_e("First Name") ?><span>*</span></label>
                                            <input type="text" class="bi-first-name required" id="BIFirstName" placeholder="<?php pll_e('Enter First Name') ?>">
                                    </div>
                                    <div class="input-label-wrapper">
                                        <label for="BILastName"><?php pll_e("Last Name") ?><span>*</span></label>
                                            <input type="text" class="bi-last-name required" id="BILastName" placeholder="<?php pll_e('Enter Last Name') ?>">
                                    </div>
                                </div>
                                <div class="half-inputs-wrapper">
                                    <div class="input-label-wrapper">
                                        <label for="BIPhoneNumber"><?php pll_e("Phone Number") ?><span>*</span></label>
                                            <input type="text" class="bi-phone-number required" id="BIPhoneNumber" placeholder="<?php pll_e('Enter Phone Number') ?>">
                                    </div>
                                    <div class="input-label-wrapper">
                                        <label for="BIEmail"><?php pll_e("Email") ?><span>*</span></label>
                                            <input type="email" class="bi-email required" id="BIEmail" placeholder="<?php pll_e('Enter Email Address') ?>">
                                    </div>
                                </div>
                                <div class="half-inputs-wrapper">
                                    <div class="input-label-wrapper">
                                        <label for="BICompanyNumber"><?php pll_e("Company Number") ?></label>
                                            <input type="text" class="bi-company-number" id="BICompanyNumber" placeholder="<?php pll_e('Enter Company Number') ?>">
                                    </div>
                                    <div class="input-label-wrapper">
                                        <label for="BICompany"><?php pll_e("Company") ?></label>
                                            <input type="text" class="bi-company" id="BICompany" placeholder="<?php pll_e('Enter Company') ?>">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="content-bottom">
                        <a class="btn btn-primary btn-continue btn-step-2"><?php pll_e("Continue") ?></a>
                        <div class="order-summary-btn-mobile">
                            <p>
                                <span class="counter">(<?= $cart_count ?>)</span>
                                <?php pll_e("SHOW ORDER SUMMARY") ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                  <path d="M4.08764 7.48359C3.99217 7.39338 3.87986 7.32285 3.75713 7.27603C3.63441 7.22922 3.50366 7.20703 3.37236 7.21075C3.24105 7.21446 3.11177 7.244 2.99188 7.29768C2.872 7.35136 2.76386 7.42812 2.67364 7.52359C2.58342 7.61907 2.51289 7.73137 2.46608 7.8541C2.41926 7.97683 2.39708 8.10758 2.40079 8.23888C2.40451 8.37018 2.43404 8.49947 2.48772 8.61935C2.5414 8.73924 2.61817 8.84738 2.71364 8.9376L11.7136 17.4376C11.8993 17.6131 12.1451 17.7109 12.4006 17.7109C12.6562 17.7109 12.902 17.6131 13.0876 17.4376L22.0886 8.9376C22.1862 8.84797 22.265 8.73986 22.3204 8.61953C22.3758 8.4992 22.4068 8.36906 22.4115 8.23667C22.4162 8.10427 22.3946 7.97227 22.3478 7.84831C22.3011 7.72435 22.2302 7.61092 22.1392 7.5146C22.0482 7.41828 21.9391 7.34099 21.818 7.28722C21.6969 7.23346 21.5663 7.20428 21.4339 7.2014C21.3015 7.19852 21.1698 7.22198 21.0465 7.27042C20.9232 7.31886 20.8107 7.39133 20.7156 7.4836L12.4006 15.3356L4.08764 7.48359Z" fill="#2C2B2E"/>
                                </svg>
                            </p>
                            <div class="price"><?= $cart_subtotal ?></div>
                        </div>
                        <div id="order-summary" class="order-summary-mobile">
                            <div class="order-summary-wrapper">
                                <div class="order-summary-card">
                                    <div class="products">
                                        <div class="edit-order">
                                            <div class="left-side">
                                                <a href="#"><?php pll_e("Edit order") ?></a>
                                                <div class="order-count-price">
                                                    <div class="count"><?= $cart_count ?> <?php pll_e("items") ?></div>
                                                    <div class="price"><?= $cart_subtotal ?></div>
                                                </div>
                                            </div>
                                            <div class="trash">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M14.0003 17.9992C14.2655 17.9992 14.5199 17.8938 14.7074 17.7063C14.8949 17.5187 15.0003 17.2644 15.0003 16.9992V14.9992C15.0003 14.734 14.8949 14.4796 14.7074 14.2921C14.5199 14.1045 14.2655 13.9992 14.0003 13.9992C13.7351 13.9992 13.4807 14.1045 13.2932 14.2921C13.1056 14.4796 13.0003 14.734 13.0003 14.9992V16.9992C13.0003 17.2644 13.1056 17.5187 13.2932 17.7063C13.4807 17.8938 13.7351 17.9992 14.0003 17.9992ZM10.0003 17.9992C10.2655 17.9992 10.5199 17.8938 10.7074 17.7063C10.8949 17.5187 11.0003 17.2644 11.0003 16.9992V14.9992C11.0003 14.734 10.8949 14.4796 10.7074 14.2921C10.5199 14.1045 10.2655 13.9992 10.0003 13.9992C9.73506 13.9992 9.48071 14.1045 9.29317 14.2921C9.10564 14.4796 9.00028 14.734 9.00028 14.9992V16.9992C9.00028 17.2644 9.10564 17.5187 9.29317 17.7063C9.48071 17.8938 9.73506 17.9992 10.0003 17.9992ZM19.0003 5.99917H17.6203L15.8903 2.54917C15.8374 2.42223 15.7589 2.30755 15.6598 2.2123C15.5606 2.11705 15.4428 2.04329 15.3138 1.99561C15.1848 1.94794 15.0474 1.92738 14.9101 1.93522C14.7728 1.94306 14.6386 1.97913 14.5159 2.04118C14.3932 2.10323 14.2846 2.18992 14.1969 2.29584C14.1092 2.40176 14.0443 2.52463 14.0062 2.65677C13.9681 2.78891 13.9577 2.92748 13.9756 3.06382C13.9935 3.20016 14.0394 3.33135 14.1103 3.44917L15.3803 5.99917H8.62028L9.89028 3.44917C9.98735 3.21608 9.99264 2.9549 9.9051 2.71806C9.81756 2.48122 9.64367 2.28627 9.41834 2.17234C9.19301 2.05841 8.93292 2.03393 8.6903 2.10383C8.44767 2.17373 8.24046 2.33282 8.11028 2.54917L6.38028 5.99917H5.00028C4.29347 6.00992 3.61316 6.26992 3.07933 6.7333C2.5455 7.19669 2.19245 7.8337 2.08245 8.53198C1.97245 9.23026 2.11256 9.94496 2.47807 10.55C2.84358 11.1551 3.41101 11.6116 4.08028 11.8392L4.82028 19.2992C4.8949 20.0417 5.24363 20.7298 5.79835 21.2291C6.35308 21.7283 7.07398 22.0029 7.82028 21.9992H16.2003C16.9466 22.0029 17.6675 21.7283 18.2222 21.2291C18.7769 20.7298 19.1257 20.0417 19.2003 19.2992L19.9403 11.8392C20.611 11.611 21.1793 11.1527 21.5446 10.5457C21.9098 9.93857 22.0484 9.2218 21.9359 8.52232C21.8233 7.82283 21.4667 7.18576 20.9294 6.72395C20.3921 6.26214 19.7087 6.00538 19.0003 5.99917ZM17.1903 19.0992C17.1654 19.3467 17.0492 19.5761 16.8643 19.7425C16.6793 19.9089 16.439 20.0004 16.1903 19.9992H7.81028C7.56151 20.0004 7.32121 19.9089 7.1363 19.7425C6.9514 19.5761 6.83515 19.3467 6.81028 19.0992L6.10028 11.9992H17.9003L17.1903 19.0992ZM19.0003 9.99917H5.00028C4.73506 9.99917 4.48071 9.89382 4.29317 9.70628C4.10564 9.51874 4.00028 9.26439 4.00028 8.99917C4.00028 8.73396 4.10564 8.4796 4.29317 8.29207C4.48071 8.10453 4.73506 7.99917 5.00028 7.99917H19.0003C19.2655 7.99917 19.5199 8.10453 19.7074 8.29207C19.8949 8.4796 20.0003 8.73396 20.0003 8.99917C20.0003 9.26439 19.8949 9.51874 19.7074 9.70628C19.5199 9.89382 19.2655 9.99917 19.0003 9.99917Z" fill="white"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="products-list">
                                            <div class="list">
                                                <?php 
                                                foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                                                    $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                                                    $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                                                    $image_url = wp_get_attachment_image_url( $_product->get_image_id(), 'thumbnail' );
                                                ?>
                                                    <div class="product">
                                                        <div class="content">
                                                            <img src="<?= $image_url ?>" alt="Product image">
                                                            <p><?= substr($_product->get_name(), 0, 30) . '...' ?></p>
                                                        </div>
                                                        <div class="price-amount">
                                                            <span class="amount">×<?= $cart_item['quantity'] ?></span>
                                                            <p class="price"><?= WC()->cart->get_product_price( $_product ) ?></p>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="total-subtotal">
                                            <div class="subtotal">
                                                <p><?php pll_e("Subtotal") ?></p>
                                                <span class="price"><?= $cart_subtotal ?></span>
                                            </div>
                                            <div class="delivery-price-wrapper">
                                                <p><?php pll_e("Delivery") ?></p>
                                                <span class="delivery-price"></span>
                                            </div>
                                            <div class="separator"></div>
                                            <div class="total">
                                                <p><?php pll_e("Total") ?></p>
                                                <span class="price"><?= $cart_subtotal ?></span>
                                            </div>
                                        </div>
                                        <!-- <div class="coupon-code"></div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Step 3: Payment -->
                <div class="step-content step-3" id="step-payment">
                    <div class="payment-wrapper">
                        <form>
                            <div class="payment-choice credit-cart-payment">
                                <input type="radio" name="payment_option" id="creditCart" checked>
                                <div class="payment-copy">
                                    <span><?php pll_e("Credit Card") ?></span>
                                    <p><?php pll_e("By choosing this, you'll be directed to a secure payment page where you can safely use your credit card to finalise your order payment.") ?></p>
                                </div>
                            </div>
                            <div class="payment-choice telephone-representative-payment">
                                <input type="radio" name="payment_option" id="telephoneRepresentative">
                                <div class="payment-copy">
                                    <span><?php pll_e("Payment through a telephone representative") ?></span>
                                    <p><?php pll_e("If you choose this option, you will need to reach out and settle your payment method in order to successfully place your order. Contact information will be provided in the next step.") ?></p>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="content-bottom">
                    <?php echo apply_filters( 'woocommerce_order_button_html', '<button type="submit" class="button alt' . esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ) . '" name="woocommerce_checkout_place_order" id="place_order" value="Continue" data-value="Continue">Continue</button>' ); // @codingStandardsIgnoreLine ?>
                        <a class="btn btn-primary btn-continue btn-step-3 active"><?php pll_e("Continue") ?></a>
                        <div class="order-summary-btn-mobile">
                            <p>
                                <span class="counter">(<?= $cart_count ?>)</span>
                                <?php pll_e("SHOW ORDER SUMMARY") ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                  <path d="M4.08764 7.48359C3.99217 7.39338 3.87986 7.32285 3.75713 7.27603C3.63441 7.22922 3.50366 7.20703 3.37236 7.21075C3.24105 7.21446 3.11177 7.244 2.99188 7.29768C2.872 7.35136 2.76386 7.42812 2.67364 7.52359C2.58342 7.61907 2.51289 7.73137 2.46608 7.8541C2.41926 7.97683 2.39708 8.10758 2.40079 8.23888C2.40451 8.37018 2.43404 8.49947 2.48772 8.61935C2.5414 8.73924 2.61817 8.84738 2.71364 8.9376L11.7136 17.4376C11.8993 17.6131 12.1451 17.7109 12.4006 17.7109C12.6562 17.7109 12.902 17.6131 13.0876 17.4376L22.0886 8.9376C22.1862 8.84797 22.265 8.73986 22.3204 8.61953C22.3758 8.4992 22.4068 8.36906 22.4115 8.23667C22.4162 8.10427 22.3946 7.97227 22.3478 7.84831C22.3011 7.72435 22.2302 7.61092 22.1392 7.5146C22.0482 7.41828 21.9391 7.34099 21.818 7.28722C21.6969 7.23346 21.5663 7.20428 21.4339 7.2014C21.3015 7.19852 21.1698 7.22198 21.0465 7.27042C20.9232 7.31886 20.8107 7.39133 20.7156 7.4836L12.4006 15.3356L4.08764 7.48359Z" fill="#2C2B2E"/>
                                </svg>
                            </p>
                            <div class="price"><?= $cart_subtotal ?></div>
                        </div>
                        <div id="order-summary" class="order-summary-mobile">
                            <div class="order-summary-wrapper">
                                <div class="order-summary-card">
                                    <div class="products">
                                        <div class="edit-order">
                                            <div class="left-side">
                                                <a href="#"><?php pll_e("Edit order") ?></a>
                                                <div class="order-count-price">
                                                    <div class="count"><?= $cart_count ?> <?php pll_e("items") ?></div>
                                                    <div class="price"><?= $cart_subtotal ?></div>
                                                </div>
                                            </div>
                                            <div class="trash">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M14.0003 17.9992C14.2655 17.9992 14.5199 17.8938 14.7074 17.7063C14.8949 17.5187 15.0003 17.2644 15.0003 16.9992V14.9992C15.0003 14.734 14.8949 14.4796 14.7074 14.2921C14.5199 14.1045 14.2655 13.9992 14.0003 13.9992C13.7351 13.9992 13.4807 14.1045 13.2932 14.2921C13.1056 14.4796 13.0003 14.734 13.0003 14.9992V16.9992C13.0003 17.2644 13.1056 17.5187 13.2932 17.7063C13.4807 17.8938 13.7351 17.9992 14.0003 17.9992ZM10.0003 17.9992C10.2655 17.9992 10.5199 17.8938 10.7074 17.7063C10.8949 17.5187 11.0003 17.2644 11.0003 16.9992V14.9992C11.0003 14.734 10.8949 14.4796 10.7074 14.2921C10.5199 14.1045 10.2655 13.9992 10.0003 13.9992C9.73506 13.9992 9.48071 14.1045 9.29317 14.2921C9.10564 14.4796 9.00028 14.734 9.00028 14.9992V16.9992C9.00028 17.2644 9.10564 17.5187 9.29317 17.7063C9.48071 17.8938 9.73506 17.9992 10.0003 17.9992ZM19.0003 5.99917H17.6203L15.8903 2.54917C15.8374 2.42223 15.7589 2.30755 15.6598 2.2123C15.5606 2.11705 15.4428 2.04329 15.3138 1.99561C15.1848 1.94794 15.0474 1.92738 14.9101 1.93522C14.7728 1.94306 14.6386 1.97913 14.5159 2.04118C14.3932 2.10323 14.2846 2.18992 14.1969 2.29584C14.1092 2.40176 14.0443 2.52463 14.0062 2.65677C13.9681 2.78891 13.9577 2.92748 13.9756 3.06382C13.9935 3.20016 14.0394 3.33135 14.1103 3.44917L15.3803 5.99917H8.62028L9.89028 3.44917C9.98735 3.21608 9.99264 2.9549 9.9051 2.71806C9.81756 2.48122 9.64367 2.28627 9.41834 2.17234C9.19301 2.05841 8.93292 2.03393 8.6903 2.10383C8.44767 2.17373 8.24046 2.33282 8.11028 2.54917L6.38028 5.99917H5.00028C4.29347 6.00992 3.61316 6.26992 3.07933 6.7333C2.5455 7.19669 2.19245 7.8337 2.08245 8.53198C1.97245 9.23026 2.11256 9.94496 2.47807 10.55C2.84358 11.1551 3.41101 11.6116 4.08028 11.8392L4.82028 19.2992C4.8949 20.0417 5.24363 20.7298 5.79835 21.2291C6.35308 21.7283 7.07398 22.0029 7.82028 21.9992H16.2003C16.9466 22.0029 17.6675 21.7283 18.2222 21.2291C18.7769 20.7298 19.1257 20.0417 19.2003 19.2992L19.9403 11.8392C20.611 11.611 21.1793 11.1527 21.5446 10.5457C21.9098 9.93857 22.0484 9.2218 21.9359 8.52232C21.8233 7.82283 21.4667 7.18576 20.9294 6.72395C20.3921 6.26214 19.7087 6.00538 19.0003 5.99917ZM17.1903 19.0992C17.1654 19.3467 17.0492 19.5761 16.8643 19.7425C16.6793 19.9089 16.439 20.0004 16.1903 19.9992H7.81028C7.56151 20.0004 7.32121 19.9089 7.1363 19.7425C6.9514 19.5761 6.83515 19.3467 6.81028 19.0992L6.10028 11.9992H17.9003L17.1903 19.0992ZM19.0003 9.99917H5.00028C4.73506 9.99917 4.48071 9.89382 4.29317 9.70628C4.10564 9.51874 4.00028 9.26439 4.00028 8.99917C4.00028 8.73396 4.10564 8.4796 4.29317 8.29207C4.48071 8.10453 4.73506 7.99917 5.00028 7.99917H19.0003C19.2655 7.99917 19.5199 8.10453 19.7074 8.29207C19.8949 8.4796 20.0003 8.73396 20.0003 8.99917C20.0003 9.26439 19.8949 9.51874 19.7074 9.70628C19.5199 9.89382 19.2655 9.99917 19.0003 9.99917Z" fill="white"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="products-list">
                                            <div class="list">
                                                <?php 
                                                foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                                                    $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                                                    $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                                                    $image_url = wp_get_attachment_image_url( $_product->get_image_id(), 'thumbnail' );
                                                ?>
                                                    <div class="product">
                                                        <div class="content">
                                                            <img src="<?= $image_url ?>" alt="Product image">
                                                            <p><?= substr($_product->get_name(), 0, 30) . '...' ?></p>
                                                        </div>
                                                        <div class="price-amount">
                                                            <span class="amount">×<?= $cart_item['quantity'] ?></span>
                                                            <p class="price"><?= WC()->cart->get_product_price( $_product ) ?></p>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="total-subtotal">
                                            <div class="subtotal">
                                                <p><?php pll_e("Subtotal") ?></p>
                                                <span class="price"><?= $cart_subtotal ?></span>
                                            </div>
                                            <div class="delivery-price-wrapper">
                                                <p><?php pll_e("Delivery") ?></p>
                                                <span class="delivery-price"></span>
                                            </div>
                                            <div class="separator"></div>
                                            <div class="total">
                                                <p><?php pll_e("Total") ?></p>
                                                <span class="price"><?= $cart_subtotal ?></span>
                                            </div>
                                        </div>
                                        <!-- <div class="coupon-code"></div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="order-summary" class="hide-mobile">
            <div class="order-summary-wrapper">
                <div class="order-summary-card">
                    <p class="card-title"><?php pll_e("Your Order") ?></p>
                    <div class="separator hide-mobile"></div>
                    <div class="products">
                        <div class="edit-order">
                            <div class="left-side">
                                <a href="#"><?php pll_e("Edit order") ?></a>
                                <div class="order-count-price">
                                    <div class="count"><?= $cart_count ?> <?php pll_e("items") ?></div>
                                    <div class="price"><?= $cart_subtotal ?></div>
                                </div>
                            </div>
                            <div class="trash">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M14.0003 17.9992C14.2655 17.9992 14.5199 17.8938 14.7074 17.7063C14.8949 17.5187 15.0003 17.2644 15.0003 16.9992V14.9992C15.0003 14.734 14.8949 14.4796 14.7074 14.2921C14.5199 14.1045 14.2655 13.9992 14.0003 13.9992C13.7351 13.9992 13.4807 14.1045 13.2932 14.2921C13.1056 14.4796 13.0003 14.734 13.0003 14.9992V16.9992C13.0003 17.2644 13.1056 17.5187 13.2932 17.7063C13.4807 17.8938 13.7351 17.9992 14.0003 17.9992ZM10.0003 17.9992C10.2655 17.9992 10.5199 17.8938 10.7074 17.7063C10.8949 17.5187 11.0003 17.2644 11.0003 16.9992V14.9992C11.0003 14.734 10.8949 14.4796 10.7074 14.2921C10.5199 14.1045 10.2655 13.9992 10.0003 13.9992C9.73506 13.9992 9.48071 14.1045 9.29317 14.2921C9.10564 14.4796 9.00028 14.734 9.00028 14.9992V16.9992C9.00028 17.2644 9.10564 17.5187 9.29317 17.7063C9.48071 17.8938 9.73506 17.9992 10.0003 17.9992ZM19.0003 5.99917H17.6203L15.8903 2.54917C15.8374 2.42223 15.7589 2.30755 15.6598 2.2123C15.5606 2.11705 15.4428 2.04329 15.3138 1.99561C15.1848 1.94794 15.0474 1.92738 14.9101 1.93522C14.7728 1.94306 14.6386 1.97913 14.5159 2.04118C14.3932 2.10323 14.2846 2.18992 14.1969 2.29584C14.1092 2.40176 14.0443 2.52463 14.0062 2.65677C13.9681 2.78891 13.9577 2.92748 13.9756 3.06382C13.9935 3.20016 14.0394 3.33135 14.1103 3.44917L15.3803 5.99917H8.62028L9.89028 3.44917C9.98735 3.21608 9.99264 2.9549 9.9051 2.71806C9.81756 2.48122 9.64367 2.28627 9.41834 2.17234C9.19301 2.05841 8.93292 2.03393 8.6903 2.10383C8.44767 2.17373 8.24046 2.33282 8.11028 2.54917L6.38028 5.99917H5.00028C4.29347 6.00992 3.61316 6.26992 3.07933 6.7333C2.5455 7.19669 2.19245 7.8337 2.08245 8.53198C1.97245 9.23026 2.11256 9.94496 2.47807 10.55C2.84358 11.1551 3.41101 11.6116 4.08028 11.8392L4.82028 19.2992C4.8949 20.0417 5.24363 20.7298 5.79835 21.2291C6.35308 21.7283 7.07398 22.0029 7.82028 21.9992H16.2003C16.9466 22.0029 17.6675 21.7283 18.2222 21.2291C18.7769 20.7298 19.1257 20.0417 19.2003 19.2992L19.9403 11.8392C20.611 11.611 21.1793 11.1527 21.5446 10.5457C21.9098 9.93857 22.0484 9.2218 21.9359 8.52232C21.8233 7.82283 21.4667 7.18576 20.9294 6.72395C20.3921 6.26214 19.7087 6.00538 19.0003 5.99917ZM17.1903 19.0992C17.1654 19.3467 17.0492 19.5761 16.8643 19.7425C16.6793 19.9089 16.439 20.0004 16.1903 19.9992H7.81028C7.56151 20.0004 7.32121 19.9089 7.1363 19.7425C6.9514 19.5761 6.83515 19.3467 6.81028 19.0992L6.10028 11.9992H17.9003L17.1903 19.0992ZM19.0003 9.99917H5.00028C4.73506 9.99917 4.48071 9.89382 4.29317 9.70628C4.10564 9.51874 4.00028 9.26439 4.00028 8.99917C4.00028 8.73396 4.10564 8.4796 4.29317 8.29207C4.48071 8.10453 4.73506 7.99917 5.00028 7.99917H19.0003C19.2655 7.99917 19.5199 8.10453 19.7074 8.29207C19.8949 8.4796 20.0003 8.73396 20.0003 8.99917C20.0003 9.26439 19.8949 9.51874 19.7074 9.70628C19.5199 9.89382 19.2655 9.99917 19.0003 9.99917Z" fill="white"/>
                                </svg>
                            </div>
                        </div>
                        <div class="products-list">
                            <div class="list">
                                <?php 
                                foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                                    $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                                    $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                                    $image_url = wp_get_attachment_image_url( $_product->get_image_id(), 'thumbnail' );
                                ?>
                                    <div class="product">
                                        <div class="content">
                                            <img src="<?= $image_url ?>" alt="Product image">
                                            <p><?= substr($_product->get_name(), 0, 30) . '...' ?></p>
                                        </div>
                                        <div class="price-amount">
                                            <span class="amount">×<?= $cart_item['quantity'] ?></span>
                                            <p class="price"><?= WC()->cart->get_product_price( $_product ) ?></p>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <a class="btn btn-secondary btn-see-whole-order">
                                <?php pll_e("See whole order") ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M3.40604 6.23503C3.32648 6.15984 3.23289 6.10107 3.13062 6.06206C3.02835 6.02304 2.91939 6.00456 2.80997 6.00765C2.70055 6.01075 2.59282 6.03536 2.49291 6.0801C2.39301 6.12483 2.30289 6.1888 2.22771 6.26836C2.15253 6.34792 2.09375 6.44151 2.05474 6.54378C2.01572 6.64606 1.99724 6.75501 2.00033 6.86443C2.00343 6.97385 2.02805 7.08159 2.07278 7.18149C2.11751 7.2814 2.18148 7.37151 2.26104 7.44669L9.76104 14.53C9.91577 14.6763 10.1206 14.7578 10.3335 14.7578C10.5465 14.7578 10.7513 14.6763 10.906 14.53L18.4069 7.44669C18.4882 7.37201 18.5538 7.28191 18.6 7.18164C18.6462 7.08137 18.672 6.97292 18.6759 6.86259C18.6798 6.75226 18.6618 6.64225 18.6228 6.53895C18.5839 6.43566 18.5248 6.34113 18.449 6.26086C18.3732 6.1806 18.2822 6.11619 18.1813 6.07138C18.0804 6.02658 17.9716 6.00227 17.8613 5.99986C17.7509 5.99746 17.6411 6.01701 17.5384 6.05738C17.4356 6.09775 17.3419 6.15814 17.2627 6.23503L10.3335 12.7784L3.40604 6.23503Z" fill="#C2996F"/>
                                </svg>
                            </a>
                        </div>
                        <div class="total-subtotal">
                            <div class="subtotal">
                                <p><?php pll_e("Subtotal") ?></p>
                                <span class="price"><?= $cart_subtotal ?></span>
                            </div>
                            <div class="delivery-price-wrapper">
                                <p><?php pll_e("Delivery") ?></p>
                                <span class="delivery-price"></span>
                            </div>
                            <div class="separator"></div>
                            <div class="total">
                                <p><?php pll_e("Total") ?></p>
                                <span class="price"><?= $cart_subtotal ?></span>
                            </div>
                        </div>
                        <!-- <div class="coupon-code"></div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php get_footer() ?>