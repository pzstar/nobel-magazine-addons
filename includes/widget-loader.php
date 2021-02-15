<?php

namespace NobelMagazineAddons;

if (!defined('ABSPATH'))
    exit();

class NMA_Widget_Loader {

    private static $instance = null;

    /**
     * Initialize integration hooks
     *
     * @return void
     */
    public function __construct() {
        spl_autoload_register([$this, 'autoload']);

        $this->includes();
        // Elementor hooks
        $this->add_actions();
    }

    function add_elementor_widget_categories() {

        $groups = array(
            'nobel-magazine-addons' => esc_html__('Nobel Magazine - Elements', 'nobel-magazine-addons')
        );

        foreach ($groups as $key => $value) {
            \Elementor\Plugin::$instance->elements_manager->add_category($key, ['title' => $value], 1);
        }
    }

    /**
     * we loaded module manager + admin php from here
     * @return [type] [description]
     */
    private function includes() {
        require NMA_PATH . 'includes/module-manager.php';
    }

    /**
     * Autoload Classes
     *
     * @since 1.6.0
     */
    public function autoload($class) {
        if (0 !== strpos($class, __NAMESPACE__)) {
            return;
        }

        $has_class_alias = isset($this->classes_aliases[$class]);

        // Backward Compatibility: Save old class name for set an alias after the new class is loaded
        if ($has_class_alias) {
            $class_alias_name = $this->classes_aliases[$class];
            $class_to_load = $class_alias_name;
        } else {
            $class_to_load = $class;
        }

        if (!class_exists($class_to_load)) {

            $filename = strtolower(
                    preg_replace(
                            ['/^' . __NAMESPACE__ . '\\\/', '/([a-z])([A-Z])/', '/_/', '/\\\/'], ['', '$1-$2', '-', DIRECTORY_SEPARATOR], $class_to_load
                    )
            );

            $filename = NMA_PATH . $filename . '.php';
            if (is_readable($filename)) {
                include( $filename );
            }
        }

        if ($has_class_alias) {
            class_alias($class_alias_name, $class);
        }
    }

    /**
     * Add Actions
     *
     * @since 0.1.0
     *
     * @access private
     */
    public function add_actions() {
        add_action('elementor/init', [$this, 'add_elementor_widget_categories']);

        // Fires after Elementor controls are registered.
        add_action('elementor/controls/controls_registered', [$this, 'register_controls']);

        //FrontEnd Scripts
        add_action('elementor/frontend/before_register_scripts', [$this, 'register_frontend_scripts']);
        add_action('elementor/frontend/after_enqueue_scripts', [$this, 'enqueue_frontend_scripts']);

        //FrontEnd Styles
        add_action('elementor/frontend/before_register_styles', [$this, 'register_frontend_styles']);
        add_action('elementor/frontend/after_enqueue_styles', [$this, 'enqueue_frontend_styles']);

        //Editor Scripts
        add_action('elementor/editor/before_enqueue_scripts', [$this, 'enqueue_editor_scripts']);

        //Editor Style
        add_action('elementor/editor/after_enqueue_styles', [$this, 'enqueue_editor_styles']);

        //Fires after Elementor preview styles are enqueued.
        add_action('elementor/preview/enqueue_styles', [$this, 'enqueue_preview_styles']);
    }

    /**
     * Register Controls
     * @since 1.0.0
     * @access public
     */
    public function register_controls() {
        require_once NMA_PATH . 'includes/controls/groups/group-control-query.php';
        require_once NMA_PATH . 'includes/controls/groups/group-control-header.php';

        // Register Group
        \Elementor\Plugin::instance()->controls_manager->add_group_control('nobel-magazine-addons-query', new Group_Control_Query());
        \Elementor\Plugin::instance()->controls_manager->add_group_control('nobel-magazine-addons-header', new Group_Control_Header());
    }

    /**
     * Register Frontend Scripts
     * @since 1.0.0
     * @access public
     */
    public function register_frontend_scripts() {
        
    }

    /**
     * Enqueue Frontend Scripts
     * @since 1.0.0
     * @access public
     */
    public function enqueue_frontend_scripts() {
        wp_enqueue_script('owl-carousel', NMA_URL . 'assets/lib/owl-carousel/js/owl.carousel.min.js', array('jquery'), NMA_VERSION, true);
        wp_enqueue_script('slick', NMA_URL . 'assets/lib/slick/slick.min.js', array('jquery'), NMA_VERSION, true);
        wp_enqueue_script('nobel-magazine-addons-frontend', NMA_URL . 'assets/js/frontend.js', array('jquery'), NMA_VERSION, true);
    }

    /**
     * Register Frontend Styles
     * @since 1.0.0
     * @access public
     */
    public function register_frontend_styles() {
        
    }

    /**
     * Enqueue Frontend Styles
     * @since 1.0.0
     * @access public
     */
    public function enqueue_frontend_styles() {
        wp_enqueue_style('themify-icons', NMA_URL . 'assets/lib/themify-icons/themify-icons.css', array(), NMA_VERSION);
        wp_enqueue_style('owl-carousel', NMA_URL . 'assets/lib/owl-carousel/css/owl.carousel.min.css', array(), NMA_VERSION);
        wp_enqueue_style('nobel-magazine-addons-frontend', NMA_URL . 'assets/css/frontend.css', array(), NMA_VERSION);
    }

    /**
     * Enqueue Editor Scripts
     * @since 1.0.0
     * @access public
     */
    public function enqueue_editor_scripts() {
        wp_enqueue_script('nobel-magazine-addons-editor', NMA_URL . 'assets/js/editor.js', array('jquery'), NMA_VERSION, true);
        wp_localize_script('nobel-magazine-addons-editor', 'is_elementor_pro_installed', $this->is_elementor_pro_installed());
    }

    /**
     * Enqueue Editor Styles
     * @since 1.0.0
     * @access public
     */
    public function enqueue_editor_styles() {
        wp_enqueue_style('nobel-magazine-addons-editor-style', NMA_ASSETS_URL . 'css/editor-styles.css', array(), NMA_VERSION);
    }

    /**
     * Preview Styles
     * @since 1.0.0
     * @access public
     */
    public function enqueue_preview_styles() {
        
    }

    /**
     * Check if theme has elementor Pro installed
     *
     * @return boolean
     */
    public function is_elementor_pro_installed() {
        return function_exists('elementor_pro_load_plugin') ? 'yes' : 'no';
    }

    /**
     * Creates and returns an instance of the class
     * @since 1.0.0
     * @access public
     * return object
     */
    public static function get_instance() {
        if (self::$instance == null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

}

if (!function_exists('nma_widget_loader')) {

    /**
     * Returns an instance of the plugin class.
     * @since  1.0.0
     * @return object
     */
    function nma_widget_loader() {
        return NMA_Widget_Loader::get_instance();
    }

}
nma_widget_loader();
