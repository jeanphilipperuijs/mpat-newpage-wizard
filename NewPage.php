<?php
/*
 * Plugin Name: MPAT New Page Wizard
 * Plugin URI: https://github.com/jeanphilipperuijs/mpat-newpage-wizard/
 * Description: Wizard for creating new pages for MPAT
 * Version: 2.0.beta
 * Author: Jean-Philippe Ruijs
 * Author URI: https://github.com/jeanphilipperuijs/
 * Text Domain: mpat-newpage-wizard
 * Domain Path: /languages
 * License: GPL2
 */
 namespace MPAT\NewPageWizard;
 
class NewPage
{
    function init()
    {
        add_action( 'plugins_loaded', array(&$this,'load_l10n'));

        add_submenu_page('_doesntexist', __('Wizard', 'mpat-newpage-wizard'), '', 'manage_options', 'MPAT_NewPageWizard', array(&$this, 'load_js'), 'dashicons-welcome-learn-more');
         
        if (isset($_GET['post_type']) && $_GET['post_type'] === 'page') {
            echo '<!--'.__('Wizard', 'mpat-newpage-wizard').'-->';
            ?>
         <script>
             window.onload = function() {
                try{
                    let l = document.getElementsByClassName('page-title-action')[0];
                    l.href='./admin.php?page=MPAT_NewPageWizard';
                }catch(err){
                    console.log('NewPageWizard', err);
                }
             }
         </script>
            <?php
        }
    }

    function load_js()
    {
        wp_enqueue_script('wp-api');
        wp_register_script('mpat_npw_i18n', null, array("wp-api"));
        wp_localize_script('mpat_npw_i18n', 'npwi18n', array(
            'lang' => substr(get_user_locale(), 0, 2),
            'locale' => get_user_locale()
        ));
        wp_enqueue_script('mpat_npw_i18n');
        wp_enqueue_script('mpat-newpage-wizard', plugin_dir_url(__FILE__) . 'public/rui.js', array('wp-api'), 1.0, true );
    }

    function load_l10n()
    {
        load_plugin_textdomain( 'mpat-newpage-wizard', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
    }
}
 
 $np = new NewPage();
 add_action("admin_menu", array(&$np, "init") );
 