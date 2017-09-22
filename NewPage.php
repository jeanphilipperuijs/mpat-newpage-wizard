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

        add_option('mpatNewPageWizard', '');
        register_setting('mpatNewPageWizard-settings-group', 'mpatNewPageWizard');

        if (isset($_GET['post_type']) && $_GET['post_type'] === 'page') {
            $replace ='';
            if(get_option('mpatNewPageWizard') =='on')
            {
                $replace='checked';
            }
            ?>

            <script>
             window.onload = function() {
                try{
                    let mnpwReplaceAddNew = <?php echo strcmp($replace ,'checked'); ?>;
                    let url ='./admin.php?page=MPAT_NewPageWizard';
                    if(mnpwReplaceAddNew == 0){
                        let addNew = document.getElementsByClassName('page-title-action')[0];
                        addNew.innerText = '<?php _e("Wizard", "mpat-newpage-wizard"); ?>';
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

        $this->option_form();
        }
    }

    function option_form(){
        $replace ='';
        if(get_option('mpatNewPageWizard') =='on')
        {
            $replace='checked';
        }
        ?>
        
        <div style="position:relative; left: 164px" >
        <details id="options">
        <summary><?php _e('Options','mpat-newpage-wizard'); ?></summary>
        <form method="post" action="./options.php">
        <?php settings_fields( 'mpatNewPageWizard-settings-group' ); ?>
        <?php do_settings_sections( 'mpatNewPageWizard-settings-group' ); ?>
        <table class="form-table" style="width: 300px; border-width: 1px;">
            <tr>
            <td>
                <td><?php _e('Replace the button \'Add New\'','mpat-newpage-wizard') ?></td>
                <td><input type="checkbox" name="mpatNewPageWizard" <?php echo $replace ?> /></td>
            </tr>
            <tr>
                <td colspan="2">
                    <?php submit_button(); ?>
                </td>
            </tr>     
            
        </table>
        
        </form>  
        </details>
        </div>
        <?php
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
      //  wp_enqueue_script('mpat-newpage-wizard', plugin_dir_url(__FILE__) . 'public/rui.js', array('wp-api'), 1.0, true );
      wp_enqueue_script('mpat-newpage-wizard', 'http://localhost:8000/rui.js', array('wp-api'), 1.0, true );
      
    }
}
 
 $np = new NewPage();
 add_action("admin_menu", array(&$np, "init") );
 //$np.option_form();
 //add_action("admin_menu", array(&$np, "option_form") );
 