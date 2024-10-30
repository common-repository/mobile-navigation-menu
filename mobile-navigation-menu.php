<?php
/**
 * Plugin Name:     Mobile Navigation Menu
 * Plugin URI:      http://innovedesigns.com/
 * Description:     Awesome navigation menu for mobile screens
 * Version:         1.0.1
 * Author:          esstat17
 * Author URI:      https://profiles.wordpress.org/esstat17/
 * Text Domain:     mnm-txt
 *
 *
 * @package         MNM
 * @author          esstat17
 * @copyright       Copyright (c) 2016 
 *
 * @todo Replace only if your creating your own Plugin
 * @todo replace Plugin Name
 * @todo replace Plugin URI
 * @todo replace Description
 * @todo replace Version
 * @todo replace Text Domain
 * @todo replace Author
 * @todo replace Author URI
 *
 * @todo Mobile_Navigation_Menu - Find all and replace text
 * @todo MNM - Find all and replace text
 * @todo mnm - Find all and replace text
 * @todo MOBILE_NAVIGATION_MENU - Find all and replace text
 *
 *
 * IMPORTANT! Ensure that you make the following amendments
 * before releasing your extension:
 *
 * Copyright 2016 (email : esstat17 at GMAIL.com)
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as
 * published by the Free Software Foundation.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Mobile_Navigation_Menu
 * @subpackage Mobile_Navigation_Menu/includes
 */
if( !class_exists( 'Mobile_Navigation_Menu' ) ) {

    /**
     * Main Mobile_Navigation_Menu class
     *
     * @since       1.0.0
     */
    class Mobile_Navigation_Menu {
        /**
         * @var         object $instance self assigning 
         * @since       1.0.0
         */
        private static $instance;

        /**
         * The unique identifier of this plugin.
         *
         * @since    1.0.0
         * @access   protected
         * @var      string    $plugin_name    The string used to uniquely identify this plugin.
         */
        private $plugin_name;

        /**
         * The Class Constructor
         */
        public function __construct() {
            $this->plugin_name = 'mobile-navigation-menu';
            $this->setup_constants();
            $this->includes();    
            do_action('mnm_hooks'); // This function invokes all functions attached to `mnm_hooks` action hook 
        }

        /**
         * Get active instance
         *
         * @access      public
         * @since       1.0.0
         * @return      object self::$instance The one true NoteForPost
         */
        public static function instance() {
            if( !self::$instance ) {
                self::$instance = new self(); // // assigning the new Class Instance
            }
            return self::$instance;
        }

        /**
         * Define constant if not already set.
         *
         * @param  string $name
         * @param  string|bool $value
         */
        private function define( $name, $value ) {
            if ( ! defined( $name ) ) {
                define( $name, $value );
            }
        }

        /**
         * Setup plugin constants
         *
         * @access      private
         * @since       1.0.0
         * @return      void
         */
        private function setup_constants() {
            // Plugin version
            $this->define( 'MOBILE_NAVIGATION_MENU_VER', '1.0.0' );
            // Plugin path
            $this->define( 'MOBILE_NAVIGATION_MENU_DIR', plugin_dir_path( __FILE__ ) );
            // Plugin URL
            $this->define( 'MOBILE_NAVIGATION_MENU_URL', plugin_dir_url( __FILE__ ) );

            // Attaching to Post Type: post (default)
            // Getting the value from get_option() or `post` as default
            $post_type = !get_option('mnm_option_1') ? 'post' : get_option('mnm_option_1'); 
            $this->define( 'MOBILE_NAVIGATION_MENU_PTYPE', $post_type);
        }
        
        /**
         * Run action and filter hooks
         *
         * @access      private
         * @since       1.0.0
         * @return      void
         *
         * @todo        The hooks listed in this section are a guideline, and
         *              may or may not be relevant to your particular plugin.
         *              Please remove any unnecessary lines, and refer to the
         *              WordPress codex documentation for additional
         *              information on the included hooks.
         *
         *              This method should be used to add any filters or actions
         *              that are necessary to the core of your extension only.
         *              Hooks that are relevant to meta boxes, widgets and
         *              the like can be placed in their respective files.
         * 
         * @see Add Action Hook at https://developer.wordpress.org/reference/functions/add_action/
         * @see Add Filter Hook at https://developer.wordpress.org/reference/functions/add_filter/
         */

        /**
         * Include necessary files
         *
         * @access      private
         * @since       1.0.0
         * @return      void
         */
        private function includes() {
            /**
             * @todo    Make Sure to only include the file(s) you need
             *
             */

            // Frontend Includes
            if ( !is_admin() ) {

                // Enqueue Scripts in the Public
                require_once MOBILE_NAVIGATION_MENU_DIR . 'includes/enqueue-scripts.php'; 

                // Add Inline CSS and JS
                require_once MOBILE_NAVIGATION_MENU_DIR . 'includes/wp-head-footer.php';             
            }

            // Admin Includes
            if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {

                // Enqueue Scripts in the Admin
                require_once MOBILE_NAVIGATION_MENU_DIR . 'includes/admin/admin-enqueue-scripts.php';
              
                // Sub Menu for Settings 
                require_once MOBILE_NAVIGATION_MENU_DIR . 'includes/admin/admin_menu.php';

             }
        }

        /**
         * The name of the plugin used to uniquely identify it within the context of
         * WordPress and to define internationalization functionality.
         *
         * @since     1.0.0
         * @return    string    The name of the plugin.
         */
        public function get_plugin_name() {
            return $this->plugin_name;
        }

    }
} // End if class_exists check


function MNM() {
    return Mobile_Navigation_Menu::instance();
}
// Run the Plugin Instance
MNM();

