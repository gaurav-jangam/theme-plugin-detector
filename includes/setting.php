<?php

class settings{

    function form_data_list(){
        echo '<h1> Plugins & Themes Detector </h1>
        <div class="setting-head">
        <p>Plugin and Theme Detector plugin allows you to detect which plugin and theme is used by wordpress site.</p>
        <form action="options.php" method="post" class="post-menu-form">';
        echo '<table class="form-table">';
        
        echo '
        <tr><th scope="row">Use Shortcode:</th>
        <td><p>To use Theme Detector Searchform in your pages you can use this shortcode:</p>
        <p><code>[search-box]</code></p>';
    
        echo  '</td></tr> </table>
        </form>
        </div>';
    }
}

$settingspage = new settings(); 
$settingspage->form_data_list();
?>