<?php
/**
 * Register and enqueue a stylesheets and scripts in the Frontend.
 *
 * @see WP Enqueue Scripts Docs (https://codex.wordpress.org/Plugin_API/Action_Reference/wp_enqueue_scripts)
 * @todo Replace only if you're creating your own Plugin
 * @todo mnm - Find all and replace text
 */

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;

/**
 * Enqueue a CSS in the WordPress Frontend.
 */
function mnm_style() {
        wp_register_style( 
          'mnm-style', // ID for Enqueuing
          MOBILE_NAVIGATION_MENU_URL. 'assets/css/style.css', // URI define( 'MOBILE_NAVIGATION_MENU_URL', plugin_dir_url( __FILE__ )
          false, // shows at header styles
          '1.0.0' // version
        );
        wp_enqueue_style( 'mnm-style' ); // Enqueuing this CSS file
        $disable_fa = get_option('mnm_option_8', 0);
        if(empty($disable_fa)):
          wp_enqueue_style( 'font-awesome-mnm', MOBILE_NAVIGATION_MENU_URL. 'assets/css/font-awesome.min.css', array(), '4.6.3' );
        endif;
}
add_action( 'wp_enqueue_scripts', 'mnm_style' );

/**
 * Enqueue a JS in the WordPress Frontend.
 */
function mnm_script() {
    wp_register_script( 
      'mnm-script', // ID for Enqueuing
      MOBILE_NAVIGATION_MENU_URL. 'assets/js/mnmenu.js', 
      array('jquery'), // jQuery Dependency
      '1.0.2', 
      false ); // shows at the header scripts
    wp_enqueue_script( 'mnm-script' ); // Enqueuing this CSS file
}
add_action( 'wp_enqueue_scripts', 'mnm_script' );
