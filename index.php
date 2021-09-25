<?php
/*
Plugin Name: Plugin and Theme Checker
Plugin URI: https://gauravjangam.com/
Description: Want to check what wordpress plugin and theme it is used in website , Wordpress plugin and theme checker is a free online tool will help you to check the wordpress plugin and theme . simply enter website url and hit button.
Version: 1.0.0
Author: Gaurav Jangam
Author URI: https://gauravjangam.com/
License: GPLv2 or later
Text Domain: Theme and Plugin Checker
*/

defined ('ABSPATH') or die("Access Denied");
define ('PT_PLUGIN_VERSION', '1.0.0');


class PT_Plugin{
    
    function __construct(){
        add_shortcode('search-box', array($this,'shortcode'));
        add_action('wp_enqueue_scripts', array($this,'add_styles'));
        add_action('admin_menu', array($this,'plugin_data_menu'));
    }
    
    function plugin_data_menu(){
        add_menu_page('Detector setting page', 'Theme Detector',8, __FILE__,array($this, 'form_data_list'),'dashicons-search');

    }

    function form_data_list(){
        include_once( plugin_dir_path( __FILE__ ) . 'includes/setting.php' );
    }

    function add_styles(){
        if (is_page('hello-world-confirmation/')) {
        wp_enqueue_style('news-settings-style',plugins_url('includes/css/index.css',__FILE__));
        }
    }
    
    function shortcode() { 
        if(isset($_GET["nameSenda"])){
        $name=  $_GET["nameSenda"];
        $url = "https://www.wpthemedetector.com/ad/addir/themes/WPTD2/wptd_main.php";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
        "Content-Type: application/x-www-form-urlencoded",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $data = "urljs=$name";

        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        curl_close($curl);
                
                ob_start();
        }
        ?>
        <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        </head>
        <div class="outer">
            <form>
                <center>
                <div class="search">
                    <input type="text" placeholder="eg.www.example.com" id="nameSenda" name="nameSenda">
                    <button type="submit" class="searchButton"value="Check" name="submitSenda">
                        <i class="fa fa-search" style="font-size:28px;"></i>
                    </button>
                </div>
                </center>
            </form>
            <div class="theme-name">
            <b><?php 
                    if(isset($_GET["nameSenda"])){
                        echo $resp; 
                    }else{
                    echo "Please Enter a Valid URL";
                }?>
                <br/>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
}

if(class_exists('PT_Plugin')){
    $PT_Plugin = new PT_Plugin;
}
