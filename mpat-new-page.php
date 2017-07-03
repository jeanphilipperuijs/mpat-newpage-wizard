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
       // wp_register_script('mpat_app_manager', '/app/plugins/mpat-plugins/js/mpat_app_manager.min.js?webpack', array(), 1.0, true);
        wp_register_script('mpat_admin', '/app/plugins/mpat-plugins/js/mpat_admin.min.js', array('wp-api'), 1.0, true );
        wp_head();
    ?>
  </head>
  <body>
  <h1>New Page Wizard</h1>
  <button class="button" onClick="javascript:loadLayouts()">loadLayouts</button>
  <button class="button" onClick="javascript:loadPages()">loadPages</button>
<div id="wp-content">
<p id="result"></p>
<pre id="raw"><pre>
<?php
    wp_footer();
?>
</div>



</body>
<script type="text/javascript">

const loadPages= ()=>{
    const req = new XMLHttpRequest();
    req.onreadystatechange = function(event) {
        if (this.readyState === XMLHttpRequest.DONE) {
            if (this.status === 200) {
                let txt = this.responseText;
                let raw = document.getElementById('raw');
                raw.style.fontSize= '0.8em';
                raw.style.fontFamily= 'monospace';
                raw.innerText = JSON.stringify(JSON.parse(txt),null,6);
                console.log(JSON.parse(txt));
            } else {
                console.log("Status de la réponse: %d (%s)", this.status, this.statusText);
            }
        }
    };
    let url = `${wpApiSettings.root}${wpApiSettings.versionString}pages/?per_page=100`;
    console.log(url);
    req.open('GET', url, true);
    req.setRequestHeader('X-WP-Nonce', wpApiSettings.nonce);
    req.send(null);
};
const loadLayouts= ()=>{
    const req = new XMLHttpRequest();
    req.onreadystatechange = function(event) {
        if (this.readyState === XMLHttpRequest.DONE) {
            if (this.status === 200) {
                let txt = this.responseText;
                let raw = document.getElementById('raw');
                raw.style.fontSize= '0.8em';
                raw.style.fontFamily= 'monospace';
                raw.innerText = JSON.stringify(JSON.parse(txt),null,6);
                console.log(JSON.parse(txt));
            } else {
                console.log("Status de la réponse: %d (%s)", this.status, this.statusText);
            }
        }
    };
    let url = `${wpApiSettings.root}mpat/v1/layout/?per_page=100`;
    console.log(url);
    req.open('GET', url, true);
    req.setRequestHeader('X-WP-Nonce', wpApiSettings.nonce);
    req.send(null);
};
</script>
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