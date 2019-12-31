<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    WF_List_Generator
 * @subpackage WF_List_Generator/admin
 * @author     WPFeel <email@example.com>
 */
class WFLG_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * The post type of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $post_type    The current post type of this plugin.
	 */
	private $post_type;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->post_type = 'wf-list-generator';
		add_action( 'init', array($this, 'wflg_init') );
		add_action( 'init', array($this, 'wflg_post_type') );
		add_action( 'admin_menu', array($this, 'wflg_add_menu') );
		add_action( 'admin_init', array($this, 'wflg_admin_includes') );

	}

	/**
	 * Init Function
	 *
	 * @since    1.0.0
	 */
	public function wflg_init() {

	}

    /**
     * Register wf-list-generator post type
     *
     * @since  1.0.0
     * @return void
     */
    public function wflg_post_type() {
        $post_type = $this->post_type;

        /**
         * Register post type
         */
        $labels = array(
            'name'               => esc_html__('WF List Generator', 'wf-list-generator'),
            'singular_name'      => esc_html__('WF List Generator', 'wf-list-generator'),
            'menu_name'          => esc_html__('WF List Generator', 'wf-list-generator'),
            'name_admin_bar'     => esc_html__('WF List Generator', 'wf-list-generator'),
            'add_new'            => esc_html__('Add New', 'wf-list-generator'),
            'add_new_item'       => esc_html__('Add New Lists', 'wf-list-generator'),
            'new_item'           => esc_html__('New Lists', 'wf-list-generator'),
            'edit_item'          => esc_html__('Edit Lists', 'wf-list-generator'),
            'view_item'          => esc_html__('View Lists', 'wf-list-generator'),
            'all_items'          => esc_html__('All Lists', 'wf-list-generator'),
            'search_items'       => esc_html__('Search Lists', 'wf-list-generator'),
            'parent_item_colorn' => null,
            'not_found'          => esc_html__('No lists found', 'wf-list-generator'),
            'not_found_in_trash' => esc_html__('No lists found in trash', 'wf-list-generator')
        );

        $args = array(
            'labels'               => $labels,
            'description'          => esc_html__('Add new list from here', 'wf-list-generator'),
            'public'               => true,
            'public_queryable'     => true,
            'exclude_from_search'  => false,
            'show_ui'              => true,
            'show_in_menu'         => true,
            'show_in_admin_bar'    => true,
            'query_var'            => true,
            'capability_type'      => 'post',
            'hierarchical'         => true,
            'menu_position'        => 5,
            'show_in_rest'         => true,
            'menu_icon'            => 'dashicons-book',
            'supports'             => array('title', 'thumbnail', 'author', 'revisions', 'custom-fields')
        );
        register_post_type( $post_type, $args );
        flush_rewrite_rules();

        /**
         * Register list category taxonomy
         */
        $category_labels = array(
            'name'             => esc_html__('List Categories', 'wf-list-generator'),
            'singular_name'    => esc_html__('List Category', 'wf-list-generator'),
            'all_items'        => esc_html__('List Categories', 'wf-list-generator'),
            'parent_item'      => esc_html__('Parent List Category', 'wf-list-generator'),
            'parent_item_colon'=> esc_html__('Parent List Category:', 'wf-list-generator'),
            'edit_item'        => esc_html__('Edit Category', 'wf-list-generator'),
            'update_item'      => esc_html__('Update Category', 'wf-list-generator'),
            'add_new_item'     => esc_html__('Add New Category', 'wf-list-generator'),
            'new_item_name'    => esc_html__('New List Name', 'wf-list-generator'),
            'menu_name'        => esc_html__('Categories', 'wf-list-generator')
        );

        $category_args = array(
            'hierarchical'      => true,
            'public'            => true,
            'labels'            => $category_labels,
            'show_ui'           => true,
            'show_in_rest'      => true,
            'show_admin_column' => true,
            'rewrite'           => 'list-category'
        );
        register_taxonomy('list-category', array($post_type), $category_args);
    }

	/**
	 * Admin menu add Function
	 *
	 * @since    1.0.0
	 */
	public function wflg_add_menu() {
        $menu_slug = 'edit.php?post_type=wf-list-generator';

	    $sub_menus = apply_filters('wflg_sub_menu_filter', array(
            'wflg-settings' => array(
                'title' => __('Settings', 'wf-list-generator'),
                'capability' => 'manage_options',
                'callback' => 'wflg_menu_callback'
            ),
            'wflg-help' => array(
                'title' => __('Help', 'wf-list-generator'),
                'capability' => 'manage_options',
                'callback' => 'wflg_menu_callback'
            )

        ));

		//add submenu to wflg menu
        foreach( $sub_menus as $slug => $options ) {
            add_submenu_page( $menu_slug, $options['title'], $options['title'], $options['capability'], $slug, array($this, $options['callback']) );
        }
	}

	/**
	 * Admin menu callback function
	 *
	 * @since    1.0.0
	 */

	public function wflg_menu_callback() {

		switch ($_GET['page']) {

			case 'wflg-settings':
				include('partials/wflg-option-page.php');
				break;
			
			default:
				include('partials/wflg-option-page.php');
				break;
		}
		
	}

    /**
     * Admin includes
     *
     * @since    1.0.0
     */
	public function wflg_admin_includes() {
        include('partials/classes/class-wflg-settings.php');
    }

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wflg-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wflg-admin.js', array( 'jquery' ), $this->version, false );

	}

}
