<?php

// disable default dashboard widgets
function disable_default_dashboard_widgets()
{
	global $wp_meta_boxes;
	// unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);    // Right Now Widget
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);        // Activity Widget
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']); // Comments Widget
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);  // Incoming Links Widget
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);         // Plugins Widget

	// unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);    // Quick Press Widget
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);     // Recent Drafts Widget
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);           //
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);         //

	// remove plugin dashboard boxes
	unset($wp_meta_boxes['dashboard']['normal']['core']['yoast_db_widget']);           // Yoast's SEO Plugin Widget
	unset($wp_meta_boxes['dashboard']['normal']['core']['rg_forms_dashboard']);        // Gravity Forms Plugin Widget
	unset($wp_meta_boxes['dashboard']['normal']['core']['bbp-dashboard-right-now']);   // bbPress Plugin Widget
}

function ted_rss_dashboard_widget()
{
	if (function_exists('fetch_feed')) {
		// include_once( ABSPATH . WPINC . '/feed.php' );               // include the required file
		$feed = fetch_feed('http://feeds.feedburner.com/wpcandy');      // specify the source feed

		if (is_wp_error($feed)) {
			$limit = 0;
			$items = 0;
		} else {
			$limit = $feed->get_item_quantity(7);                        // specify number of items
			$items = $feed->get_items(0, $limit);                        // create an array of items
		}
	}

	if ($limit == 0){
		echo '<div>The RSS Feed is either empty or unavailable.</div>';   // fallback message
	} else {
		foreach ($items as $item) { ?>
			<h4 style="margin-bottom: 0;">
				<a href="<?php echo $item->get_permalink(); ?>" title="<?php echo mysql2date( __( 'j F Y @ g:i a', 'ted' ), $item->get_date( 'Y-m-d H:i:s' ) ); ?>" target="_blank">
					<?php echo $item->get_title(); ?>
				</a>
			</h4>
			<p style="margin-top: 0.5em;">
				<?php echo substr($item->get_description(), 0, 200); ?>
			</p>
	<?php }
	}
}

// calling all custom dashboard widgets
function ted_custom_dashboard_widgets()
{
	wp_add_dashboard_widget('ted_rss_dashboard_widget', __( 'Recently on Themble (Customize on admin.php)', 'ted' ), 'ted_rss_dashboard_widget');
}

// removing the dashboard widgets
add_action('wp_dashboard_setup', 'disable_default_dashboard_widgets');
// adding any custom widgets
add_action('wp_dashboard_setup', 'ted_custom_dashboard_widgets');

//http://codex.wordpress.org/Plugin_API/Action_Reference/login_enqueue_scripts
function ted_login_css()
{
	wp_enqueue_style('ted_login_css', get_template_directory_uri() . '/library/css/login.css', false);
}

// changing the logo link from wordpress.org to your site
function ted_login_url()
{
	return home_url();
}

// changing the alt text on the logo to show your site name
function ted_login_title()
{
	return get_option('blogname');
}

// calling it only on the login page
add_action('login_enqueue_scripts', 'ted_login_css', 10);
add_filter('login_headerurl', 'ted_login_url');
add_filter('login_headertitle', 'ted_login_title');

/************* CUSTOMIZE ADMIN *******************/

// Custom Backend Footer
function ted_custom_admin_footer()
{
	_e('<span id="footer-thankyou">Developed by <a href="http://yoursite.com" target="_blank">Your Site Name</a></span>. Built using <a href="http://themble.com/bones" target="_blank">Bones</a>.', 'ted');
}

// adding it to the admin area
add_filter('admin_footer_text', 'ted_custom_admin_footer');
