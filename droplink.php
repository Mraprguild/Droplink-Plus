<?php
/*
 Plugin Name: Droplink Plus
 Plugin URI: https://www.mraprguild.shop/
 Description: Convert Your Download Links into Revenue with Adlinkfly Integration
 Version: 1.3
 Author: Mraprguild
 Author URI: https://t.me/aprfilestorebot
 License: GPL3
*/

if(!defined('ABSPATH')){
	exit;
}
define('WPSAF_FILE', __FILE__);
define('WPSAF_URL', plugins_url('', __FILE__));
define('WPSAF_DIR', plugin_dir_path(__FILE__));


require(WPSAF_DIR . 'droplink.core.php');


register_activation_hook(__FILE__, 'wpsafelink_activation');
function wpsafelink_activation()
{
	global $wpdb;
	$charset_collate = $wpdb->get_charset_collate();
	$table_name = $wpdb->prefix . 'wpsafelink';
	$sql = "CREATE TABLE $table_name (
		ID bigint(0) NOT NULL AUTO_INCREMENT, 
		date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL, 
		date_view datetime DEFAULT '0000-00-00 00:00:00' NOT NULL, 
		date_click datetime DEFAULT '0000-00-00 00:00:00' NOT NULL, 
		safe_id varchar(8) NOT NULL,
		link longtext NOT NULL,
		view bigint(0) NOT NULL,
		click bigint(0) NOT NULL,
		UNIQUE KEY id (ID)
	) $charset_collate;";
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);
	if (get_settings('wpsaf_options') == '') wpsaf_default();

	$upload_dir = wp_get_upload_dir();
	$tmp = $upload_dir['basedir'] . '/wpsaf.script.js';
	if(file_exists($tmp)) {
		$data = file_get_contents($tmp);
		$cached = WPSAF_DIR . 'assets/wpsaf.script.js';

		file_put_contents($cached, $data);
		unlink($tmp);
	}
}
function wpsaf_default()
{
	$wpsaf_def = array(
		'permalink1' 	=> 'go',
		'permalink2' 	=> 'go',
		'permalink'		=> 2,
		'linkr'			=> 'redirect',
		'content' 		=> 0,
		'contentid' 	=> '',
		'template' 		=> 'template1',
		'delay' 		=> 10,
		'delaytext' 	=> 'Thank you for your visit. Your links will be created in {time} seconds.',
		'logo'			=> 'https://envs.sh/hAh.jpg',
		'image1'		=> WPSAF_URL . '/assets/generate4.png',
		'image2'		=> WPSAF_URL . '/assets/wait4.png',
		'image3'		=> WPSAF_URL . '/assets/target4.png',
		'image4'		=> WPSAF_URL . '/assets/human-verification4.png',
		'ads1'			=> '',
		'ads2'			=> '',
		'ads3'			=> '',
		'ads4'			=> '',
		'autosave'		=> 1,
		'redirect'		=> 1,
		'new_tab'		=> 1,
		'base_url'		=> get_bloginfo('url') . '/',
		'adb' 			=> 1,
		'adb1'			=> 'Adblock Detected',
		'adb2'			=> 'Please disable adblock to proceed to the destination page',
		'autojavascript' => 2,
		'skipverification' => 2,
		'second_safelink_url' => '',
		'recaptcha_enable' => 2,
		'recaptcha_site_key' => '',
		'recaptcha_secret_key' => '',
		'recaptcha_text' => 'Please complete reCAPTCHA verification'
	);
	$wpsaf = json_encode($wpsaf_def);
	update_option('wpsaf_options', $wpsaf);
}

add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'wpsafelink_add_settings_link' );
function wpsafelink_add_settings_link( $links ){
    $plugin_links = array(
        '<a href="' . admin_url( 'admin.php?page=droplink') . '" style="font-weight:bold">' . __( 'Settings', 'droplink' ) . '</a>',
        '<a href="https://t.me/aprfilestorebot" title="Donate Now" target="_blank" style="font-weight:bold">' . __( 'Donate', 'droplink' ) . '</a>',
        '<a href="https://t.me/aprfilestorebot" title="Support" target="_blank" style="font-weight:bold">' . __( 'Support', 'droplink' ) . '</a>',
    );

    return array_merge( $plugin_links, $links );
}


add_action( 'admin_notices', 'wpsafelink_notice_set_themeson' );
function wpsafelink_notice_set_themeson() {
	global $WPSAF;

	

add_action( 'init', 'wpsafelink_remove_footer', 10 );
function wpsafelink_remove_footer(){
	global $WPSAF;
	$wpsaf = json_decode(get_option('wpsaf_options'), true);
	if(empty($wpsaf['autojavascript']) || $wpsaf['autojavascript'] == 2) {
		remove_action('wp_footer', array($WPSAF, 'footer_wp_safelink'), 999);
	}
}

register_deactivation_hook(__FILE__, 'wpsafelink_deactivation');
function wpsafelink_deactivation() {
	global $WPSAF;

	$lis = $WPSAF->ceklis('', true);
	if(!empty($lis)) {
		$cached = WPSAF_DIR . 'assets/wpsaf.script.js';
		$data = file_get_contents($cached);
		
		$upload_dir = wp_get_upload_dir();
		$tmp = $upload_dir['basedir'] . '/wpsaf.script.js';
		file_put_contents($tmp, $data);
	}
}
}

add_action('admin_notices', 'droplink_plus_update_notification');
function droplink_plus_update_notification() {
    $server = base64_decode('aHR0cHM6Ly9hcGkubnBvaW50LmlvLzc2NzJiMDY4YjA4NzcyNDkzYzBl');
    $response = wp_remote_get($server);
    if (is_wp_error($response)) {
        echo '<p style="color: red;">Failed to fetch update information. Please try again later.</p>';
        return;
    }

    $data = json_decode(wp_remote_retrieve_body($response), true);

    if (empty($data) || !isset($data['version']) || !isset($data['download_url'])) {
        echo '<p style="color: red;">Invalid update information received. Please check the response.</p>';
        return;
    }

    $current_version = '1.3'; 
    $latest_version = $data['version'];
    $download_url = $data['download_url'];
    
    if (version_compare($current_version, $latest_version, '<')) {
        echo '<p class="custom-update-message" style="margin-top:40px;padding: 10px; background-color: #f1c40f; color: #000;">
            <strong>New v' . esc_html($latest_version) . ' Available for Droplink Plus Plugin - 
            <a href="' . esc_url($download_url) . '" target="_blank">Download here</a>.
            Any problems, <a href="mailto:rtgnetwork7s@gmail.com">contact support</a>.</strong>
        </p>';
    }
}

function show_droplink_plus_notification() {
    if ( get_transient( 'droplink_plus_notification_dismissed' ) ) {
        return;
    }

   $server = base64_decode('aHR0cHM6Ly9hcGkubnBvaW50LmlvL2ZjM2Q3MjU2NTJjNzQwZjg0NjU5');
   $response = wp_remote_get($server);
   
    if ( is_wp_error( $response ) ) {
        return;
    }

    $data = json_decode( wp_remote_retrieve_body( $response ), true );

    if ( isset( $data['notification']['enabled'] ) && $data['notification']['enabled'] ) {
        $message = esc_html( $data['notification']['message'] );
        $link = esc_url( $data['notification']['link'] );
        $button_text = esc_html( $data['notification']['button_text'] );

        add_action( 'admin_notices', function() use ( $message, $link, $button_text ) {
            echo '<div class="notice notice-info is-dismissible" id="droplink-plus-notification">';
            echo '<p>' . $message . ' <a href="' . $link . '" class="button button-primary">' . $button_text . '</a></p>';
            echo '</div>';
        });

        add_action( 'admin_footer', function() {
            ?>
            <script type="text/javascript">
                (function($) {
                    $(document).on('click', '#droplink-plus-notification .notice-dismiss', function() {
                        $.post(ajaxurl, { action: 'dismiss_droplink_plus_notification' });
                    });
                })(jQuery);
            </script>
            <?php
        });
    }
}
add_action( 'admin_init', 'show_droplink_plus_notification' );

function dismiss_droplink_plus_notification() {
    set_transient( 'droplink_plus_notification_dismissed', true, 12 * HOUR_IN_SECONDS );
    wp_die();
}
add_action( 'wp_ajax_dismiss_droplink_plus_notification', 'dismiss_droplink_plus_notification' );
