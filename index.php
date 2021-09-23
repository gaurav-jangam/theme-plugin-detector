<?php
/*
Plugin Name: Theme and Plugin Checker
Description: A simple and easy way to check what Theme and plugin the website uses!
Version: 1.0
Author: Gaurav Jangam
Author URI: https://gauravjangam.com
License: GPLv2 or later
Text Domain: Theme and Plugin Checker
*/

/*
  Proper way to enqueue scripts and styles
 */


define ('HWY_PLUGIN_FILE', __FILE__);
define ('PLUGIN_VERSION', '1.0');

wp_enqueue_style('news-settings-style', 
plugins_url('includes/css/index.css',HWY_PLUGIN_FILE),
array(),
PLUGIN_VERSION);
 
// wp_enqueue_script('news-settings-js', 
// plugins_url('includes/js/api-main.js',HWY_PLUGIN_FILE),
// array('jquery'),
// PLUGIN_VERSION,
// true);



function shortcode() {  
    $name=  $_GET["nameSenda"]; 
    $targetSite = $name; 
    $src = file_get_contents($targetSite);  
    preg_match("/\<link rel='stylesheet'.*href='(.*?style\.css.*?)'.*\>/i",$src,$asasa);
    $styleHref = trim($asasa[1]);
    $styleSrc = file_get_contents($styleHref);
    preg_match("/\Theme Name:(.*?)\n/i",$styleSrc,$name);
    
    
    ob_start();
    ?>
    <div class="Card">
       <div class="CardInner">
           <label>Enter Website URL</label>
                <div class="container">
                    <div class="InputContainer">
                        <div>
                            <form name="formSenda" method="GET" >
                                <input type="text" placeholder="name" id="nameSenda" name="nameSenda">
                                <input type="submit" value="Check" name="submitSenda">
                                </form>
                                <?php echo(trim($name[0]));?>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        <!-- <button id="post-btn">
            Load posts
        </button>
    <div id="post-container"></div> -->
        <?php
        return ob_get_clean();
}

add_shortcode('lorem','shortcode');


