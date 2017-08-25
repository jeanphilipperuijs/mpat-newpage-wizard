<?php
/*
 * Plugin Name: MPAT New Page Wizard
 * Plugin URI: https://github.com/jeanphilipperuijs/mpat-newpage-wizard/
 * Description: Wizard for creating new pages for MPAT
 * Version: 2.0.3
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
        load_plugin_textdomain('mpat-newpage-wizard', false, basename( dirname( __FILE__ ) ) . '/languages' );

        add_submenu_page('_doesntexist', __("Wizard", "mpat-newpage-wizard"), '', 'manage_options', 'MPAT_NewPageWizard', array(&$this, 'load_js'), 'dashicons-welcome-learn-more');

        add_option('mpatNewPageWizard', array('replace'=>0));

        if (isset($_GET['post_type']) && $_GET['post_type'] === 'page') {
            $options = get_option('mpatNewPageWizard'); ?>
            <script>
             window.onload = function() {
                try{
                    let mnpwReplaceAddNew = <?php echo $options['replace']; ?>;
                    let url ='./admin.php?page=MPAT_NewPageWizard';
                    if(mnpwReplaceAddNew){
                        let addNew = document.getElementsByClassName('page-title-action')[0];
                        addNew.innerText = '<?php _e("New Page Editor", "mpat-newpage-wizard"); ?>';
                        addNew.href=url;
                    }else{
                        let n = document.getElementsByClassName('wp-heading-inline')[0];
                        let wizard = document.createElement('a');
                        wizard.href=url;
                        wizard.innerText = '<?php _e("Wizard", "mpat-newpage-wizard"); ?>';
                        wizard.className = 'page-title-action';
                        n.appendChild(wizard);
                    }
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
}
 
 $np = new NewPage();
 add_action("admin_menu", array(&$np, "init") );
 