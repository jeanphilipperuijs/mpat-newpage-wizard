<?php
/*
 * Plugin Name: MPAT New Page Wizard
 * Plugin URI: https://github.com/jeanphilipperuijs/npw
 * Description: Wizard for MPAT-project when creating a new page allowing to choose or create a page_layout.
 * Version: 1.0.0
 * Author: MPAT
 * Author URI: https://github.com/jeanphilipperuijs
 * Text Domain: mpat-new-page-wizard
 * Domain Path: /
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

add_action('wp_loaded', "wiztemplate");
    
function wiztemplate()
{
    $url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
    if ($url_path === 'mpat-new-page-wizard' || endsWith($url_path, '/mpat-new-page-wizard')) {
          header("Content-Type: text/html;");
?>
<html>
    <head>
        <title>New Page Wizard</title>
        <?php
// var_dump(is_user_logged_in());
// var_dump(wp_get_current_user());
            wp_enqueue_script( 'wp-api' );
          // wp_register_script('mpat_admin', '/app/plugins/mpat-plugins/js/mpat_admin.min.js', array('wp-api'), 1.0, true );
          // wp_head();
        ?>
    </head>
    <body>
    <h1>New Page Wizard</h1>
    <button class="wp-button" onClick="javascript:loadLayouts()">loadLayouts</button>
    <button class="wp-button" onClick="javascript:loadPages()">loadPages</button>
    <div id="wp-content">
    <p id="result"></p>
    <pre id="raw"><pre>
    <?php
        wp_footer();
    ?>
    </div>
</body>
<script type="text/javascript" src="<?php echo plugin_dir_url(__FILE__); ?>rui.js" ></script>
</html>
<?php
      exit();
    }
}

function endsWith($haystack, $needle)
{
    $length = strlen($needle);
    if ($length == 0) {
        return true;
    }
    return (substr($haystack, -$length) === $needle);
}
?>