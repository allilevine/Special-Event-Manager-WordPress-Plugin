<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/allilevine/Special-Event-Manager-WordPress-Plugin
 * @since      1.0.0
 *
 * @package    Special_Event_Manager
 * @subpackage Special_Event_Manager/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/public
 * @author     Your Name <email@example.com>
 */
class Plugin_Name_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/special-event-manager-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/plugin-name-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
 * Returns custom template file if sem_event
 *
 * @since 1.0
 */
public function assign_new_template( $template ) {

    // Post ID
		global $post;

		// For all other CPT
    if ( get_post_type( $post->ID ) != 'sem_event' ) {
        return $template;
    }

		function get_template_hierarchy( $template ) {

				// Check if a custom template exists in the theme folder, if not, load the plugin template file
				if ( $theme_file = locate_template( array( 'plugin_template/' . $template ) ) ) {
						$file = $theme_file;
				} else {
						$file = plugin_dir_path( __FILE__ ) . 'partials/' . $template;
				}

				return $file;
		}

    // Else use custom template
    if ( is_single() ) {
        return get_template_hierarchy( 'single-sem_event.php' );
    } elseif ( is_archive() ) {
			return get_template_hierarchy( 'archive-sem_event.php' );
    }

} // end assign_new_template

/**
* Modify template queries
*
* @since 1.0
*/
public function modify_template_query($query) {

	// do not modify queries in the admin
	if( is_admin() ) {

		return $query;

	}

// order sem_events by start date
	if( isset($query->query_vars['post_type']) && $query->query_vars['post_type'] == 'sem_event' ) {


			$query->set('orderby', 'meta_value_num');
			$query->set('meta_key', 'sem_events_startdate');
			$query->set('order', 'ASC');
			$query->set('posts_per_page', '1000');

		}


		// return
		return $query;

}



}
