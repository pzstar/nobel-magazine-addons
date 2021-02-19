<?php

/**
 * Plugin Name: Nobel Magazine Addons
 * Plugin URI: 
 * Description: Elementor addons
 * Version: 1.0.
 * Author: Nobel Themes
 * Author URI:  
 * Text Domain: nobel-magazine
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /languages
 *
 */
// If this file is called directly, abort.
if (!defined('WPINC')) {
    die();
}

define('NMA_VERSION', '1.0.0');

define('NMA_FILE', __FILE__);
define('NMA_PLUGIN_BASENAME', plugin_basename(NMA_FILE));
define('NMA_PATH', plugin_dir_path(NMA_FILE));
define('NMA_URL', plugins_url('/', NMA_FILE));

define('NMA_ASSETS_URL', NMA_URL . 'assets/');


// If class `Nobel_Magazine_Addons_Elements` doesn't exists yet.
if (!class_exists('Nobel_Magazine_Addons')) {

    /**
     * Sets up and initializes the plugin.
     */
    class Nobel_Magazine_Addons {

        /**
         * A reference to an instance of this class.
         *
         * @since  1.0.0
         * @access private
         * @var    object
         */
        private static $instance = null;

        /**
         * Plugin version
         *
         * @var string
         */
        private $version = NMA_VERSION;

        /**
         * Returns the instance.
         *
         * @since  1.0.0
         * @access public
         * @return object
         */
        public static function get_instance() {
            // If the single instance hasn't been set, set it now.
            if (null == self::$instance) {
                self::$instance = new self;
            }
            return self::$instance;
        }

        /**
         * Sets up needed actions/filters for the plugin to initialize.
         *
         * @since 1.0.0
         * @access public
         * @return void
         */
        public function __construct() {

            // Load translation files
            add_action('init', array($this, 'load_plugin_textdomain'));
            
            add_action('good_magazine_new_options', array($this, 'good_magazine_theme_options'), 10, 1);

            // Load necessary files.
            add_action('plugins_loaded', array($this, 'init'));
        }

        /**
         * Loads the translation files.
         *
         * @since 1.0.0
         * @access public
         * @return void
         */
        public function load_plugin_textdomain() {
            load_plugin_textdomain('nobel-magazine-addons', false, basename(dirname(__FILE__)) . '/languages');
        }

        /**
         * Returns plugin version
         *
         * @return string
         */
        public function get_version() {
            return $this->version;
        }

        /**
         * Manually init required modules.
         *
         * @return void
         */
        public function init() {

            // Check if Elementor installed and activated
            if (!did_action('elementor/loaded')) {
                add_action('admin_notices', array($this, 'required_plugins_notice'));
                return;
            }

            require( NMA_PATH . 'includes/widget-loader.php' );
            require( NMA_PATH . 'includes/helper-functions.php' );

            if ('yes' !== get_option('elementor_disable_color_schemes')) {
                update_option('elementor_disable_color_schemes', 'yes');
            }

            if ('yes' !== get_option('elementor_disable_typography_schemes')) {
                update_option('elementor_disable_typography_schemes', 'yes');
            }
        }

        /**
         * Show recommended plugins notice.
         *
         * @return void
         */
        public function required_plugins_notice() {
            $screen = get_current_screen();
            if (isset($screen->parent_file) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id) {
                return;
            }

            $plugin = 'elementor/elementor.php';

            if ($this->is_elementor_installed()) {
                if (!current_user_can('activate_plugins')) {
                    return;
                }

                $activation_url = wp_nonce_url('plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin);
                $admin_message = '<p>' . esc_html__('Ops! Nobel Magazine Elements is not working because you need to activate the Elementor plugin first.', 'nobel-magazine-addons') . '</p>';
                $admin_message .= '<p>' . sprintf('<a href="%s" class="button-primary">%s</a>', $activation_url, esc_html__('Activate Elementor Now', 'nobel-magazine-addons')) . '</p>';
            } else {
                if (!current_user_can('install_plugins')) {
                    return;
                }

                $install_url = wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=elementor'), 'install-plugin_elementor');
                $admin_message = '<p>' . esc_html__('Ops! Nobel Magazine Elements is not working because you need to install the Elementor plugin', 'nobel-magazine-addons') . '</p>';
                $admin_message .= '<p>' . sprintf('<a href="%s" class="button-primary">%s</a>', $install_url, esc_html__('Install Elementor Now', 'nobel-magazine-addons')) . '</p>';
            }

            echo '<div class="error">' . $admin_message . '</div>';
        }

        /**
         * Check if theme has elementor installed
         *
         * @return boolean
         */
        public function is_elementor_installed() {
            $file_path = 'elementor/elementor.php';
            $installed_plugins = get_plugins();

            return isset($installed_plugins[$file_path]);
        }

        /** Customizer Theme Options */
        public function good_magazine_theme_options($wp_customize) {
            
            $wp_customize->add_control(new Good_Magazine_Control_Tab($wp_customize, 'good_magazine_top_header_nav', array(
                'type' => 'tab',
                'section' => 'good_magazine_top_header_options',
                'priority' => 1,
                'buttons' => array(
                    array(
                        'name' => esc_html__('Content', 'good-magazine'),
                        'fields' => array(
                            'good_magazine_new_top_header_display',
                            'good_magazine_top_header_display',
                            'good_magazine_th_left_display',
                            'good_magazine_th_center_display',
                            'good_magazine_th_right_display',
                            'good_magazine_social_link',
                            'good_magazine_th_menu',
                            'good_magazine_th_widget',
                            'good_magazine_th_text',
                        ),
                        'active' => true,
                    ),
                    array(
                        'name' => esc_html__('Style', 'good-magazine'),
                        'fields' => array(
                            'good_magazine_th_height',
                            'good_magazine_th_bg_color',
                            'good_magazine_th_bottom_border_color',
                            'good_magazine_th_text_color',
                            'good_magazine_th_anchor_color',
                        ),
                    ),
                ),
            )));
            
            $wp_customize->add_setting('good_magazine_new_top_header_display', array(
                'sanitize_callback' => 'good_magazine_sanitize_text',
                'default' => 'none'
            ));

            $wp_customize->add_control('good_magazine_new_top_header_display', array(
                'section' => 'good_magazine_top_header_options',
                'type' => 'select',
                'label' => esc_html__('Top New Header Display', 'meta-store'),
                'choices' => array(
                    'none' => esc_html__('None', 'meta-store'),
                    'center' => esc_html__('Center', 'meta-store'),
                    'left' => esc_html__('Left', 'meta-store'),
                    'right' => esc_html__('Right', 'meta-store'),
                    'left-right' => esc_html__('Left & Right', 'meta-store'),
                )
            ));
        }

    }

}

if (!function_exists('nobel_magazine_addons')) {

    /**
     * Returns instanse of the plugin class.
     *
     * @since  1.0.0
     * @return object
     */
    function nobel_magazine_addons() {
        return Nobel_Magazine_Addons::get_instance();
    }

}

nobel_magazine_addons();
