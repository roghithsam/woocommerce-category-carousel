<?php
/*
Plugin Name: WooCommerce Category Carousel
Plugin URI:  https://github.com/roghithsam/woocommerce-category-carousel/
Description: A customizable carousel to display WooCommerce product categories using Owl Carousel.
Version:     1.0
Author:      Roghithsam
Author URI:  https://roghithsam.zhark.in/
License:     MIT
License URI: https://opensource.org/licenses/MIT
Text Domain: category-carousel
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Enqueue Owl Carousel Assets
 */
function enqueue_owl_carousel_assets() {
    wp_enqueue_style('owl-carousel-css', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css');
    wp_enqueue_style('owl-carousel-theme-css', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css');
    wp_enqueue_script('owl-carousel-js', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', ['jquery'], '2.3.4', true);
}
add_action('wp_enqueue_scripts', 'enqueue_owl_carousel_assets');

/**
 * Category Carousel Shortcode
 */
function category_carousel_shortcode($atts) {
    // Parse shortcode attributes with defaults
    $atts = shortcode_atts(
        [
           'autoplay' => 'true',
            'dots' => 'true',
            'loop' => 'true',
            'arrow' => 'false',
            'show_view_button' => 'no',
            'show_count' => 'no',
            'slides_desktop' => 4,
            'slides_tablet' => 3,
            'slides_phone' => 2,
            'hide_empty' => 'no',
            'parent_only' => 'no',
            'main_category_id' => '',
            'include_categories' => '',
            'exclude_categories' => '',
            'limit' => '',
            'orderby' => 'name',
            'order' => 'ASC'
        ],
        $atts,
        'category_carousel'
    );

    ob_start();
    ?>
    <div class="category-carousel owl-carousel woocommerce columns-4">

        <?php
        // Get product categories
        $args = [
            'taxonomy' => 'product_cat',
            'orderby' => $atts['orderby'],
            'order' => $atts['order'],
            'hide_empty' => $atts['hide_empty'] === 'yes',
        ];

        // Filter for parent categories only
        if ($atts['parent_only'] === 'yes') {
            $args['parent'] = 0;
        }

        // Filter by main category ID
        if (!empty($atts['main_category_id'])) {
            $args['parent'] = intval($atts['main_category_id']);
        }

        // Include specific categories
        if (!empty($atts['include_categories'])) {
            $args['include'] = array_map('intval', explode(',', $atts['include_categories']));
        }

        // Exclude specific categories
        if (!empty($atts['exclude_categories'])) {
            $args['exclude'] = array_map('intval', explode(',', $atts['exclude_categories']));
        }

        // Limit the number of categories
        if (!empty($atts['limit'])) {
            $args['number'] = intval($atts['limit']);
        }

        $product_categories = get_terms($args);

        if ($product_categories) {
             $placeholder_image = wc_placeholder_img_src();
            foreach ($product_categories as $category) {
                // Get category thumbnail
                $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                $image = wp_get_attachment_url($thumbnail_id);
                $term_link = get_term_link($category);
                $category_name = esc_attr($category->name);

                // Use WooCommerce placeholder image if no image found
                if (empty($image)) {
                    $image = $placeholder_image;
                }

                ?>
                <div class="product-category-item">
                    <div class="product-inner">
                        <div class="woo-entry-image">
                            <a href="<?php echo $term_link; ?>" class="no-lightbox">
                                <img loading="lazy" decoding="async" src="<?php echo $image; ?>" alt="<?php echo $category_name; ?>" width="300" height="300">
                            </a>
                        </div>
                        <div class="woo-entry-inner">
                            <a href="<?php echo $term_link; ?>">
                                <h2 class="woocommerce-loop-category__title">
                                    <?php echo $category_name; ?>
                                    <?php if ($atts['show_count'] === 'yes') : ?>
                                        <mark class="count">(<?php echo $category_name; ?>)</mark>
                                    <?php endif; ?>
                                </h2>
                            </a>
                            <?php if ($atts['show_view_button'] === 'yes') : ?>
                                <div class="btn-wrap clr">
                                    <a href="<?php echo $term_link; ?>" aria-describedby="woocommerce_loop_category_<?php echo $category_name; ?>" class="button" rel="follow">View</a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>
    <style type="text/css">
        .product-category-item {
            text-align: center;
            border:1px solid lightgrey;
            border-radius:5px;
            background-color: #f5f7fd;
        }

        .product-category-item img {
           border-radius:5px;    
            margin-bottom: 10px;
        }
.woo-entry-image img{
    width:100%;
    height:250px;
    object-fit:cover;
}
        .product-category-item mark{
            background-color:rgba(0,0,0,0);
        }
        .product-category-item .button {
             margin-bottom: 10px;
     
                }
.product-category-item .woo-entry-inner a{text-decoration: none !important;}

        .owl-nav button {
          position: absolute;
          top: 30%;
          background-color: #000;
          color: #fff;
          margin: 0;
          transition: all 0.3s ease-in-out;
        }
        .owl-nav button.owl-prev {
          left: 0;
        }
        .owl-nav button.owl-next {
          right: 0;
        }
        .owl-nav button {
            position: absolute;
            top: 40%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.38) !important;
        }.owl-nav span {
            font-size: 50px;    
            position: relative;
        }
        .owl-nav button:focus {
            outline: none;
        }
        </style>

    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(".category-carousel").owlCarousel({
                loop: <?php echo $atts['loop']; ?>,
                autoplay: <?php echo $atts['autoplay']; ?>,
                margin: 10,
                autoplayHoverPause: true,
                responsiveClass: true,
                autoHeight: true,
                nav: <?php echo $atts['arrow']; ?>,
                dots: <?php echo $atts['dots']; ?>,
                responsive: {
                    0: {
                        items: <?php echo intval($atts['slides_phone']); ?>
                    },
                    600: {
                        items: <?php echo intval($atts['slides_tablet']); ?>
                    },
                    1000: {
                        items: <?php echo intval($atts['slides_desktop']); ?>
                    }
                }
            });
        });
    </script>

    <?php
    return ob_get_clean();
}
add_shortcode('category_carousel', 'category_carousel_shortcode');
?>
