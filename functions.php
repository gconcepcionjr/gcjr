<?php
/*
 *  Author: Todd Motto | @toddmotto hello
 *  URL: html5blank.com | @html5blank
 *  Custom functions, support, custom post types and more.
 */

/*------------------------------------*\
	External Modules/Files
\*------------------------------------*/

require_once "inc/Mobile_Detect.php";

require_once "edit-carousel/edit-carousel.php";

/*------------------------------------*\
	Theme Support
\*------------------------------------*/

if (!isset($content_width))
{
    $content_width = 900;
}

if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
//    add_image_size('large', 700, '', true); // Large Thumbnail

//    add_image_size('small', 120, '', true); // Small Thumbnail
//    add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

    add_image_size('medium', 420, 241, true); // Medium Thumbnail

    add_image_size('big_stick_post', 579, 332, true); // home page
    add_image_size('regular_stick_post', 287, 165, true); // home page

    add_image_size('thumbnail_latest_news', 147, 88, true); // home page latest news

    add_image_size('thumbnail_reviews', 168, 96, true); // home page latest reviews

    add_image_size('sidebar_thumbnail', 81, 70, true); // sidebar images

    add_image_size('cbd_reviews_thumbnail', 270, 155, true); // sidebar images

   // add_image_size('main_post_image', 800, 534, true);


    // Add Support for Custom Backgrounds - Uncomment below if you're going to use
    /*add_theme_support('custom-background', array(
	'default-color' => 'FFF',
	'default-image' => get_template_directory_uri() . '/img/bg.jpg'
    ));*/

    // Add Support for Custom Header - Uncomment below if you're going to use
    /*add_theme_support('custom-header', array(
	'default-image'			=> get_template_directory_uri() . '/img/headers/default.jpg',
	'header-text'			=> false,
	'default-text-color'		=> '000',
	'width'				=> 1000,
	'height'			=> 198,
	'random-default'		=> false,
	'wp-head-callback'		=> $wphead_cb,
	'admin-head-callback'		=> $adminhead_cb,
	'admin-preview-callback'	=> $adminpreview_cb
    ));*/

    // Enables post and comment RSS feed links to head
//    add_theme_support('automatic-feed-links');

    // Localisation Support
    // load_theme_textdomain('html5blank', get_template_directory() . '/languages');

    add_theme_support('soil-clean-up');
//    add_theme_support('soil-disable-rest-api');
    add_theme_support('soil-disable-asset-versioning');
//    add_theme_support('soil-jquery-cdn');
    add_theme_support('soil-js-to-footer');
}

/*------------------------------------*\
	Functions
\*------------------------------------*/

// HTML5 Blank navigation
function html5blank_nav()
{
	wp_nav_menu(
	array(
		'theme_location'  => 'header-menu',
		'menu'            => '',
		'container'       => 'div',
		'container_class' => 'menu-{menu slug}-container',
		'container_id'    => '',
		'menu_class'      => 'menu',
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul>%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
		)
	);
}

// Load HTML5 Blank scripts (header.php)
function html5blank_header_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

//    	wp_register_script('conditionizr', get_template_directory_uri() . '/assets/js/lib/conditionizr-4.3.0.min.js', array(), '4.3.0'); // Conditionizr
//        wp_enqueue_script('conditionizr'); // Enqueue it!
//
//        wp_register_script('modernizr', get_template_directory_uri() . '/assets/js/lib/modernizr-2.7.1.min.js', array(), '2.7.1'); // Modernizr
//        wp_enqueue_script('modernizr'); // Enqueue it!


        wp_register_script('slick-js', get_template_directory_uri() . '/edit-carousel/slick/slick.min.js', array('jquery'), '1.0.0'); // Custom scripts
        wp_enqueue_script('slick-js'); // Enqueue it!

        wp_register_script('html5blankscripts', get_template_directory_uri() . '/assets/js/scripts.js', array('jquery'), '1.0.0'); // Custom scripts
        wp_enqueue_script('html5blankscripts'); // Enqueue it!
    }
}

// Load HTML5 Blank conditional scripts
function html5blank_conditional_scripts()
{
    if (is_single()) {

        wp_register_script('html5star', 'https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js', array('jquery'), '1.0.0'); // Custom scripts
        wp_enqueue_script('html5star'); // Enqueue it!

        wp_register_style('html5starcss', 'https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css', array(), '1.0', 'all');
        wp_enqueue_style('html5starcss'); // Enqueue it!

    }
}

// Load HTML5 Blank styles
function html5blank_styles()
{

    $detect = new Mobile_Detect;

    if ( $detect->isMobile() && (!$detect->isTablet()) ) {

//        wp_register_style('html5blank', get_template_directory_uri() . '/assets/css/style.min.css', array(), '1.0', 'all');
//        wp_enqueue_style('html5blank'); // Enqueue it!

    }else{

        wp_register_style('bootstrap-grid', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap-grid.min.css', '', '1.0', 'all');
        wp_enqueue_style('bootstrap-grid'); // Enqueue it!

        wp_register_style('html5blank', get_template_directory_uri() . '/assets/css/style.min.css', array('bootstrap-grid'), '1.0', 'all');
        wp_enqueue_style('html5blank'); // Enqueue it!

        wp_register_style('slick-css', get_template_directory_uri() .'/edit-carousel/slick/slick.css', array(), '1.0', 'all');
        wp_enqueue_style('slick-css'); // Enqueue it!

        wp_register_style('slick-theme-css', get_template_directory_uri() .'/edit-carousel/slick/slick-theme.css', array(), '1.0', 'all');
        wp_enqueue_style('slick-theme-css'); // Enqueue it!

    }

}

// Register HTML5 Blank Navigation
function register_html5_menu()
{
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', 'html5blank'), // Main Navigation
        'sidebar-menu' => __('Sidebar Menu', 'html5blank'), // Sidebar Navigation
        'extra-menu' => __('Extra Menu', 'html5blank') // Extra Navigation if needed (duplicate as many as you need!)
    ));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

// Add device type to body class
function device_type_to_body_class( $classes ) {

    $detect = new Mobile_Detect;

    if ( $detect->isMobile() && (!$detect->isTablet()) ) {
        $classes[] = 'device_type_mobile';
    }else{
        $classes[] = 'device_type_desktop';
    }

    return $classes;
}

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
    register_sidebar(array(
        'name' => __('FOOTER: WEBSITE INFO', 'html5blank'),
        'description' => __('', 'html5blank'),
        'id' => 'cbd-website-info',
        'before_widget' => '<div id="%1$s" class="%2$s col-sm-6 col-md-3 footer-menu_wrapper">',
        'after_widget' => '</div>',
        'before_title' => '<div class="footer-menu_title">',
        'after_title' => '</div>'
    ));

    register_sidebar(array(
        'name' => __('FOOTER: NEWS', 'html5blank'),
        'description' => __('', 'html5blank'),
        'id' => 'cbd-news',
        'before_widget' => '<div id="%1$s" class="%2$s col-sm-6 col-md-3 footer-menu_wrapper">',
        'after_widget' => '</div>',
        'before_title' => '<div class="footer-menu_title">',
        'after_title' => '</div>'
    ));

    register_sidebar(array(
        'name' => __('FOOTER: PRODUCT REVIEWS', 'html5blank'),
        'description' => __('', 'html5blank'),
        'id' => 'cbd-product-reviews',
        'before_widget' => '<div id="%1$s" class="%2$s col-sm-6 col-md-3 footer-menu_wrapper">',
        'after_widget' => '</div>',
        'before_title' => '<div class="footer-menu_title">',
        'after_title' => '</div>'
    ));

    register_sidebar(array(
        'name' => __('FOOTER: GET IN TOUCH', 'html5blank'),
        'description' => __('', 'html5blank'),
        'id' => 'cbd-get-in-touch',
        'before_widget' => '<div id="%1$s" class="%2$s col-sm-6 col-md-3 footer-menu_wrapper">',
        'after_widget' => '</div>',
        'before_title' => '<div class="footer-menu_title">',
        'after_title' => '</div>'
    ));
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function html5wp_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages,
        'type' => 'list'
    ));
}

// Custom Excerpts
function html5wp_index($length) // Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
{
    return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function html5wp_custom_post($length)
{
    return 40;
}

// Create the Custom Excerpts callback
function html5wp_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

// Custom View Article link to Post
function html5_blank_view_article($more)
{
    global $post;
    return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'html5blank') . '</a>';
}

// Remove Admin bar
function remove_admin_bar()
{
    return false;
}

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// Custom Gravatar in Settings > Discussion
function html5blankgravatar ($avatar_defaults)
{
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments()
{
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}

// Custom Comments Callback
function html5blankcomments($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
    <!-- heads up: starting < for the html tag (li or div) in the next line: -->
    <<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
	<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['180'] ); ?>
	<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
	</div>
<?php if ($comment->comment_approved == '0') : ?>
	<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
	<br />
<?php endif; ?>

	<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
		<?php
			printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
		?>
	</div>

	<?php comment_text() ?>

	<div class="reply">
	<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php }

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'html5blank_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_print_scripts', 'html5blank_conditional_scripts'); // Add Conditional Page Scripts
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'html5blank_styles'); // Add Theme Stylesheet
add_action('init', 'register_html5_menu'); // Add HTML5 Blank Menu
add_action('init', 'create_post_type_html5'); // Add our HTML5 Blank Custom Post Type
add_action('init', 'create_post_type_coupon');
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'html5wp_pagination'); // Add our HTML5 Pagination

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('avatar_defaults', 'html5blankgravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('body_class', 'device_type_to_body_class' ); // Add device type to body class
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'html5_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

// Shortcodes
add_shortcode('html5_shortcode_demo', 'html5_shortcode_demo'); // You can place [html5_shortcode_demo] in Pages, Posts now.
add_shortcode('html5_shortcode_demo_2', 'html5_shortcode_demo_2'); // Place [html5_shortcode_demo_2] in Pages, Posts now.

// Shortcodes above would be nested like this -
// [html5_shortcode_demo] [html5_shortcode_demo_2] Here's the page title! [/html5_shortcode_demo_2] [/html5_shortcode_demo]

/*------------------------------------*\
	Custom Post Types
\*------------------------------------*/

// Create 1 Custom Post type for a Demo, called HTML5-Blank
function create_post_type_html5()
{
//    register_taxonomy_for_object_type('category', 'html5-blank'); // Register Taxonomies for Category
    register_taxonomy_for_object_type('post_tag', 'trusted-brand');
    register_post_type('trusted-brand', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Trusted Brand', 'html5blank'), // Rename these to suit
            'singular_name' => __('Trusted Brand', 'html5blank'),
            'add_new' => __('Add New', 'html5blank'),
            'add_new_item' => __('Add New Trusted Brand', 'html5blank'),
            'edit' => __('Edit', 'html5blank'),
            'edit_item' => __('Edit Trusted Brand', 'html5blank'),
            'new_item' => __('New Trusted Brand', 'html5blank'),
            'view' => __('View Trusted Brand', 'html5blank'),
            'view_item' => __('View Trusted Brand', 'html5blank'),
            'search_items' => __('Search Trusted Brand', 'html5blank'),
            'not_found' => __('No Trusted Brands found', 'html5blank'),
            'not_found_in_trash' => __('No Trusted Brands found in Trash', 'html5blank')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'supports' => array(
            'title',
            'editor',
//            'excerpt',
            'author',
            'thumbnail'
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
            'post_tag'
//            'category'
        ) // Add Category and Post Tags support
    ));
}

// Create Custom Post type coupon
function create_post_type_coupon()
{
//    register_taxonomy_for_object_type('category', 'html5-blank'); // Register Taxonomies for Category
    // register_taxonomy_for_object_type('post_tag', 'trusted-brand');
    register_post_type('cbd-coupon', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Coupon', 'html5blank'), // Rename these to suit
            'singular_name' => __('Coupon', 'html5blank'),
            'add_new' => __('Add New', 'html5blank'),
            'add_new_item' => __('Add New Coupon', 'html5blank'),
            'edit' => __('Edit', 'html5blank'),
            'edit_item' => __('Edit Coupon', 'html5blank'),
            'new_item' => __('New Coupon', 'html5blank'),
            'view' => __('View Coupon', 'html5blank'),
            'view_item' => __('View Coupon', 'html5blank'),
            'search_items' => __('Search Coupon', 'html5blank'),
            'not_found' => __('No Coupons found', 'html5blank'),
            'not_found_in_trash' => __('No Coupons found in Trash', 'html5blank')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'rewrite' => array(
            'slug' => 'cbd-coupons'
        ),
        'supports' => array(
            'title',
            'editor',
//            'excerpt',
            'author',
            'thumbnail'
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
            // 'post_tag'
//            'category'
        ) // Add Category and Post Tags support
    ));
}

/*------------------------------------*\
	ShortCode Functions
\*------------------------------------*/


function custom_dequeue(){

    wp_dequeue_style( 'wp-block-library' );
    wp_deregister_style( 'dashicons' );

//    wp_dequeue_style( 'tcm-front-styles-css' );
//    wp_deregister_style( 'tcm-front-styles-css' );

}

add_action( 'wp_enqueue_scripts', 'custom_dequeue', 9999 );
add_action( 'wp_head', 'custom_dequeue', 9999 );

function my_deregister_javascript(){

//    $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
//
//    if ($actual_link != 'https://thecbdinsider.com/contact/'){
//
//        wp_dequeue_script('google-recaptcha');
//        wp_deregister_script('google-recaptcha');
//
//        wp_dequeue_script('contact-form-7');
//        wp_deregister_script('contact-form-7');
//
//    }

}

add_action( 'wp_print_scripts', 'my_deregister_javascript', 100 );


// Shortcode Demo with Nested Capability
function html5_shortcode_demo($atts, $content = null)
{
    return '<div class="shortcode-demo">' . do_shortcode($content) . '</div>'; // do_shortcode allows for nested Shortcodes
}

// Shortcode Demo with simple <h2> tag
function html5_shortcode_demo_2($atts, $content = null) // Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
{
    return '<h2>' . $content . '</h2>';
}

add_action('wp_ajax_cbd_load_data', 'func_cbd_load_data');
add_action('wp_ajax_nopriv_cbd_load_data', 'func_cbd_load_data');

function func_cbd_load_data(){

    $data = $_POST["cbd_type_data"];

    $category_id = -1;
    $post_id = -1;
    $search_keyword = "";

    if( $data == "trusted_brands" ){

        $list_v = $_POST["list_v"];

        if($list_v=="v1"){
            get_template_part('template-parts/trusted-brands');
        }
        else if($list_v=="v2"){
            get_template_part('template-parts/trusted-brands-v2');
        }

//        include( locate_template( 'template-parts/trusted_brands.php', false, false ) );

    }

    if($data == "search_posts"){

        if( isset($_POST["search_keyword"]) && (!empty($_POST["search_keyword"])) ){
            $search_keyword = htmlspecialchars($_POST["search_keyword"]);
        }

        include( locate_template( 'template-parts/search-posts.php', false, false ) );

    }

    if($data == "home_latest_news"){


        if( isset($_POST["category_id"]) && (!empty($_POST["category_id"])) ){
            $category_id = $_POST["category_id"];
        }

        include( locate_template( 'template-parts/home-latest-news.php', false, false ) );

    }

    if (strpos($data, 'archived_posts__') !== false) {

        $post_id = (int)explode("__", $data)[1];

        include( locate_template( 'template-parts/archive-post.php', false, false ) );

    }

    if($data == "home_reviews"){


        get_template_part('template-parts/reviews');

    }

    if($data == "home_trusted_brands"){

        get_template_part('template-parts/trusted-brands-home');
    }

    if($data == "home_grid_gallery"){

        get_template_part('template-parts/grid-gallery');;

    }

    if($data == "home_sidebar"){

    ?>

        <?php get_sidebar('single-review'); ?>
        <?php get_sidebar('latest-posts'); ?>
        <?php get_sidebar('popular-posts'); ?>

        <!--div class="sidebar_ad-banner-bottom">
            <div data-mantis-zone="sidebar"></div>
        </div-->

    <?php

    }

    if (strpos($data, 'single_content_') !== false) {

        $index_post_id = explode("single_content_", $data)[1];

        $index   = (int)explode("__", $index_post_id)[0];
        $post_id = (int)explode("__", $index_post_id)[1];

        if( $index === 0 ){

            $content = apply_filters('the_content', get_post_field('post_content', $post_id));

        }else{

            $rows = get_field( 'load_content_while_scrolling', $post_id ); // get all the rows

            $first_row = $rows[$index-1]; // get the first row
            $content = $first_row['load_content_part' ]; // get the sub field value

        }

        echo $content;

    }

    wp_die();

}

function ads_code_func( $atts ) {

    $adsID = intval( $atts['id'] );
    $postID = get_the_ID();
    $detect = new Mobile_Detect;
    $code="";

    if( have_rows('ads_code_list', $postID) ):

        if( $detect->isMobile() && !$detect->isTablet() ){
            $code .= get_field( 'ads_code_list', $postID ) [ $adsID - 1] [ 'mobile_ads_code' ];
        }else{
            $code .= get_field( 'ads_code_list', $postID ) [ $adsID - 1] [ 'ads_code' ];
        }

    endif;

    return $code;
}

add_shortcode( 'ads_code', 'ads_code_func' );



function compare_products_func( $atts ) {

    $postID = get_the_ID();

    $code="<div class='compare_products_wrap'>";

    if( have_rows('compare_products', $postID) ):

        while ( have_rows('compare_products', $postID) ) : the_row();

            $code .= "<div class='compare_product_item'>";
            $code .= "<div class='compare_product_image'><img src='".get_sub_field('image')."'/></div>";
            $code .= "<div class='compare_product_title'>".get_sub_field('title')."</div>";
            $code .= "<div class='compare_product_product_name'>".get_sub_field('product_name')."</div>";
            $code .= "<div class='compare_product_brand_name'>".get_sub_field('brand_name')."</div>";
            $code .= "<div class='compare_product_learn_more'><a href='".get_sub_field('learn_more')."'>Learn More</a></div>";
            $code .= "</div>";

        endwhile;

    endif;

    $code .= "</div>";

    return $code;
}

add_shortcode( 'compare_products', 'compare_products_func' );


function check__head_request(){

//    if (strpos($_SERVER['HTTP_USER_AGENT'], "Chrome-Lighthouse") !== false)
//    {
//        mail("nikolaymul@gmail.com","HTTP_USER_AGENT",$_SERVER['HTTP_USER_AGENT']);
//        return true;
//    }
//    else
//    {
//        mail("nikolaymul@gmail.com","HTTP_USER_AGENT",$_SERVER['HTTP_USER_AGENT']);
//        return false;
//    }

}


function wpb_track_post_views ($post_id) {
    if ( !is_single() ) return;
    if ( empty ( $post_id) ) {
        global $post;
        $post_id = $post->ID;
    }
    wpb_set_post_views($post_id);
}
add_action( 'wp_head', 'wpb_track_post_views');

function wpb_set_post_views($postID) {
    $count_key = 'all_views';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

add_action('wp_ajax_get_share_count', 'get_share_count');
add_action('wp_ajax_nopriv_get_share_count', 'get_share_count');

/**
 *
 */
function get_share_count(){

    $url = $_POST['url'];

    $remote_args = array(
        'sslverify' => false
    );

    // Facebook
    $remote_facebook = wp_remote_get( 'http://graph.facebook.com/?fields=og_object{id},share&id=' . $url, $remote_args );
    if ( ! is_wp_error( $remote_facebook ) ) {
        $response_facebook = json_decode( wp_remote_retrieve_body( $remote_facebook ), true );
        if ( isset( $response_facebook['share']['share_count'] ) ) {
            $facebook_shares = $response_facebook['share']['share_count'];
        }
    }

//     	// Google Plus
    $post_data = '[{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"' . rawurldecode( $url ) . '","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]';

    $remote_google = wp_remote_post( 'https://clients6.google.com/rpc', array(
        'body'      => $post_data,
        'headers'   => 'Content-type: application/json',
        'sslverify' => false,
    ) );

    if ( ! is_wp_error( $remote_google ) ) {

        $response_google = json_decode( wp_remote_retrieve_body( $remote_google ), true );

        if ( isset( $response_google[0]['result']['metadata']['globalCounts']['count'] ) ) {
            $google_shares = $response_google[0]['result']['metadata']['globalCounts']['count'];
        }

    }

//     	//Linkedin
    $remote_linkedin = wp_remote_get( 'https://www.linkedin.com/countserv/count/share?format=json&url=' . $url, $remote_args );

    if ( ! is_wp_error( $remote_linkedin ) ) {

        $response_linkedin = json_decode( wp_remote_retrieve_body( $remote_linkedin ), true );

        if ( isset( $response_linkedin['count'] ) ) {
            $linkedin_shares = $response_linkedin['count'];
        }

    }
//
//     	//Reddit
    $remote_reddit = wp_remote_get( 'https://www.reddit.com/api/info.json?url=' . $url, $remote_args );

    if ( ! is_wp_error( $remote_reddit ) ) {

        $response_reddit = json_decode( $remote_reddit['body'], true );

        if ( isset( $response_reddit['data']['children']['0']['data']['score'] ) ) {
            $reddit_shares = $response_reddit['data']['children']['0']['data']['score'];
        }

    }
//
//     	//Pinterest
    $remote_pinterest = wp_remote_get( 'https://api.pinterest.com/v1/urls/count.json?callback=CALLBACK&url=' . $url, $remote_args );

    if ( ! is_wp_error( $remote_pinterest ) ) {

        if ( preg_match( '/^\s*CALLBACK\s*\((.+)\)\s*$/', wp_remote_retrieve_body( $remote_pinterest ), $match ) ) {
            $response_pinterest = json_decode( $match[1], true );

            if ( isset( $response_pinterest['count'] ) ) {
                $pinterest_shares = $response_pinterest['count'];
            }
        }

    }

    //Total
//    $total = array(
//        "facebook"  => $facebook_shares,
//        "google"    => $google_shares,
//        "linkedin"  => $linkedin_shares,
//        "reddit"    => $reddit_shares,
//        "pinterest" => $pinterest_shares,
//    );

    echo $facebook_shares + $google_shares + $linkedin_shares + $reddit_shares + $pinterest_shares + 7 ;

    wp_die();

}

function usa_map_func(){

    wp_enqueue_script( 'mapdata', get_template_directory_uri() . '/usmap/mapdata.js', array (), 2.1, true);
    wp_enqueue_script( 'usmap', get_template_directory_uri() . '/usmap/usmap.js', array ( 'mapdata' ), 2.1, true);

    $html = '
    
    <div class="usamap">
        <div>
			<div id="map"></div>
		</div>
    </div>
    
    ';

    return $html;
}

add_shortcode('usa_map', 'usa_map_func');

//This code removes noreferrer from your new or updated posts
function my_targeted_link_rel($rel_values) {
    return 'nofollow';
}
add_filter('wp_targeted_link_rel', 'my_targeted_link_rel',999);


add_action('acf/init', 'my_acf_init');
function my_acf_init() {

    // check function exists
    if( function_exists('acf_register_block') ) {

        // register a testimonial block
        acf_register_block(array(
            'name'				=> 'product-template',
            'title'				=> __('Product Template'),
            'description'		=> __('Product Template'),
            'render_callback'	=> 'my_acf_block_render_callback',
            'category'			=> 'formatting',
            'icon'				=> 'pressthis'
        ));

        acf_register_block(array(
            'name'				=> 'product-testimonial',
            'title'				=> __('Testimonial Template'),
            'description'		=> __('Testimonial Template'),
            'render_callback'	=> 'my_acf_block_render_callback',
            'category'			=> 'formatting',
            'icon'				=> 'pressthis'
        ));

        // register a testimonial block
        acf_register_block(array(
            'name'				=> 'product-table',
            'title'				=> __('Product Table'),
            'description'		=> __('Product Table'),
            'render_callback'	=> 'my_acf_block_render_callback',
            'category'			=> 'formatting',
            'icon'				=> 'pressthis'
        ));

        // register a testimonial block
        acf_register_block(array(
            'name'				=> 'product-template-big',
            'title'				=> __('Product Template Big'),
            'description'		=> __('Product Template Big'),
            'render_callback'	=> 'my_acf_block_render_callback',
            'category'			=> 'formatting',
            'icon'				=> 'pressthis'
        ));
    }
}

function my_acf_block_render_callback( $block ) {

    $slug = str_replace('acf/', '', $block['name']);

    if( file_exists( get_theme_file_path("/template-parts/block/content-{$slug}.php") ) ) {

        include( get_theme_file_path("/template-parts/block/content-{$slug}.php") );

    }
}


function table_img_func( $atts ){
    return "<img class='table_img' src='". $atts['src']."'>";
}
add_shortcode('table_img', 'table_img_func');

add_filter( 'wpseo_stylesheet_url', function( $stylesheet ) {

    if (strpos($stylesheet, '/plugins/wpseo-news/assets/xml-news-sitemap.xsl') !== false) {

        return preg_replace( '33g6ft32cafi1nkcg843nyhn-wpengine.netdna-ssl.com', 'thecbdinsider.com', $stylesheet, 1 );
    }


    return $stylesheet;

} );

function combined_css_pattern_filter( $value ) {

    $detect = new Mobile_Detect;

    if ( $detect->isMobile() && (!$detect->isTablet()) ) {

        $value = '/<\/body>/i';

    }

    return $value;

}

add_filter( 'combined_css_pattern', 'combined_css_pattern_filter', 10, 2 );


if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title' 	=> 'Theme General Settings',
        'menu_title'	=> 'Theme Settings',
        'menu_slug' 	=> 'theme-general-settings',
        'capability'	=> 'edit_posts',
        'redirect'		=> false
    ));

}

?>
