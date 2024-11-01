<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class VisitorLab {

	public function __construct()
	{
		
	}

	public function init() 
	{
		$this->init_admin();
    	$this->enqueue_script();
    	$this->enqueue_admin_styles();
	}

	public function init_admin() {
		register_setting( 'visitorlab', 'visitorlab_script' );
    	add_action( 'admin_menu', array( $this, 'create_nav_page' ) );
	}

	public function create_nav_page() {

		$imageresponse = wp_remote_get( plugins_url( '../admin/static/iconsm.svg', __FILE__ ) );
		
		$imageData = base64_encode(  strval(wp_remote_retrieve_body( $imageresponse ))  );

		add_menu_page(
		  esc_html__( 'VisitorLab', 'visitorlab' ), 
		  esc_html__( 'VisitorLAB', 'visitorlab' ), 
		  'manage_options',
		  'visitorlab_settings',
		  array($this,'admin_view'),
		  'data:image/svg+xml;base64,' . $imageData,
		  188
		);
	}

	public static function admin_view()
	{
		require_once plugin_dir_path( __FILE__ ) . '/../admin/views/settings.php';
	}

	public static function visitorlab_script()
	{
		$visitorlab_script = get_option( 'visitorlab_script' );
		$is_admin = is_admin();

		$visitorlab_script = trim($visitorlab_script);
		if (!$visitorlab_script) {
			return;
		}

		if ( $is_admin ) {
			return;
		}

		echo $visitorlab_script;
	}

	private function enqueue_script() {
		add_action( 'wp_footer', array($this, 'visitorlab_script') );
	}

    private function enqueue_admin_styles() {
        add_action( 'admin_enqueue_scripts', array($this, 'visitorlab_admin_styles' ) );
    }

    public static function visitorlab_admin_styles() {
        wp_register_style( 'visitorlab_custom_admin_style', plugins_url( '../admin/static/visitorlab-admin.css', __FILE__ ), array(), '20190701', 'all' );
        wp_enqueue_style( 'visitorlab_custom_admin_style' );
    }

}

?>
