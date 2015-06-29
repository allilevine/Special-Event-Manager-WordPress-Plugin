<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/allilevine/Special-Event-Manager-WordPress-Plugin
 * @since      1.0.0
 *
 * @package    Special_Event_Manager
 * @subpackage Special_Event_Manager/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Special_Event_Manager
 * @subpackage Special_Event_Manager/admin
 * @author     Your Name <email@example.com>
 */
class Special_Event_Manager_Admin {

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
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/special-event-manager-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'pikadaycss', plugin_dir_url( __FILE__ ) . 'css/pikaday.css', array(), $this->version, 'all' );

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

		wp_enqueue_script( 'moment', plugin_dir_url( __FILE__ ) . 'js/moment.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'pikaday', plugin_dir_url( __FILE__ ) . 'js/pikaday.js', array( 'moment' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/special-event-manager-admin.js', array( 'pikaday' ), $this->version, false );

	}

	/**
	* Create the custom post type.
	*
	* @since    1.0.0
	*/
	public function create_custom_post_type() {
			register_post_type( 'sem_event',
			array( 'labels' => array(
			'name' => __( 'Events', 'SEM' ), /* This is the Title of the Group */
			'singular_name' => __( 'Event', 'SEM' ), /* This is the individual type */
			'all_items' => __( 'Events', 'SEM' ), /* the all items menu item */
			'add_new' => __( 'Add New', 'SEM' ), /* The add new menu item */
			'add_new_item' => __( 'Add New Event', 'SEM' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'SEM' ), /* Edit Dialog */
			'edit_item' => __( 'Edit Event', 'SEM' ), /* Edit Display Title */
			'new_item' => __( 'New Event', 'SEM' ), /* New Display Title */
			'view_item' => __( 'View Event', 'SEM' ), /* View Display Title */
			'search_items' => __( 'Search Events', 'SEM' ), /* Search Custom Type Title */
			'not_found' =>  __( 'Nothing found in the Database.', 'SEM' ), /* This displays if there are no entries yet */
			'not_found_in_trash' => __( 'Nothing found in Trash', 'SEM' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'This is the special event post type', 'SEM' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */
			'menu_icon' => 'dashicons-calendar', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'event', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'events', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			'taxonomies' => array('special-event-category', 'special-event-tag'),
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions', 'sticky')
			) /* end of options */
		); /* end of register post type */

		}

	/**
	* Create the custom taxonomy.
	*
	* @since    1.0.0
	*/
	public function create_custom_taxonomy() {
		register_taxonomy( 'special-event-category',
			array('sem_event'), /* the name of the custom post type */
			array('hierarchical' => true,     /* if this is true, it acts like categories vs. tags */
				'labels' => array(
					'name' => __( 'Event Categories', 'SEM' ), /* name of the custom taxonomy */
					'singular_name' => __( 'Event Category', 'SEM' ), /* single taxonomy name */
					'search_items' =>  __( 'Search Event Categories', 'SEM' ), /* search title for taxomony */
					'all_items' => __( 'All Event Categories', 'SEM' ), /* all title for taxonomies */
					'parent_item' => __( 'Parent Event Category', 'SEM' ), /* parent title for taxonomy */
					'parent_item_colon' => __( 'Parent Event Category:', 'SEM' ), /* parent taxonomy title */
					'edit_item' => __( 'Edit Event Category', 'SEM' ), /* edit custom taxonomy title */
					'update_item' => __( 'Update Event Category', 'SEM' ), /* update title for taxonomy */
					'add_new_item' => __( 'Add New Event Category', 'SEM' ), /* add new title for taxonomy */
					'new_item_name' => __( 'New Event Category Name', 'SEM' ) /* name title for taxonomy */
				),
				'show_admin_column' => true,
				'show_ui' => true,
				'query_var' => true,
				'rewrite' => array( 'slug' => 'event-category' )
			)
		);

		// custom tags
	register_taxonomy( 'special-event-tag',
		array('sem_event'), /* the name of the custom post type */
		array('hierarchical' => false,    /* if this is false, it acts like tags */
			'labels' => array(
				'name' => __( 'Event Tags', 'SEM' ), /* name of the custom taxonomy */
				'singular_name' => __( 'Event Tag', 'SEM' ), /* single taxonomy name */
				'search_items' =>  __( 'Search Event Tags', 'SEM' ), /* search title for taxomony */
				'all_items' => __( 'All Event Tags', 'SEM' ), /* all title for taxonomies */
				'parent_item' => __( 'Parent Event Tag', 'SEM' ), /* parent title for taxonomy */
				'parent_item_colon' => __( 'Parent Event Tag:', 'SEM' ), /* parent taxonomy title */
				'edit_item' => __( 'Edit Event Tag', 'SEM' ), /* edit custom taxonomy title */
				'update_item' => __( 'Update Event Tag', 'SEM' ), /* update title for taxonomy */
				'add_new_item' => __( 'Add New Event Tag', 'SEM' ), /* add new title for taxonomy */
				'new_item_name' => __( 'New Event Tag Name', 'SEM' ) /* name title for taxonomy */
			),
			'show_admin_column' => true,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'event-tag' )
		)
	);

	} /* end custom taxonomy */

	/**
	* Create the custom meta box for event start and end dates.
	*
	* @since    1.0.0
	*/
	public function create_custom_meta_box() {
		add_meta_box('special_event_meta', 'Event Date & Time', array( $this, 'render_special_event_meta_box'), 'sem_event', 'side', 'high');
	}

	/**
	* Requires the file that is used to display the user interface of the post meta box.
	*/
	public function render_special_event_meta_box() {
			require_once plugin_dir_path( __FILE__ ) . 'partials/special-event-manager-admin-display.php';
	}

	/**
	* Save the meta box data
	*/
	public function custom_meta_box_save($post_id, $post) {

		// Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return $post_id;

    // if our nonce isn't there, or we can't verify it, bail
		if ( isset($_POST['SEM-events-nonce']) && !wp_verify_nonce( $_POST['SEM-events-nonce'], 'SEM-events-nonce' )) {
				return $post_id;
		}

		// if our current user can't edit this post, bail
		if ( !current_user_can( 'edit_post', $post_id ))
			        return $post_id;


	    // - convert back to unix & update post

	    if(!isset($_POST["sem_events_startdate"])):
	        return $post;
	        endif;
	        $updatestartdate = strtotime ( $_POST["sem_events_startdate"] . $_POST["sem_events_starttime"] );
	        update_post_meta($post_id, "sem_events_startdate", $updatestartdate );

	    if(!isset($_POST["sem_events_enddate"])):
	        return $post;
	        endif;
	        $updateenddate = strtotime ( $_POST["sem_events_enddate"] . $_POST["sem_events_endtime"]);
	        update_post_meta($post_id, "sem_events_enddate", $updateenddate );
	}

}
