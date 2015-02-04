<?php
/*
Plugin Name: Diaspora Podlist Updater
Plugin URI:
Description: This plugin periodically retrieves a fresh list of active Diaspora* pods.
Version: 0.0.1
Author: Vitalie Ciubotaru
Author URI: https://github.com/ciubotaru
License: GPL2
*/

define( 'DIASPORA_PLUGIN_DOWNLOADER_VERSION', '0.0.1' );
//define( 'DIASPORA_PLUGIN_DOWNLOADER_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
//define( 'DIASPORA_PLUGIN_DOWNLOADER_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

class DiasporaPodlistUpdater {
    public function __construct() {
        register_activation_hook( __FILE__, array( $this, 'dpu_activation' ) );
        register_deactivation_hook( __FILE__, array( $this, 'dpu_deactivation' ) );
        add_action( 'dpu_hook', array( $this, 'dpu_download' ) );
    }

    function dpu_activation() {
        add_option( 'dpu-podlist' );
        $this -> dpu_download();
        wp_schedule_event( time(), 'daily', 'dpu_hook' );
    }

    function dpu_download() {
        $podlist_update_url = 'http://podupti.me/api.php?format=json&key=4r45tg';
        $json = file_get_contents( $podlist_update_url );
        if ( empty( $json ) ) {
            return;
        }
        $podlist_raw = json_decode( $json, true );
        if ( $podlist_raw === null ) {
            return;
        }
        $podlist_clean = $podlist_raw['pods'];
        $output = array();
        foreach ( $podlist_clean as $pod ) {
            //if ($pod['network'] == "Diaspora") {
            if ( $pod['hidden'] == 'no' ) {
                // array_push($output, $pod['host']);
                array_push( $output, $pod['domain'] );
            }
        }
        update_option( 'dpu-podlist', $output );
    }

    function dpu_deactivation() {
        wp_clear_scheduled_hook( 'dpu_hook' );
        delete_option('dpu-podlist');
    }
}

$diasporapodlistupdater = new DiasporaPodlistUpdater;
?>
