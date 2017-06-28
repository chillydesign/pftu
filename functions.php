<?php
/*
*  Author: Todd Motto | @toddmotto
*  URL: webfactor.com | @webfactor
*  Custom functions, support, custom post types and more.
*/

/*------------------------------------*\
External Modules/Files
\*------------------------------------*/

// Load any external files you have here

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
    add_image_size('large', 1600, '', true); // Large Thumbnail
    add_image_size('medium', 800, '', true); // Medium Thumbnail
    add_image_size('small', 400, '', true); // Small Thumbnail
    add_image_size('square', 200, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

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
add_theme_support('automatic-feed-links');

// Localisation Support
load_theme_textdomain('webfactor', get_template_directory() . '/languages');
}

/*------------------------------------*\
Functions
\*------------------------------------*/

// HTML5 Blank navigationh
function webfactor_nav()
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

function webfactor_footer_nav()
{
    wp_nav_menu(
        array(
            'theme_location'  => 'sidebar-menu',
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

function wf_version(){
    return '0.0.1';
}

// Load HTML5 Blank scripts (header.php)
function webfactor_header_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

        wp_register_script('modernizr', get_template_directory_uri() . '/js/lib/modernizr-2.7.1.min.js', array(), '2.7.1'); // Modernizr
        wp_enqueue_script('modernizr'); // Enqueue it!

        wp_register_script('wf_bxslider', get_template_directory_uri() . '/js/min/jquery.bxslider.js', array('jquery'), wf_version(), true); // Custom scripts
        wp_enqueue_script('wf_bxslider'); // Enqueue it!

        wp_register_script('wf_matchheight', get_template_directory_uri() . '/js/min/jquery.matchHeight.js', array('jquery'), wf_version(), true); // Custom scripts
        wp_enqueue_script('wf_matchheight'); // Enqueue it!

        wp_register_script('wf_scripts', get_template_directory_uri() . '/js/min/scripts.js', array('jquery'), wf_version(), true); // Custom scripts
        wp_enqueue_script('wf_scripts'); // Enqueue it!
    }
}

// Load HTML5 Blank conditional scripts
function webfactor_conditional_scripts()
{
    if (is_page('pagenamehere')) {
        wp_register_script('scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0'); // Conditional script(s)
        wp_enqueue_script('scriptname'); // Enqueue it!
    }
}

// Load HTML5 Blank styles
function webfactor_styles()
{
    wp_register_style('reset', get_template_directory_uri() . '/reset.css', array(), wf_version(), 'all');
    wp_enqueue_style('reset'); // Enqueue it!

    wp_register_style('wf_style', get_template_directory_uri() . '/css/global.css', array(), wf_version(),  'all');
    wp_enqueue_style('wf_style'); // Enqueue it!
}

// Register HTML5 Blank Navigation
function register_html5_menu()
{
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', 'webfactor'), // Main Navigation
        'sidebar-menu' => __('Sidebar Menu', 'webfactor'), // Sidebar Navigation
        'extra-menu' => __('Extra Menu', 'webfactor') // Extra Navigation if needed (duplicate as many as you need!)
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

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
    // Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Widget Area 1', 'webfactor'),
        'description' => __('Description for this widget-area...', 'webfactor'),
        'id' => 'widget-area-1',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    // Define Sidebar Widget Area 2
    register_sidebar(array(
        'name' => __('Widget Area 2', 'webfactor'),
        'description' => __('Description for this widget-area...', 'webfactor'),
        'id' => 'widget-area-2',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
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
        'total' => $wp_query->max_num_pages
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
    return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'webfactor') . '</a>';
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
function webfactorgravatar ($avatar_defaults)
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
function webfactorcomments($comment, $args, $depth)
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
    add_action('init', 'webfactor_header_scripts'); // Add Custom Scripts to wp_head
    add_action('wp_print_scripts', 'webfactor_conditional_scripts'); // Add Conditional Page Scripts
    add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
    add_action('wp_enqueue_scripts', 'webfactor_styles'); // Add Theme Stylesheet
    add_action('init', 'register_html5_menu'); // Add HTML5 Blank Menu
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
    add_filter('avatar_defaults', 'webfactorgravatar'); // Custom Gravatar in Settings > Discussion
    add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
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
    add_action('init', 'create_post_type_partenaire'); // Add our Partenaire Type
    function create_post_type_partenaire()
    {
        register_taxonomy_for_object_type('category', 'html5-blank'); // Register Taxonomies for Category
        register_taxonomy_for_object_type('post_tag', 'html5-blank');
        register_post_type('partenaire', // Register Custom Post Type
        array(
            'labels' => array(
                'name' => __('Partenaires', 'webfactor'), // Rename these to suit
                'singular_name' => __('Partenaire', 'webfactor'),
                'add_new' => __('Ajouter', 'webfactor'),
                'add_new_item' => __('Ajouter Partenaire', 'webfactor'),
                'edit' => __('Modifier', 'webfactor'),
                'edit_item' => __('Modifier Partenaire', 'webfactor'),
                'new_item' => __('Nouveau Partenaire', 'webfactor'),
                'view' => __('Afficher Partenaire', 'webfactor'),
                'view_item' => __('Afficher Partenaire', 'webfactor'),
                'search_items' => __('Chercher Partenaire', 'webfactor'),
                'not_found' => __('Aucun Partenaire trouvé', 'webfactor'),
                'not_found_in_trash' => __('Aucun Partenaire trouvé dans la corbeille', 'webfactor')
            ),
            'public' => true,
            'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
            'has_archive' => true,
            'supports' => array(
                'title',
                'editor',
                'excerpt',
                'thumbnail'
            ), // Go to Dashboard Custom HTML5 Blank post for supports
            'can_export' => true, // Allows export in Tools > Export
            'taxonomies' => array(
                'post_tag',
                'category'
            ) // Add Category and Post Tags support
        ));
    }



    function register_event_cat_tax(){

        $labels = array(
            'name'              => _x( 'Evenement Categories', 'taxonomy general name', 'webfactor' ),
            'singular_name'     => _x( 'Evenement Categorie', 'taxonomy singular name', 'webfactor' ),
            'search_items'      => __( 'Search Evenement Categories', 'webfactor' ),
            'all_items'         => __( 'All Evenement Categories', 'webfactor' ),
            'parent_item'       => __( 'Parent Evenement Categorie', 'webfactor' ),
            'parent_item_colon' => __( 'Parent Evenement Categorie:', 'webfactor' ),
            'edit_item'         => __( 'Edit Evenement Categorie', 'webfactor' ),
            'update_item'       => __( 'Update Evenement Categorie', 'webfactor' ),
            'add_new_item'      => __( 'Add New Evenement Categorie', 'webfactor' ),
            'new_item_name'     => __( 'New Evenement Categorie Name', 'webfactor' ),
            'menu_name'         => __( 'Evenement Categorie', 'webfactor' ),
        );

        $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'event_category' ),
        );
        register_taxonomy( 'event_category', array( 'evenement' ) , $args);

    }



    add_action('init', 'register_event_cat_tax'); // Add our évènement Type
    add_action('init', 'create_post_type_evenement'); // Add our évènement Type
    function create_post_type_evenement()
    {

        //register_taxonomy_for_object_type('event_category', 'html5-blank'); // Register Taxonomies for Category
        //register_taxonomy_for_object_type('post_tag', 'html5-blank');
        register_post_type('evenement', // Register Custom Post Type
        array(
            'labels' => array(
                'name' => __('Évènements', 'webfactor'), // Rename these to suit
                'singular_name' => __('Évènement', 'webfactor'),
                'add_new' => __('Ajouter', 'webfactor'),
                'add_new_item' => __('Ajouter Évènement', 'webfactor'),
                'edit' => __('Modifier', 'webfactor'),
                'edit_item' => __('Modifier Évènement', 'webfactor'),
                'new_item' => __('Nouvel Évènement', 'webfactor'),
                'view' => __('Afficher Évènement', 'webfactor'),
                'view_item' => __('Afficher Évènement', 'webfactor'),
                'search_items' => __('Chercher Évènement', 'webfactor'),
                'not_found' => __('Aucun Évènement trouvé', 'webfactor'),
                'not_found_in_trash' => __('Aucun Évènement trouvé dans la corbeille', 'webfactor')
            ),
            'public' => true,
            'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
            'has_archive' => true,
            'supports' => array(
                'title',
                'editor',
                'excerpt',
                'thumbnail'
            ), // Go to Dashboard Custom HTML5 Blank post for supports
            'can_export' => true, // Allows export in Tools > Export
            'taxonomies' => array(
                //'post_tag',
                //'category',
                'event_category'
            ) // Add Category and Post Tags support
        ));
    }

    /*------------------------------------*\
    ShortCode Functions
    \*------------------------------------*/

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




    function chilly_nav($menu){

        wp_nav_menu(
            array(
                'theme_location'  => $menu,
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
                'items_wrap'      => '%3$s',
                'depth'           => 0,
                'walker'          => ''
            )
        );

    }

    function chilly_map( $atts, $content = null ) {

        $attributes = shortcode_atts( array(
            'title' => "Rue du Midi 15 Case postale 411 1020 Renens"
        ), $atts );



        $title = $attributes['title'];
        $chilly_map = '<div id="map_container_1"></div>';
        $chilly_map .= "<script> var latt = 46.5380683; var lonn=6.5812023; var map_title = '" . $title . "'  </script>";
        return $chilly_map;

    }
    add_shortcode( 'chilly_map', 'chilly_map' );


    function disable_wp_emojicons() {

        // all actions related to emojis
        remove_action( 'admin_print_styles', 'print_emoji_styles' );
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
        remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
        remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
        remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

        // filter to remove TinyMCE emojis
        // add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
    }
    add_action( 'init', 'disable_wp_emojicons' );


    function remove_json_api () {

        // Remove the REST API lines from the HTML Header
        remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
        remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
        // Remove the REST API endpoint.
        remove_action( 'rest_api_init', 'wp_oembed_register_route' );
        // Turn off oEmbed auto discovery.
        add_filter( 'embed_oembed_discover', '__return_false' );
        // Don't filter oEmbed results.
        remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );
        // Remove oEmbed discovery links.
        remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
        // Remove oEmbed-specific JavaScript from the front-end and back-end.
        remove_action( 'wp_head', 'wp_oembed_add_host_js' );
        // Remove all embeds rewrite rules.
        // add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );

    }
    add_action( 'after_setup_theme', 'remove_json_api' );




    function count_to_bootstrap_class($count){

        if ($count == 1) {
            $class = 'col-sm-12';
        } elseif ($count == 2) {
            $class = 'col-sm-6';
        } elseif ($count == 3) {
            $class = 'col-sm-4';
        } elseif ($count == 4) {
            $class = 'col-sm-3 col-xs-6';
        } elseif ($count <= 6 ) {
            $class = 'col-sm-2';
        } else {
            $class = 'col-sm-1';
        }
        return $class;
    };

    function thumbnail_of_post_url( $post_id,  $size='large'  ) {

        $image_id = get_post_thumbnail_id(  $post_id );
        $image_url = wp_get_attachment_image_src($image_id, $size  );
        $image = $image_url[0];
        return $image;

    }


    function latest_events_shortcode( $atts, $content = null ) {
        global $post;

        $a = shortcode_atts( array(
            'limit' => -1,
            'future' => false
        ), $atts );



        $title = false;


        $args =   array(
            'posts_per_page'   =>  $a['limit'] ,
            'post_type'        => 'evenement',
            'orderby' => 'start_date',
            'order'=> 'ASC'
        );


        // if watning to find only events in a specific category
        // put ?event_cat param in URL
        if (isset($_GET['event_cat']) && $_GET['event_cat'] !='' ) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'event_category',
                    'field'    => 'term_id',
                    'terms'    =>  $_GET['event_cat']
                ),
            );


            $term =  get_term($_GET['event_cat']);
            if ($term && isset($term->name)) {
                $title = $term->name;
            }
        }

        // if want to show future events you can put future="true" in the shortcode
        // or add a get param of avenir
        if (isset($_GET['avenir']) ||  $a['future'] == 'true'   ) {
            $today = 	 new DateTime('today');
            $today_string = $today->format('Y-m-d');
            $args['meta_query'] =	array(
                'relation' => 'OR',
                array(
                    'key'     => 'start_date',
                    'value'   =>  $today_string,
                    'compare' => '>=',
                    'type'    =>  'date'
                ),
                array(
                    'key'     => 'end_date',
                    'value'   =>  $today_string,
                    'compare' => '>=',
                    'type'    =>  'date'
                )
            );

        }


        $events = new WP_Query( $args);



        $events_text = '<div class="latest_events_container">';
        if ($title) $events_text .= '<h3>'. $title .'</h3>';

        $events_text .= '<ul>';


        while ( $events->have_posts() ) : $events->the_post();
        // $start_date = get_field('start_date', $post->ID);
        // $end_date = get_field('end_date', $post->ID);
        $events_text .= '<li class="single_event">
        <div class="single_event_inner">
        <h4>' . get_the_title() .'</h4>
        <div class="event_content">'.  apply_filters('the_content', get_the_content())   .'</div>
        </div>
        </li>';
    endwhile;
    wp_reset_postdata();

    $events_text .= '</ul></div>';


    return  $events_text;

}
add_shortcode( 'latest_events', 'latest_events_shortcode' );








function event_cats_shortcode( $atts, $content = null ) {
    global $post;

    $a = shortcode_atts( array(
    ), $atts );


    $event_categories =  get_terms('event_category', array(
        'hide_empty' => true
    )  );

    $ret = '<ul>';
    $active = '';

    foreach ($event_categories as $category) {
        $active = ( isset($_GET['event_cat']) &&  $category->term_id == $_GET['event_cat'] ) ? 'active' : '';
        $ret .= '<li><a class="'. $active .'" href="?event_cat='.  $category->term_id .'">'.  $category->name .'</a></li>';
    }

    $future_active = (isset($_GET['avenir'])  ) ? 'active' : '';
    $ret .= '<li><a  class="'. $future_active .'"href="?avenir">A venir</a></li>';
    $ret .= '</ul>';



    $all_active = (!isset($_GET['event_cat']) & !isset($_GET['event_future'])  ) ? 'active' : '';
    $ret .= '<h6><a class="'. $all_active .'" href="?">Tous les évènements</a></h6>';

    return  $ret;

}
add_shortcode( 'event_categories', 'event_cats_shortcode' );



function latest_partage_shortcode( $atts, $content = null ) {
    global $post;

    $a = shortcode_atts( array(
    ), $atts );



    $partages = get_posts( array('post_type' => 'partage', 'posts_per_page'=> 1 ));

    $ret = '';
    foreach ( $partages as $post ) :
        setup_postdata( $post );
        $partage_img = thumbnail_of_post_url($post->ID, 'small');
        $ret .= '<p><a href="'. get_the_permalink() .'"><img src="'. $partage_img .'" alt="" />'. get_the_title() .'</a></p>';


    endforeach;


    $ret .= '';


    return  $ret;

}
add_shortcode( 'latest_partage', 'latest_partage_shortcode' );









include('functions_participatif.php');


?>
