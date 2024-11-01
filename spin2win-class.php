<?php
/**
* Restricting user to access this file directly (Security Purpose).
**/
if( !defined( 'ABSPATH' ) ) {
    die( "You Don't Have Permission To Access This Page" );
    exit;
}

class SPIN2WIN_AdminClass {
    public function __construct() {
        add_action( 'admin_enqueue_scripts', array($this,'spin2win_enqueue_custom_admin_style_and_script') );        
        add_action( 'admin_menu', array($this, 'wpdocs_register_my_custom_menu_page') );
        add_action( 'admin_init', array($this,'spin2winp_register_settings') );
    }
    /**
    * Register and enqueue a custom stylesheet in the WordPress admin.
    */
    public function spin2win_enqueue_custom_admin_style_and_script() {
        wp_enqueue_script( 'Winwheel', plugin_dir_url( __FILE__ ).'js/Winwheel.js', array(), SPIN2WINP_PLUGIN_VERSION, false ); 
        wp_enqueue_script( 'tweenmax', plugin_dir_url( __FILE__ ).'js/TweenMax.min.js', array(), SPIN2WINP_PLUGIN_VERSION, false );
        // Register the script
        wp_register_script( 'spin2winConfiguration', plugin_dir_url( __FILE__ ).'admin/admin.js', array('wp-color-picker', 'jquery-ui-tabs', 'jquery'), SPIN2WINP_PLUGIN_VERSION, true );
        
        // Localize the script with new data
        $translation_array = get_option( SPIN2WINP_TEXT_DOMAIN );
        wp_localize_script( 'spin2winConfiguration', 'SPIN2WINP', $translation_array );
        // Enqueued script with localized data.
        wp_enqueue_script( 'spin2winConfiguration' );
        wp_enqueue_style( 'spin2win-css', plugin_dir_url( __FILE__ ).'admin/style.css' );
    }
    
    /**
    * Register a custom menu page.
    */
    function wpdocs_register_my_custom_menu_page() {
        add_menu_page( 
            __( 'Spin2Win', SPIN2WINP_TEXT_DOMAIN ), 
            __( 'Spin2Win',SPIN2WINP_TEXT_DOMAIN ), 
            'manage_options', 
            SPIN2WINP_TEXT_DOMAIN, array( $this, 'spin2winp_plugin_setting_page' ),
            SPIN2WINP_PLUGIN_URL. "admin/spin2winsmall.png",
            6
        );
        
        add_submenu_page( SPIN2WINP_TEXT_DOMAIN, __( 'Spin2Win',SPIN2WINP_TEXT_DOMAIN ), __( '&nbsp; Settings',SPIN2WINP_TEXT_DOMAIN ), 'manage_options', SPIN2WINP_TEXT_DOMAIN, array( $this, 'spin2winp_plugin_setting_page' ) );
        add_submenu_page( SPIN2WINP_TEXT_DOMAIN, __( 'Spin2Win',SPIN2WINP_TEXT_DOMAIN ), __( '&nbsp; FAQ',SPIN2WINP_TEXT_DOMAIN ), 'manage_options', SPIN2WINP_TEXT_DOMAIN . '-about', array( $this, 'spin2winp_plugin_about_page' ) );
    }
    /**
    * Add menu template
    **/
    public function spin2winp_plugin_setting_page() {
        include SPIN2WINP_PLUGIN_DIR.'admin/spin2win-admin.php';
    }
    public function spin2winp_plugin_about_page() {
        include SPIN2WINP_PLUGIN_DIR.'admin/spin2win-faq.php';
    }
  
    /**
    * Register settings for plugin
    **/
    function spin2winp_register_settings() {
        register_setting( SPIN2WINP_TEXT_DOMAIN, SPIN2WINP_TEXT_DOMAIN,'spin2winp_sanatize_setting'  );
    }
    
    /**
    * Sanitizing the submitted text
    **/
    function spin2winp_sanatize_setting( $settings ) {
        $settings['share_text'] = trim( strip_tags( $settings['share_text'] ) );
        return $settings;
    }
    
    /**
    * Register Default Setting When Plugin Activate
    **/
    public function spin2win_setDefault_values(){
        $default_values = array(
            'spin2win_view_btn_text'        => 'Spin 2 Win',
            'spin2win_view_btn_bg_color'    => "#da0000",
            'spin2win_view_btn_color'       => "#fff",
            'spin2win_result_view'          => "You win {{prize}} prize. Submit your email here to find out how to redeem your prize.",
            'spin2win_result_after_submit'  => 'Thanks for subscribed',
            'spin2win_background_img'       => SPIN2WINP_PLUGIN_URL. "img/wheel_back.png",
            'enable'                        => "1",
            'settings'  => array(
                    'innerRadius'   => 0,
                    'outerRadius'   => 212,
                    'lineWidth'     => 10,
                    'strokeStyle'   => "#da0000",
                    'textFontSize'  => "25",
                    'fillStyle'     => "silver",
                    'textFontFamily'    => "Arial",
                    'textFontWeight'    => 'bold',
                    'textOrientation'   => 'curved',
                    'textAlignment'     => 'center',
                    'textDirection'     => 'normal',
                    'textMargin'        => 0,
                    'textFillStyle'     => '#fff',
                    'textStrokeStyle'   => 0,
                    'textLineWidth'     => 1,
                    'numSegments'       => 4,
                ),
                
            'segments'  => array(
                array('fillStyle' => '#eae56f', 'text' => 'Prize 1'),
                array('fillStyle' => '#89f26e', 'text' => 'Prize 2'),
                array('fillStyle' => '#a06ded', 'text' => 'Prize 3'),
                array('fillStyle' => '#052ab2', 'text' => 'Prize 4'),
            ),    
            'animation' => array(
                'duration' => 5,     // Duration in seconds.
                'spins'    => 4,     // Number of complete spins.
            ),
            'display' => array(
                'exit_intent' => 1,
                'time'        => 1
            )
        );
        update_option( SPIN2WINP_TEXT_DOMAIN, $default_values );
    }
    
    /**
    * Delete Default Value When Plugin Deactivate
    **/
    public function spin2win_deleteDefault_values() {
        delete_option( SPIN2WINP_TEXT_DOMAIN );
    }
}

/**
 * Front end class
 */
class SPIN2WIN_PublicClass{
    
    public function __construct() {
        add_action('wp_footer', array($this, 'add_spin_2_win_html') );
        add_action("wp_enqueue_scripts", array($this, "spin_2_win_add_scripts") );
    }
    
    public function add_spin_2_win_html() {
        ob_start();
        include plugin_dir_path(__FILE__). 'spin2win-html.php';
        $contents = ob_get_clean();
        echo $contents;
    }

    public function spin_2_win_add_scripts() {
        wp_enqueue_script( 'bootstrap-js', plugin_dir_url( __FILE__ ).'js/bootstrap.min.js', array('jquery'), '201709061', true );
        wp_enqueue_script( 'Winwheel', plugin_dir_url( __FILE__ ).'js/Winwheel.js', array(), '201709061', false ); 
        wp_enqueue_script( 'tweenmax', plugin_dir_url( __FILE__ ).'js/TweenMax.min.js', array(), '201709061', false );
        wp_enqueue_script( "ouibounce", plugin_dir_url( __FILE__ ).'js/ouibounce.js', array(), '201709061', false);
        // Register the script
        wp_register_script( 'spin2winConfiguration', plugin_dir_url( __FILE__ ).'js/spin2win-configuration.js', array('jquery'), SPIN2WINP_PLUGIN_VERSION, true );
        
        // Localize the script with new data
        $translation_array = get_option( SPIN2WINP_TEXT_DOMAIN );
        $translation_array['ajax_url'] = admin_url('admin-ajax.php');
        wp_localize_script( 'spin2winConfiguration', 'SPIN2WINP', $translation_array );
        // Enqueued script with localized data.
        wp_enqueue_script( 'spin2winConfiguration' );

        wp_enqueue_style( "bootstrap", plugin_dir_url( __FILE__ ).'css/bootstrap.min.css', array(), '201709061' );
    }
    
    public function spin2win_mailchimp_subscription(){
        $email = "";
        if( isset($_POST['email_address'])){
            $email = $_POST['email_address'];
        }
        if( $email ){
            $result = SubscribeToMailchimp($email);
            exit($result);
        }
        exit( "error");
    }
    
}

function SubscribeToMailchimp($email_address){
    $translation_array = get_option( SPIN2WINP_TEXT_DOMAIN );
    
    $api_key = $translation_array['spin2win_mailchimp']['api_key'];
    $list_id = $translation_array['spin2win_mailchimp']['list_id'];
    $enable = $translation_array['spin2win_mailchimp']['enable'];
    if( $enable == 0 or $api_key =='' or $list_id == ''){
        return json_encode(array("detail" =>"Something is missing like apikey or list_id", "status" => 400));
    }
    
    $data = array(
         'apikey'        => $api_key,
         'email_address' => $email_address,
         'status'        => "subscribed"
    );
 	$mch_api = curl_init(); // initialize cURL connection

    curl_setopt($mch_api, CURLOPT_URL, 'https://' . substr($api_key,strpos($api_key,'-')+1) . '.api.mailchimp.com/3.0/lists/' . $list_id . '/members/' . md5(strtolower($data['email_address'])));
    curl_setopt($mch_api, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Basic '.base64_encode( 'user:'.$api_key )));
    curl_setopt($mch_api, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
    curl_setopt($mch_api, CURLOPT_RETURNTRANSFER, true); // return the API response
    curl_setopt($mch_api, CURLOPT_CUSTOMREQUEST, 'PUT'); // method PUT
    curl_setopt($mch_api, CURLOPT_TIMEOUT, 10);
    curl_setopt($mch_api, CURLOPT_POST, true);
    curl_setopt($mch_api, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($mch_api, CURLOPT_POSTFIELDS, json_encode($data) ); // send data in json

    return $result = curl_exec($mch_api);
}
