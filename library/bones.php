<?php

  function ted_head_cleanup()
  {
    remove_action('wp_head', 'rsd_link');
    // windows live writer
    remove_action('wp_head', 'wlwmanifest_link');
    // previous link
    remove_action('wp_head', 'parent_post_rel_link', 10, 0);
    // start link
    remove_action('wp_head', 'start_post_rel_link', 10, 0);
    // links for adjacent posts
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
    // WP version
    remove_action('wp_head', 'wp_generator');
    // remove WP version from css
    add_filter('style_loader_src', 'ted_remove_wp_ver_css_js', 9999);
    // remove Wp version from scripts
    add_filter('script_loader_src', 'ted_remove_wp_ver_css_js', 9999);
  }

  function rw_title($title, $sep, $seplocation)
  {
    global $page, $paged;

    // Don't affect in feeds.
    if (is_feed())
      return $title;

    // Add the blog's name
    if ( 'right' == $seplocation ) {
      $title .= get_bloginfo('name');
    } else {
      $title = get_bloginfo('name') . $title;
    }

    // Add the blog description for the home/front page.
    $site_description = get_bloginfo('description', 'display');

    if ($site_description && (is_home() || is_front_page())) {
      $title .= " {$sep} {$site_description}";
    }

    // Add a page number if necessary:
    if ( $paged >= 2 || $page >= 2 ) {
      $title .= " {$sep} " . sprintf( __('Page %s', 'dbt'), max($paged, $page));
    }

    return $title;
  }

  // remove WP version from RSS
  function ted_rss_version()
  {
    return '';
  }

  // remove WP version from scripts
  function ted_remove_wp_ver_css_js($src)
  {
    if (strpos($src, 'ver=')) {
      $src = remove_query_arg( 'ver', $src );
    }

    return $src;
  }

  // remove injected CSS for recent comments widget
  function ted_remove_wp_widget_recent_comments_style()
  {
    if (has_filter('wp_head', 'wp_widget_recent_comments_style')) {
      remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
    }
  }

  // remove injected CSS from recent comments widget
  function ted_remove_recent_comments_style()
  {
    global $wp_widget_factory;
    if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments']))
      remove_action( 'wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style') );
  }

  // remove injected CSS from gallery
  function ted_gallery_style( $css )
  {
    return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
  }

  // loading modernizr and jquery, and reply script
  function ted_scripts_and_styles()
  {
    global $wp_styles;

    if ( !is_admin() ) {
      // register main stylesheet
      wp_register_style( 'ted-components', get_stylesheet_directory_uri() . '/library/css/components.min.css', array(), '', 'all' );
      wp_register_style( 'ted-stylesheet', get_stylesheet_directory_uri() . '/library/css/style.min.css', array(), '', 'all' );
      // ie-only style sheet
      wp_register_style( 'ted-ie-only', get_stylesheet_directory_uri() . '/library/css/ie.css', array(), '' );

      // comment reply script for threaded comments
      if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1) )
        wp_enqueue_script( 'comment-reply' );

      //adding scripts file in the footer
      wp_register_script( 'ted-components-js', get_stylesheet_directory_uri() . '/library/js/components.min.js', array(), '', false );
      wp_register_script( 'ted-js', get_stylesheet_directory_uri() . '/library/js/script.min.js', array( 'jquery' ), '', true );

      // enqueue styles and scripts
      wp_enqueue_style( 'ted-components' );
      wp_enqueue_style( 'ted-stylesheet' );
      wp_enqueue_style( 'ted-ie-only' );
      // add conditional wrapper around ie stylesheet
      $wp_styles->add_data( 'ted-ie-only', 'conditional', 'lt IE 9' );

      wp_enqueue_script( 'jquery' );
      wp_enqueue_script( 'ted-components-js' );
      wp_enqueue_script( 'ted-js' );
    }
  }

  // Adding WP 3+ Functions & Theme Support
  function ted_theme_support()
  {
    // wp thumbnails (sizes handled in functions.php)
    add_theme_support( 'post-thumbnails' );
    // default thumb size
    set_post_thumbnail_size( 125, 125, true );
    // wp custom background (thx to @bransonwerner for update)
    add_theme_support( 'custom-background', [
      'default-image'    => '', // background image default
      'default-color'    => '', // background color default (dont add the #)
      'wp-head-callback' => '_custom_background_cb',
      'admin-head-callback'    => '',
      'admin-preview-callback' => ''
    ]);

    // rss thingy
    add_theme_support('automatic-feed-links');
    // adding post format support
    add_theme_support( 'post-formats', [
      'aside',   // title less blurb
      'gallery', // gallery of images
      'link',    // quick link to other site
      'image',   // an image
      'quote',   // a quick quote
      'status',  // a Facebook like status update
      'video',   // video
      'audio',   // audio
      'chat'     // chat transcript
    ]);

    // wp menus
    add_theme_support( 'menus' );
    // registering wp3+ menus
    register_nav_menus([
      'main-nav'   => __( 'The Main Menu', 'ted' ), // main nav in header
      'redes-nav'  => __( 'The Main Redes', 'ted' ), // redes nav
      'footer-nav' => __( 'The Main Footer', 'ted' )  // secondary nav in footer
    ]);

    // Enable support for HTML5 markup.
    add_theme_support( 'html5', [
      'comment-list',
      'search-form',
      'comment-form'
    ]);
  }

  // Related Posts Function (call using ted_related_posts(); )
  function ted_related_posts()
  {
    echo '<ul id="ted-related-posts">';
    global $post;
    $tags = wp_get_post_tags( $post->ID );

    if ( $tags ) {
      foreach ( $tags as $tag )
        $tag_arr .= $tag->slug . ',';

      $related_posts = get_posts([
        'tag' => $tag_arr,
        'numberposts'  => 5,
        'post__not_in' => [$post->ID]
      ]);

        if ( $related_posts ) {
          foreach ( $related_posts as $post ) {
            setup_postdata( $post );
            echo '<li class="related_post"><a class="entry-unrelated" href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>';
          }
        } else
          echo '<li class="no_related_post">' . __( 'No Related Posts Yet!', 'ted' ) . '</li>';
    }

    wp_reset_postdata();
    echo '</ul>';
  }

  // Numeric Page Navi (built into the theme by default)
  function ted_page_navi()
  {
    global $wp_query;
    $bignum = 999999999;

    if ( $wp_query->max_num_pages <= 1 )
      return;

    echo '<nav class="pagination">';
    echo paginate_links([
      'base'      => str_replace( $bignum, '%#%', esc_url( get_pagenum_link($bignum) ) ),
      'format'    => '',
      'current'   => max( 1, get_query_var('paged') ),
      'total'     => $wp_query->max_num_pages,
      'prev_text' => '&larr;',
      'next_text' => '&rarr;',
      'type'      => 'list',
      'end_size'  => 3,
      'mid_size'  => 3
    ]);

    echo '</nav>';
  }

  // remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
  function ted_filter_ptags_on_images( $content )
  {
    return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
  }

  // This removes the annoying […] to a Read More link
  function ted_excerpt_more( $more )
  {
  global $post;
    return '...  <a class="excerpt-read-more" href="'. get_permalink( $post->ID ) . '" title="'. __( 'Read ', 'ted' ) . esc_attr( get_the_title( $post->ID ) ).'">'. __( 'Read more &raquo;', 'ted' ) .'</a>';
  }
