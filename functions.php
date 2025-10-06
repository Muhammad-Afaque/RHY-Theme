<?php
/**
 * defense functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package defense
 */

if (!defined('_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function defense_setup()
{
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on defense, use a find and replace
     * to change 'defense' to the name of your theme in all the template files.
     */
    load_theme_textdomain('defense', get_template_directory() . '/languages');

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support('title-tag');

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(
        array(
            'menu-1' => esc_html__('Primary', 'defense'),
        )
    );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );

    // Set up the WordPress core custom background feature.
    add_theme_support(
        'custom-background',
        apply_filters(
            'defense_custom_background_args',
            array(
                'default-color' => 'ffffff',
                'default-image' => '',
            )
        )
    );

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Add support for core custom logo.
     *
     * @link https://codex.wordpress.org/Theme_Logo
     */
    add_theme_support(
        'custom-logo',
        array(
            'height' => 250,
            'width' => 250,
            'flex-width' => true,
            'flex-height' => true,
        )
    );
}

add_action('after_setup_theme', 'defense_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function defense_content_width()
{
    $GLOBALS['content_width'] = apply_filters('defense_content_width', 640);
}

add_action('after_setup_theme', 'defense_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function defense_widgets_init()
{
    register_sidebar(
        array(
            'name' => esc_html__('Sidebar', 'defense'),
            'id' => 'sidebar-1',
            'description' => esc_html__('Add widgets here.', 'defense'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        )
    );
}

add_action('widgets_init', 'defense_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function defense_enqueue_assets() {
    $theme_uri  = get_template_directory_uri();
    $theme_path = get_template_directory();

    // --- Styles ---
    wp_enqueue_style('bootstrap-css', $theme_uri . '/assets/bootstrap-5.2.3-dist/css/bootstrap.min.css', array(), '5.2.3');
    wp_enqueue_style('fancybox-css', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.css', array(), '3.3.5');
    wp_enqueue_style('slick-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', array(), '1.8.1');
	wp_enqueue_style('font-awesome-css', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css?ver=11', array(), '6.6.0');

    // Theme style.css (after base styles)
    wp_enqueue_style('defense-style', get_stylesheet_uri(), array('bootstrap-css', 'slick-css'), filemtime($theme_path . '/style.css'));
    wp_style_add_data('defense-style', 'rtl', 'replace');

    // --- Scripts ---

    // Load WP core jQuery FIRST (very important)
    wp_enqueue_script('jquery');

    // Now load dependent scripts
    wp_enqueue_script('bootstrap-js', $theme_uri . '/assets/bootstrap-5.2.3-dist/js/bootstrap.bundle.min.js', array('jquery'), '5.2.3', true);
    wp_enqueue_script('fancybox-js', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.js', array('jquery'), '3.3.5', true);
    wp_enqueue_script('slick-js', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), '1.8.1', true);
    wp_enqueue_script('jquery-cookie', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js', array('jquery'), '1.4.1', true);

    // Custom theme JS (loaded last)
	//wp_enqueue_script('defense-search-enhancement', $theme_uri . '/assets/js/search-enhancement.js', array('jquery'), filemtime($theme_path . '/assets/js/search-enhancement.js'), true);
	wp_enqueue_script('defense-custom', $theme_uri . '/assets/js/custom.js', array('jquery'), filemtime($theme_path . '/assets/js/custom.js'), true);

    // Threaded comments (optional)
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'defense_enqueue_assets');




/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}

// Method 1: Add SKU, slug, and post type to title
add_filter('acf/fields/post_object/result', function ($title, $post, $field, $post_id) {
    // Get SKU
    $sku = get_post_meta($post->ID, 'sku', true);

    // Get post slug
    $slug = $post->post_name;

    // Get post type label
    $post_type_obj = get_post_type_object($post->post_type);
    $post_type_label = $post_type_obj->labels->singular_name;

    // Build the display string
    $display_parts = [];

    if ($sku) {
        $display_parts[] = $sku;
    }

    if ($slug) {
        $display_parts[] = $slug;
    }

    // Add post type
    $display_parts[] = $post_type_label;

    // Append all information to title
    if (!empty($display_parts)) {
        $title .= ' (' . implode(' | ', $display_parts) . ')';
    }

    return $title;
}, 10, 4);

// Method 2: Group posts by post type in ACF field
add_filter('acf/fields/post_object/query', function ($args, $field, $post_id) {
    // Modify the query to group by post type
    $args['orderby'] = 'post_type title';

    return $args;
}, 10, 3);

// Optional: Add custom styling to differentiate post types
add_action('admin_head', function () {
    ?>
    <style>
        .select2-results__group {
            background: #f0f0f0;
            font-weight: bold;
            padding: 5px !important;
        }
    </style>
    <?php
});


function category_breadcrumbs($taxonomyURL)
{
    $separator = ' <i class="fa-solid fa-chevron-right"></i> ';
    $home_title = 'Home';

    echo '<ul class="breadcrumbs">';
    echo '<li><a href="' . get_site_url() . '">' . $home_title . '</a></li>';

    if (is_archive()) {
        $current_category = get_queried_object();
        $ancestors = get_ancestors($current_category->term_id, $taxonomyURL);
        $ancestors = array_reverse($ancestors);

        foreach ($ancestors as $ancestor) {
            $ancestor_category = get_term($ancestor, $taxonomyURL);
            echo '<li>' . $separator . '</li>';
            echo '<li><a href="' . get_term_link($ancestor_category) . '">' . $ancestor_category->name . '</a></li>';
        }

        echo '<li>' . $separator . '</li>';
        echo '<li>' . single_cat_title('', false) . '</li>';
    }

    echo '</ul>';
}

function categories_list($post_id)
{
    $separator = ' - ';

    if (is_archive()) {
        $current_category = get_queried_object();

        $ancestors = get_ancestors($current_category->term_id, 'product-category');

        $ancestors = array_reverse($ancestors);

        foreach ($ancestors as $ancestor) {
            $ancestor_category = get_term($ancestor, 'product-category');
            echo $ancestor_category->name . $separator;
        }

        echo single_cat_title('', false);
    }
}

function display_taxonomy_hierarchy($taxonomy, $parent = 0)
{
    $terms = get_terms([
        'taxonomy' => $taxonomy,
        'parent' => $parent,
        'hide_empty' => false,
    ]);

    // print_r();

    if (!empty($terms) && !is_wp_error($terms)) {
        echo '<ul class="">';
        foreach ($terms as $term) {
            echo '<li><label for="' . $term->slug . '"><input type="checkbox" value="' . $term->slug . '" name="' . $term->taxonomy . '[]" id="' . $term->slug . '" term-name="' . $term->name . '" />' . $term->name . '</label></li>';
            display_taxonomy_hierarchy($taxonomy, $term->term_id);
        }
        echo '</ul>';
    }
}


function email_ftn()
{
    $errors = [];
    $data = [];
    $from = '';
    $first_name = isset($_POST['first_name']) ? sanitize_text_field($_POST['first_name']) : false;
    $last_name = isset($_POST['last_name']) ? sanitize_text_field($_POST['last_name']) : false;
    $user_email = isset($_POST['user_email']) ? filter_var($_POST['user_email'], FILTER_SANITIZE_EMAIL) : false;
    $user_phone = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : false;
    $user_company = isset($_POST['company']) ? sanitize_text_field($_POST['company']) : false;
    $comments = isset($_POST['comments']) ? sanitize_text_field($_POST['comments']) : false;
    $country = isset($_POST['country']) ? sanitize_text_field($_POST['country']) : false;
    $idz = isset($_POST['idz']) ? $_POST['idz'] : false;

    $to = $user_email;
    $subject = "Cart Form";

    $message = '';
    if (!empty($idz)) {
        $message .= product_card($idz);
    }
    if (!empty($user_name)) {
        $message .= "<strong></br>Name: </strong> " . $user_name;
    } else {
        $message .= "<strong></br>Name: </strong> " . $first_name . " " . $last_name;
    }
    if (!empty($user_email)) {
        $message .= "<strong></br>Email: </strong> " . $user_email;
    }
    if (!empty($user_phone)) {
        $message .= "<strong></br>Phone: </strong> " . $user_phone;
    }
    if (!empty($user_company)) {
        $message .= "<strong></br>Company: </strong> " . $user_company;
    }
    if (!empty($country)) {
        $message .= "<strong></br>Company: </strong> " . $country;
    }
    if (!empty($comments)) {
        $message .= "<strong></br>Message: </br></strong> " . $comments;
    }

    $header = "MIME-Version: 1.0\r\n";
    $header .= "Content-type: text/html\r\n";

    if (!empty($message)) {
        $retval = wp_mail($to, $subject, $message, $header);
    }

    if ($retval == true) {
        $data['success'] = true;
        $data['message'] = 'Email sent successfully!';
    }

    echo json_encode($data);
    die();
}

add_action('wp_ajax_email_ftn', 'email_ftn');
add_action('wp_ajax_nopriv_email_ftn', 'email_ftn');

function product_card($idz)
{
    ob_start();
    $list_products = $_COOKIE['list-product'];
    $list_products = stripslashes($list_products);
    $products = json_decode($list_products, true);

    $values = array_column($products, 'id');

    $counts = array_count_values($values);

    echo '<table style="margin: 0px auto;"><tbody><tr><th>Product Details</th><th>Qty</th></tr>';
    if (!empty($idz)) {
        foreach ($counts as $index => $product) {
            $post = get_post($index);
            $pn_number = get_field('pn_number', $post->ID);
            $mil_number = get_field('mil_number', $post->ID);
            $following_hose = get_field('following_hose', $post->ID);
            $following_hose_second = get_field('following_hose_second', $post->ID);
            $feature_image = get_the_post_thumbnail_url($post);
            ?>
            <tr class="product-wrapper">
                <td>
                    <div class="pc_Img">
                        <img src="<?php echo $feature_image; ?>" alt="">
                    </div>
                    <div style="margin-left: 25%" class=" my-auto text-left">
                        <?php
                        if ($pn_number) {
                            echo '<p>' . $pn_number . '</p>';
                        }

                        echo '<p>';
                        categories_list($post->ID);
                        echo '</p>';
                        if ($mil_number) {
                            echo '<h6>' . $mil_number . '</h6>';
                        }

                        if ($following_hose) {
                            echo '<p><strong>Use with the following hose:</strong>' . $following_hose . '</p>';
                        }
                        if ($following_hose_second) {
                            echo '<p>' . $following_hose_second . '</p>';
                        }
                        ?>
                    </div>
                </td>
                <td>
                    <?php echo $product; ?>
                </td>
            </tr>
            <?php
        }
    }
    echo '</tbody></table>';
    $content = ob_get_contents();
    ob_clean();
    return $content;
}


// Allow SVG
add_filter('wp_check_filetype_and_ext', function ($data, $file, $filename, $mimes) {

    global $wp_version;
    if ($wp_version !== '4.7.1') {
        return $data;
    }

    $filetype = wp_check_filetype($filename, $mimes);

    return [
        'ext' => $filetype['ext'],
        'type' => $filetype['type'],
        'proper_filename' => $data['proper_filename']
    ];

}, 10, 4);

function cc_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}

add_filter('upload_mimes', 'cc_mime_types');

function fix_svg()
{
    echo '<style type="text/css">
		  .attachment-266x266, .thumbnail img {
			   width: 100% !important;
			   height: auto !important;
		  }
		  </style>';
}

add_action('admin_head', 'fix_svg');
function add_woocommerce_support() {
    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'add_woocommerce_support');




// function df_include_cpts_in_search( $query ) {
//     if (
//         $query->is_search()              // we’re on a search results page
//         && $query->is_main_query()       // and it’s the main query
//         && ! is_admin()                  // not in the admin dashboard
//     ) {
//         $query->set( 'post_type', [
//             'product',
//             'hydrasearch',
//         ] );
//     }
// }
// add_action( 'pre_get_posts', 'df_include_cpts_in_search' );
// /**
//  * On 'collection' taxonomy archives, show product-posts at 9 per page.
//  */
// function hs_collection_pagination( $query ) {
//     if (
//         ! is_admin()
//         && $query->is_main_query()
//         && is_tax( 'collection' )
//     ) {
//         $query->set( 'post_type', 'product' );
//         $query->set( 'posts_per_page', 15 );
//     }
// }
// add_action( 'pre_get_posts', 'hs_collection_pagination' );
// /**
//  * Modify main query on search results page.
//  */
// function hs_search_results_pagination( $query ) {
//     if (
//         ! is_admin()
//         && $query->is_main_query()
//         && is_search()
//     ) {
//         $query->set( 'post_type', [ 'product', 'hydrasearch' ] );
//         $query->set( 'posts_per_page', 15 ); // Or any number you prefer
//     }
// }
// add_action( 'pre_get_posts', 'hs_search_results_pagination' );
///////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////




function hydra_get_customer_id($user_id = null) {
    if (!$user_id) {
        $user_id = get_current_user_id();
    }
    
    if (!$user_id) {
        return null;
    }
    
    // Try to get existing customer ID
    $customer_id = get_user_meta($user_id, 'customer_number', true);
    
    if (!empty($customer_id)) {
        return $customer_id;
    }
    
    // Generate new customer ID
    $user = get_userdata($user_id);
    $user_roles = $user->roles;
    
    // Determine prefix based on role
    if (in_array('administrator', $user_roles)) {
        $prefix = 'A';
        $category = 'ADMIN';
    } elseif (in_array('distributor', $user_roles) || in_array('distributor_admin', $user_roles)) {
        $prefix = 'D';
        $category = 'DIST';
    } elseif (in_array('wholesale_customer', $user_roles)) {
        $prefix = 'W';
        $category = 'WHOLE';
    } else {
        $prefix = 'B';
        $category = 'BUYER';
    }
    
    // Create unique ID
    $timestamp = substr(time(), -4); // Last 4 digits of timestamp
    $customer_id = $prefix . date('y') . $timestamp . str_pad($user_id, 3, '0', STR_PAD_LEFT);
    
    // Save for future use
    update_user_meta($user_id, 'customer_number', $customer_id);
    update_user_meta($user_id, 'customer_category', $category);
    
    return $customer_id;
}

$customer_id = hydra_get_customer_id($current_user->ID);


# Emergency password reset - REMOVE after login works
function emergency_password_reset() {
    if (isset($_GET['emergency_reset']) && $_GET['emergency_reset'] === 'hydra2024') {
        require_once(ABSPATH . 'wp-includes/pluggable.php');
        $user_id = username_exists('Marketaspex_admin');
        if ($user_id) {
            wp_set_password('P13dm0nt_123', $user_id);
            echo "Password reset for Marketaspex_admin! Remove this code immediately.";
            exit;
        }
    }
}
add_action('wp_loaded', 'emergency_password_reset');


// 
// // Add a new setting in wp-admin > Settings > General
add_action( 'admin_init', function() {
   register_setting( 'general', 'custom_heartbeat_interval', 'intval' );
   add_settings_field( 'custom_heartbeat_interval', 'Heartbeat Interval', function() {
       $interval = get_option( 'custom_heartbeat_interval', 120 );
       echo "<input type='number' name='custom_heartbeat_interval' value='".absint($interval)."' min='15' max='120' /> seconds";
   }, 'general' );
});
 
add_filter( 'heartbeat_settings', function( $settings ) {
   $settings['interval'] = get_option( 'custom_heartbeat_interval', 120 );
   return $settings;
});
add_action('acf/save_post', 'copy_acf_sku_to_woocommerce_sku', 20);
function copy_acf_sku_to_woocommerce_sku($post_id) {
    // Skip if this is not a product
    if (get_post_type($post_id) !== 'product') return;

    // Avoid infinite loops
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    // Get the ACF field value (adjust the field name if needed)
    $acf_sku = get_field('sku', $post_id);

    if (!empty($acf_sku)) {
        // Update the WooCommerce SKU meta
        update_post_meta($post_id, '_sku', sanitize_text_field($acf_sku));
    }
}



// add_action('admin_menu', 'move_addify_quotes_under_woocommerce', 999);

// function move_addify_quotes_under_woocommerce() {
//     // Remove the default Quotes menu
//     remove_menu_page('edit.php?post_type=addify_quote');

//     // Add it under WooCommerce menu
//    add_submenu_page(
//     'woocommerce',
//     'B2B Quotes',
//     'Quotes',
//     'manage_woocommerce',
//     'edit.php?post_type=addify_quote'
// );
// }

// Reorder WooCommerce submenu to move Quotes under Orders
// add_filter('custom_menu_order', '__return_true');
// add_filter('menu_order', 'reorder_woocommerce_submenu');

// function reorder_woocommerce_submenu($menu_order) {
//     global $submenu;

//     if (!isset($submenu['woocommerce'])) return $menu_order;

//     $woo_menu = &$submenu['woocommerce'];

//     // Move "Quotes" to directly after "Orders"
//     $quotes = [];
//     foreach ($woo_menu as $key => $item) {
//         if (strpos($item[2], 'post_type=addify_quote') !== false) {
//             $quotes = $item;
//             unset($woo_menu[$key]);
//             break;
//         }
//     }

//     $new_menu = [];
//     foreach ($woo_menu as $item) {
//         $new_menu[] = $item;
//         if ($item[2] === 'edit.php?post_type=shop_order') {
//             $new_menu[] = $quotes; // Insert after Orders
//         }
//     }

//     $submenu['woocommerce'] = $new_menu;

//     return $menu_order;
// }

function escape_elementor_html_from_description( $content ) {
    // Only apply to short description area or wherever you're outputting
    if ( is_product() ) {
        // Match and escape only Elementor elements
        $pattern = '/<div[^>]class="[^"]*elementor-[^"]"[^>]>.?<\/div>/si';

        $escaped_content = preg_replace_callback( $pattern, function( $matches ) {
            return htmlspecialchars( $matches[0], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8' );
        }, $content );

        return $escaped_content;
    }

    return $content;
}

add_filter( 'woocommerce_short_description', 'escape_elementor_html_from_description', 20 );

add_action('init', function () {
    load_plugin_textdomain('woocommerce-gateway-purchase-order', false, dirname(plugin_basename(__FILE__)) . '/languages');
});


function wp_is_tablet() {
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $is_tablet = preg_match('/iPad|Android(?!.*Mobile)|Tablet|PlayBook|Silk/i', $user_agent);
    return $is_tablet;
}

add_filter('woocommerce_add_to_cart_fragments', function ($fragments) {
    ob_start(); ?>
    <span class="cart-count">
        <?php 
        $count = WC()->cart ? WC()->cart->get_cart_contents_count() : 0;
        echo $count > 0 ? $count : ''; 
        ?>
    </span>
    <?php
    $fragments['span.cart-count'] = ob_get_clean();
    return $fragments;
});


add_action('admin_init', function () {
  if (defined('DOING_AJAX') && DOING_AJAX) {
    register_shutdown_function(function () {
      $e = error_get_last();
      if ($e && in_array($e['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])) {
        error_log('AJAX FATAL >>> '. print_r($e, true));
      }
    });
  }
});


/**
 * Show distributor-only fields on Edit Account page for specific roles.
 */
add_action( 'wp_head', function () {
    if ( ! is_user_logged_in() ) {
        return;
    }

    // Only run on "My Account → Edit Account" page
    if ( ! ( is_account_page() && is_wc_endpoint_url( 'edit-account' ) ) ) {
        return;
    }

    // Current user roles
    $user       = wp_get_current_user();
    $user_roles = (array) $user->roles;

    // Allowed roles - adjust if your slugs differ
    $allowed_roles = [ 'c1_distributor', 'c2_distributor', 'c3_distributor' ];

    // Check if user has one of the roles
    if ( array_intersect( $allowed_roles, $user_roles ) ) {
        ?>
        <style>
			.afreg_extra_fields h3{color:#000;}
            #afreg_additionalshowhide_10603,
            #afreg_additionalshowhide_10604 {
                display: block !important;
            }
        </style>
        <?php
    }
});


// Auto set alt text to filename if empty
add_filter('wp_get_attachment_image_attributes', 'auto_set_image_alt_from_filename', 10, 2);

function auto_set_image_alt_from_filename($attr, $attachment) {
    // If alt is empty
    if (empty($attr['alt'])) {
        // Get the file name
        $file = get_attached_file($attachment->ID);
        $filename = pathinfo($file, PATHINFO_FILENAME);

        // Replace dashes/underscores with spaces
        $alt_text = str_replace(['-', '_'], ' ', $filename);

        $attr['alt'] = $alt_text;
    }
    return $attr;
}






