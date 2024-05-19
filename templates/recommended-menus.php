<?php /* Template Name: Recommended Menus Template */
get_header();

// Get main category ID by name
$main_category = get_term_by( 'name', 'Recommended Menus', 'product_cat' ); // Replace 'Main Category Name' with the actual main category name
$main_category_id = $main_category->term_id;

// Get all subcategories of the main category
$sub_categories = get_terms( array(
    'taxonomy'   => 'product_cat',
    'parent'     => $main_category_id,
    'hide_empty' => false,
) );

$total_price = 0;
$grouped_product_id = 0;
$children_ids = array();
?>
<div class="recommended-menus recommended-menus-template page template">
    <div class="recommended-menus-hero">
        <div class="half-hero-background"></div>
        <div class="container">
            <div class="mid-box">
                <div class="mid-box-container">
                    <div class="title">
                        <p><?php pll_e("Need help? Fill in the fields below to get menu recommendations!") ?></p>
                    </div>
                    <div class="build-menu-form">
                        <div class="form-wrapper">
                            <div class="item item-1">
                                <p><?php pll_e("Event Type") ?></p>
                                <select>
                                    <option selected="true" disabled="disabled"><?php pll_e("Select type of event") ?></option>
                                    <!-- Get dynamically recommended menus categories here, advice: create main cat: Rec Men and then sub-cats items below -->
                                    <option value="aliyah-to-torah"><?php pll_e('Aliyah to Torah') ?></option>
                                    <option value="business-events"><?php pll_e('Business Event') ?></option>
                                    <option value="hanukkah"><?php pll_e('Hanukkah') ?></option>
                                    <option value="engagement-parties"><?php pll_e('Engagement Party') ?></option>
                                    <option value="birthday-parties"><?php pll_e('Birthday Party') ?></option>
                                    <option value="challah-refreshments"><?php pll_e('Challah Refreshment') ?></option>
                                </select>
                            </div>
                            <div class="item item-2">
                                <p><?php pll_e("Time") ?></p>
                                <select>
                                    <option selected="true" disabled="disabled"><?php pll_e("Select time") ?></option>
                                    <option value="morning"><?php pll_e("Morning") ?></option>
                                    <option value="afternoon"><?php pll_e("Afternoon") ?></option>
                                    <option value="night"><?php pll_e("Night") ?></option>
                                </select>
                            </div>
                            <div class="item item-3">
                                <p><?php pll_e("Number of Guests") ?></p>
                                <input type="number" placeholder="<?php pll_e('Enter No of Guests') ?>">
                            </div>
                            <div class="item item-4">
                                <a href="#" class="btn btn-primary build-menu-btn"><?php pll_e("Build my menu") ?></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="scroll-down-box">
                    <p><?php pll_e("Or scroll down to discover our menu packages!") ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="recommended-menus-catalog">
        <div class="container">
            <div class="copy">
                <h1 class="h-2"><?php pll_e("Recommended Menus") ?></h1>
                <p><?php pll_e("We have created menus ready for any event you may be organizing. Simply choose the menu that suits you and add it to the shopping cart from where you'll be able to edit it by your preferences!") ?></p>
            </div>
            <div class="recommended-menus-categories-wrapper" id="categoriesWrapper">
                <div class="categories-dropdown">
                    <div class="dropdown-button" id="catDropdown">
                        <h3><?php pll_e("Choose category") ?></h3>
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24" fill="none">
                            <path d="M4.16576 7.48164C4.07029 7.39142 3.95799 7.32089 3.83526 7.27408C3.71253 7.22726 3.58178 7.20508 3.45048 7.20879C3.31918 7.21251 3.18989 7.24205 3.07001 7.29573C2.95012 7.3494 2.84198 7.42617 2.75176 7.52164C2.66155 7.61711 2.59102 7.72942 2.5442 7.85215C2.49739 7.97488 2.4752 8.10562 2.47892 8.23693C2.48263 8.36823 2.51217 8.49751 2.56585 8.6174C2.61953 8.73728 2.69629 8.84542 2.79176 8.93564L11.7918 17.4356C11.9774 17.6112 12.2233 17.709 12.4788 17.709C12.7343 17.709 12.9801 17.6112 13.1658 17.4356L22.1668 8.93564C22.2643 8.84602 22.3431 8.7379 22.3985 8.61758C22.454 8.49725 22.4849 8.36711 22.4896 8.23472C22.4943 8.10232 22.4727 7.97031 22.4259 7.84636C22.3792 7.7224 22.3083 7.60897 22.2173 7.51265C22.1264 7.41632 22.0172 7.33904 21.8961 7.28527C21.775 7.2315 21.6445 7.20233 21.512 7.19945C21.3796 7.19656 21.2479 7.22002 21.1246 7.26847C21.0013 7.31691 20.8888 7.38937 20.7938 7.48164L12.4788 15.3336L4.16576 7.48164Z" fill="#C2996F"/>
                        </svg>
                    </div>
                    <div class="dropdown-content">
                        <?php
                            foreach ($sub_categories as $sub_category) {
                                // Get category thumbnail
                                $thumbnail_id = get_term_meta($sub_category->term_id, 'thumbnail_id', true);
                                $thumbnail_url = wp_get_attachment_url($thumbnail_id);
                        ?>
                            <a class="item" href="#<?= esc_html($sub_category->slug) ?>">
                                <img src="<?php echo esc_url  ($thumbnail_url) ?>" alt="<?php echo esc_html($sub_category->name) ?>">
                                <h3><?php echo esc_html($sub_category->name) ?></h3>
                            </a>
                        <?php } ?>
                    </div>
                </div>
                <div class="categories-wrapper" id="categoriesWrapper">
                    <?php
                        foreach ($sub_categories as $sub_category) {
                            // Get category thumbnail
                            $thumbnail_id = get_term_meta($sub_category->term_id, 'thumbnail_id', true);
                            $thumbnail_url = wp_get_attachment_url($thumbnail_id);
                    ?>
                        <div class="product-category <?php if($sub_category->count <= 0) { echo 'not-active'; } ?>">
                            <a href="#<?= esc_html($sub_category->slug) ?>">
                                <?php
                                    if (!empty($thumbnail_url)) {
                                        echo '<img class="product-category-image" src="' . esc_url  ($thumbnail_url) . '" alt="' . esc_attr($sub_category->name) . '">';
                                    }
                                ?>

                                <p><?php echo esc_html($sub_category->name) ?></p>
                            </a>
                            <?php /* <p> <?php echo esc_html($category->slug) ?></p> */ ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="recommended-menus-catalog-wrapper" id="recommendedMenusCatalog">
                <?php
                // Loop through subcategories
                foreach ( $sub_categories as $sub_category ) {
                    $thumbnail_id = get_term_meta($sub_category->term_id, 'thumbnail_id', true);
                    $thumbnail_url = wp_get_attachment_url($thumbnail_id);

                    // Query products by subcategory
                    $args = array(
                        'post_type'      => 'product',
                        'posts_per_page' => -1,
                        'tax_query'      => array(
                            array(
                                'taxonomy' => 'product_cat',
                                'field'    => 'term_id',
                                'terms'    => $sub_category->term_id,
                                'include_children' => false, // Ensure only products directly in this subcategory are fetched
                            ),
                        ),
                    );

                    $products_query = new WP_Query( $args );

                    if ( $products_query->have_posts() ) {
                        // Output subcategory name
                        echo '<h3><img src="'.$thumbnail_url.'">' . $sub_category->name . '</h3>';
                        ?>
                        <div class="recommended-menus-list">
                        <span class="category-anchor" id="<?= esc_html($sub_category->slug) ?>"></span>
                        <?php while ( $products_query->have_posts() ) {
                            $products_query->the_post();
                            global $product;

                            if ( $product->is_type( 'grouped' ) ) {
                                $grouped_product_id = get_the_ID();
                                $children_ids = $product->get_children(); // Get IDs of all products linked inside the grouped product
                                $total_price = 0;

                                // Loop through each child product
                                foreach ( $children_ids as $child_id ) {
                                    $child_product = wc_get_product( $child_id );

                                    // Output child product name and price
                                    // echo '<p>Product: ' . $child_product->get_name() . ' | Price: ' . $child_product->get_price() . '</p>';

                                    // Calculate total price
                                    $total_price += $child_product->get_price();
                                } ?>

                                <?php get_template_part( 'template-parts/content', 'recommendedmenu', $total_price ); ?>

                        <?php }
                        } ?>
                    </div>
                <?php }

                    wp_reset_postdata();
                }
                ?>
            </div>
        </div>

        <div class="recommended-menu-modal product-modal modal">
            <div class="modal-wrapper">
                <div class="modal-header">
                    <div class="copy">
                        <img src="<?= ASSETS_URI ?>/images/product-modal-logo.svg" alt="Nougatine logo">
                        <p><?php pll_e("Catering menu for Brit Boker for 100 participants") ?></p>
                    </div>

                    <span class="close">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M19.281 18.2198C19.3507 18.2895 19.406 18.3722 19.4437 18.4632C19.4814 18.5543 19.5008 18.6519 19.5008 18.7504C19.5008 18.849 19.4814 18.9465 19.4437 19.0376C19.406 19.1286 19.3507 19.2114 19.281 19.281C19.2114 19.3507 19.1286 19.406 19.0376 19.4437C18.9465 19.4814 18.849 19.5008 18.7504 19.5008C18.6519 19.5008 18.5543 19.4814 18.4632 19.4437C18.3722 19.406 18.2895 19.3507 18.2198 19.281L12.0004 13.0607L5.78104 19.281C5.64031 19.4218 5.44944 19.5008 5.25042 19.5008C5.05139 19.5008 4.86052 19.4218 4.71979 19.281C4.57906 19.1403 4.5 18.9494 4.5 18.7504C4.5 18.5514 4.57906 18.3605 4.71979 18.2198L10.9401 12.0004L4.71979 5.78104C4.57906 5.64031 4.5 5.44944 4.5 5.25042C4.5 5.05139 4.57906 4.86052 4.71979 4.71979C4.86052 4.57906 5.05139 4.5 5.25042 4.5C5.44944 4.5 5.64031 4.57906 5.78104 4.71979L12.0004 10.9401L18.2198 4.71979C18.3605 4.57906 18.5514 4.5 18.7504 4.5C18.9494 4.5 19.1403 4.57906 19.281 4.71979C19.4218 4.86052 19.5008 5.05139 19.5008 5.25042C19.5008 5.44944 19.4218 5.64031 19.281 5.78104L13.0607 12.0004L19.281 18.2198Z" fill="#C2996F"/>
                        </svg>
                    </span>
                </div>
                <div class="container">
                    <div class="modal-content">
                        <div class="products-list-wrapper left-side">
                            <div class="product-tag salty">
                                <div class="title">
                                   <img src="<?= ASSETS_URI ?>/images/salty.svg" alt="Salty">
                                   <p><?php pll_e("Salty") ?></p>
                                </div>
                                <div class="products-list">
                                    <div class="item">
                                        <p><?php pll_e("Mushroom quiche, d. 24 cm (sliced into 16 pcs)") ?></p>
                                        <span class="price">₪ 125</span>
                                    </div>
                                    <div class="item">
                                        <p><?php pll_e("Mushroom quiche, d. 24 cm (sliced into 16 pcs)") ?></p>
                                        <span class="price">₪ 125</span>
                                    </div>
                                    <div class="item">
                                        <p><?php pll_e("Sweet potato and walnut quiche, d. 24 cm (sliced into 16 pcs)") ?></p>
                                        <span class="price">₪ 125</span>
                                    </div>
                                    <div class="item">
                                        <p><?php pll_e("A tray of salty puffs with a variety of fillings - tray 35 pcs") ?></p>
                                        <span class="price">₪ 220</span>
                                    </div>
                                    <div class="item">
                                        <p><?php pll_e("A tray of mini tortillas in a variety of fillings - about 40 pcs") ?></p>
                                        <span class="price">₪ 220</span>
                                    </div>
                                    <div class="item">
                                        <p><?php pll_e("Manhattan spring roll tray - tray about 40 pieces") ?></p>
                                        <span class="price">₪ 250</span>
                                    </div>
                                    <div class="item">
                                        <p><?php pll_e("Serving tray for sweet potato fritters - tray 25 pcs") ?></p>
                                        <span class="price">₪ 250</span>
                                    </div>
                                    <div class="item">
                                        <p><?php pll_e("Serving tray for sweet potato fritters - tray 25 pcs") ?></p>
                                        <span class="price">₪ 300</span>
                                    </div>
                                    <div class="item">
                                        <p><?php pll_e("Serving tray mini pizzas - tray 35 pcs") ?></p>
                                        <span class="price">₪ 325</span>
                                    </div>
                                    <div class="item">
                                        <p><?php pll_e("A tray of eggplant rolls filled with cheese - about 35 pcs") ?></p>
                                        <span class="price">₪ 325</span>
                                    </div>
                                    <div class="item">
                                        <p><?php pll_e("Kadaif baskets, cream cheese, tomato spread - 35 pcs") ?></p>
                                        <span class="price">₪ 375</span>
                                    </div>
                                    <div class="item">
                                        <p><?php pll_e("Panko arancini balls tray - about 25 pieces") ?></p>
                                        <span class="price">₪ 425</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="products-list-wrapper right-side others">
                            <div class="product-tag sweet">
                                <div class="title color-brown">
                                   <img src="<?= ASSETS_URI ?>/images/sweet.svg" alt="Sweet">
                                   <p><?php pll_e("Sweet") ?></p>
                                </div>
                                <div class="products-list">
                                    <div class="item">
                                        <p><?php pll_e("Mushroom quiche, d. 24 cm (sliced into 16 pcs)") ?></p>
                                        <span class="price">₪ 125</span>
                                    </div>
                                    <div class="item">
                                        <p><?php pll_e("Mushroom quiche, d. 24 cm (sliced into 16 pcs)") ?></p>
                                        <span class="price">₪ 125</span>
                                    </div>
                                    <div class="item">
                                        <p><?php pll_e("Sweet potato and walnut quiche, d. 24 cm (sliced into 16 pcs)") ?></p>
                                        <span class="price">₪ 125</span>
                                    </div>
                                </div>
                            </div>
                            <div class="product-tag salads">
                                <div class="title color-green">
                                   <img src="<?= ASSETS_URI ?>/images/salad.svg" alt="Salads">
                                   <p><?php pll_e("Salads") ?></p>
                                </div>
                                <div class="products-list">
                                    <div class="item">
                                        <p><?php pll_e("Mushroom quiche, d. 24 cm (sliced into 16 pcs)") ?></p>
                                        <span class="price">₪ 125</span>
                                    </div>
                                    <div class="item">
                                        <p><?php pll_e("A tray of salty puffs with a variety of fillings - tray 35 pcs") ?></p>
                                        <span class="price">₪ 220</span>
                                    </div>
                                    <div class="item">
                                        <p><?php pll_e("A tray of salty puffs with a variety of fillings - tray 35 pcs") ?></p>
                                        <span class="price">₪ 220</span>
                                    </div>
                                    <div class="item">
                                        <p><?php pll_e("A tray of salty puffs with a variety of fillings - tray 35 pcs") ?></p>
                                        <span class="price">₪ 220</span>
                                    </div>
                                </div>
                            </div>
                            <div class="product-tag pastries">
                                <div class="title color-orange">
                                   <img src="<?= ASSETS_URI ?>/images/bread.svg" alt="Bread">
                                   <p><?php pll_e("Pastries") ?></p>
                                </div>
                                <div class="products-list">
                                    <div class="item">
                                        <p><?php pll_e("Mushroom quiche, d. 24 cm (sliced into 16 pcs)") ?></p>
                                        <span class="price">₪ 23</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-price-cta">
                        <a href="#" class="btn btn-primary modal-cta">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M17.5003 13.3332H5.83366C5.61265 13.3332 5.40068 13.2454 5.2444 13.0891C5.08812 12.9328 5.00033 12.7209 5.00033 12.4998C5.00033 12.2788 5.08812 12.0669 5.2444 11.9106C5.40068 11.7543 5.61265 11.6665 5.83366 11.6665H14.5337C15.0909 11.6665 15.6321 11.4804 16.0715 11.1377C16.5108 10.795 16.8231 10.3153 16.9587 9.77484L18.3337 4.3665C18.3649 4.24351 18.3676 4.11501 18.3416 3.99081C18.3156 3.86661 18.2616 3.74999 18.1837 3.64984C18.1026 3.54711 17.9985 3.46492 17.8798 3.4099C17.7611 3.35489 17.6311 3.3286 17.5003 3.33317H5.63366C5.46173 2.84688 5.1436 2.42567 4.72288 2.12729C4.30216 1.8289 3.79945 1.66795 3.28366 1.6665H2.50033C2.27931 1.6665 2.06735 1.7543 1.91107 1.91058C1.75479 2.06686 1.66699 2.27882 1.66699 2.49984C1.66699 2.72085 1.75479 2.93281 1.91107 3.08909C2.06735 3.24537 2.27931 3.33317 2.50033 3.33317H3.28366C3.47402 3.32762 3.66054 3.38745 3.81216 3.50268C3.96379 3.61792 4.07137 3.78161 4.11699 3.9665L4.16699 4.3665L5.60866 9.99984C4.94562 10.0297 4.32159 10.3217 3.87384 10.8116C3.4261 11.3016 3.19132 11.9493 3.22116 12.6123C3.251 13.2754 3.543 13.8994 4.03294 14.3472C4.52288 14.7949 5.17062 15.0297 5.83366 14.9998H5.98366C5.84661 15.3774 5.80257 15.7825 5.85527 16.1808C5.90797 16.579 6.05586 16.9587 6.28642 17.2876C6.51698 17.6166 6.82342 17.8852 7.17979 18.0706C7.53615 18.256 7.93195 18.3528 8.33366 18.3528C8.73537 18.3528 9.13117 18.256 9.48753 18.0706C9.8439 17.8852 10.1503 17.6166 10.3809 17.2876C10.6115 16.9587 10.7593 16.579 10.8121 16.1808C10.8648 15.7825 10.8207 15.3774 10.6837 14.9998H12.6503C12.5133 15.3774 12.4692 15.7825 12.5219 16.1808C12.5746 16.579 12.7225 16.9587 12.9531 17.2876C13.1837 17.6166 13.4901 17.8852 13.8465 18.0706C14.2028 18.256 14.5986 18.3528 15.0003 18.3528C15.402 18.3528 15.7978 18.256 16.1542 18.0706C16.5106 17.8852 16.817 17.6166 17.0476 17.2876C17.2781 16.9587 17.426 16.579 17.4787 16.1808C17.5314 15.7825 17.4874 15.3774 17.3503 14.9998H17.5003C17.7213 14.9998 17.9333 14.912 18.0896 14.7558C18.2459 14.5995 18.3337 14.3875 18.3337 14.1665C18.3337 13.9455 18.2459 13.7335 18.0896 13.5772C17.9333 13.421 17.7213 13.3332 17.5003 13.3332ZM16.4337 4.99984L15.342 9.3665C15.2964 9.5514 15.1888 9.71509 15.0372 9.83033C14.8855 9.94556 14.699 10.0054 14.5087 9.99984H7.31699L6.06699 4.99984H16.4337ZM8.33366 16.6665C8.16884 16.6665 8.00772 16.6176 7.87068 16.5261C7.73364 16.4345 7.62683 16.3043 7.56376 16.1521C7.50069 15.9998 7.48418 15.8322 7.51634 15.6706C7.54849 15.5089 7.62786 15.3605 7.7444 15.2439C7.86095 15.1274 8.00943 15.048 8.17108 15.0159C8.33273 14.9837 8.50029 15.0002 8.65256 15.0633C8.80483 15.1263 8.93498 15.2332 9.02655 15.3702C9.11812 15.5072 9.16699 15.6684 9.16699 15.8332C9.16699 16.0542 9.0792 16.2661 8.92291 16.4224C8.76663 16.5787 8.55467 16.6665 8.33366 16.6665ZM15.0003 16.6665C14.8355 16.6665 14.6744 16.6176 14.5374 16.5261C14.4003 16.4345 14.2935 16.3043 14.2304 16.1521C14.1674 15.9998 14.1509 15.8322 14.183 15.6706C14.2152 15.5089 14.2945 15.3605 14.4111 15.2439C14.5276 15.1274 14.6761 15.048 14.8378 15.0159C14.9994 14.9837 15.167 15.0002 15.3192 15.0633C15.4715 15.1263 15.6017 15.2332 15.6932 15.3702C15.7848 15.5072 15.8337 15.6684 15.8337 15.8332C15.8337 16.0542 15.7459 16.2661 15.5896 16.4224C15.4333 16.5787 15.2213 16.6665 15.0003 16.6665Z" fill="white"/>
                            </svg>
                            <?php pll_e("ADD TO CART TO EDIT MENU") ?>
                        </a>
                        <div class="modal-price">
                            <p><?php pll_e("Total Menu Price:") ?></p>
                            <span class="price">₪ 5885.00</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?php get_footer() ?>
