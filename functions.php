<?php
require_once( 'library/bones.php' );

// CUSTOMIZE THE WORDPRESS ADMIN (off by default)
// require_once( 'library/admin.php' );

function ted_ahoy()
{
    //Allow editor style.
    add_editor_style( get_stylesheet_directory_uri() . '/library/css/editor-style.css' );
    // let's get language support going, if you need it
    load_theme_textdomain( 'ted', get_template_directory() . '/library/translation' );

    // USE THIS TEMPLATE TO CREATE CUSTOM POST TYPES EASILY
    require_once( 'library/custom-post-type.php' );

    // launching operation cleanup
    add_action( 'init', 'ted_head_cleanup' );
    // A better title
    add_filter( 'wp_title', 'rw_title', 10, 3 );
    // remove WP version from RSS
    add_filter( 'the_generator', 'ted_rss_version' );
    // remove pesky injected css for recent comments widget
    add_filter( 'wp_head', 'ted_remove_wp_widget_recent_comments_style', 1 );
    // clean up comment styles in the head
    add_action( 'wp_head', 'ted_remove_recent_comments_style', 1 );
    // clean up gallery output in wp
    add_filter( 'gallery_style', 'ted_gallery_style' );
    // enqueue base scripts and styles
    add_action( 'wp_enqueue_scripts', 'ted_scripts_and_styles', 999 );
    // launching this stuff after theme setup
    ted_theme_support();
    // adding sidebars to Wordpress (these are created in functions.php)
    add_action( 'widgets_init', 'ted_register_sidebars' );
    // cleaning up random code around images
    add_filter( 'the_content', 'ted_filter_ptags_on_images' );
    // cleaning up excerpt
    add_filter( 'excerpt_more', 'ted_excerpt_more' );
}

// let's get this party started
add_action( 'after_setup_theme', 'ted_ahoy' );

if ( !isset($content_width) ) {
    $content_width = 680;
}

// Thumbnail sizes
add_image_size( 'ted-thumb-600', 600, 150, true );
add_image_size( 'ted-thumb-300', 300, 100, true );
add_filter( 'image_size_names_choose', 'ted_custom_image_sizes' );

function ted_custom_image_sizes( $sizes )
{
    return array_merge( $sizes, array(
            'ted-thumb-600' => __('600px by 150px'),
            'ted-thumb-300' => __('300px by 100px'),
        ) );
}

function ted_theme_customizer( $wp_customize )
{
    // $wp_customize calls go here.
    // Uncomment the below lines to remove the default customize sections 

    // $wp_customize->remove_section('title_tagline');
    // $wp_customize->remove_section('colors');
    // $wp_customize->remove_section('background_image');
    // $wp_customize->remove_section('static_front_page');
    // $wp_customize->remove_section('nav');

    // Uncomment the below lines to remove the default controls
    // $wp_customize->remove_control('blogdescription');

    // Uncomment the following to change the default section titles
    // $wp_customize->get_section('colors')->title = __( 'Theme Colors' );
    // $wp_customize->get_section('background_image')->title = __( 'Images' );
}

add_action( 'customize_register', 'ted_theme_customizer' );

// Sidebars & Widgetizes Areas
function ted_register_sidebars()
{
    register_sidebar(array(
            'id'   => 'sidebar1',
            'name' => __( 'Sidebar 1', 'ted' ),
            'description'   => __( 'The first (primary) sidebar.', 'ted' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widgettitle">',
            'after_title'   => '</h4>',
        ));
}

// Comment Layout
function ted_comments( $comment, $args, $depth )
{
    $GLOBALS['comment'] = $comment;?>
    <div id="comment-<?php comment_ID() ?>" <?php comment_class('cf') ?>>
        <article  class="cf">
            <header class="comment-author vcard">
                <?php $bgauthemail = get_comment_author_email() ?>
                <img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ) ?>?s=40" class="load-gravatar avatar avatar-48 photo" height="40" width="40" src="<?php echo get_template_directory_uri() ?>/library/images/nothing.gif" >
                <?php printf( __( '<cite class="fn">%1$s</cite> %2$s', 'ted' ), get_comment_author_link(), edit_comment_link(__( '(Edit)', 'ted' ),'  ','') ) ?>
                <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'ted' )); ?> </a></time>
            </header>
            <?php if ($comment->comment_approved == '0'): ?>
            <div class="alert alert-info">
                <p><?php _e( 'Your comment is awaiting moderation.', 'ted' ) ?></p>
            </div>
            <?php endif ?>
            <section class="comment_content cf">
                <?php comment_text() ?>
            </section>
            <?php comment_reply_link( array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'])) ) ?>
        </article><?php
}
