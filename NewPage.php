<?php
/*
 * Plugin Name: MPAT New Page Wizard
 * Plugin URI: https://github.com/jeanphilipperuijs/mpat-newpage-wizard/
 * Description: Wizard for creating new pages for MPAT
 * Version: 1.0.beta
 * Author: Jean-Philippe Ruijs
 * Author URI: https://github.com/jeanphilipperuijs/
 * License: GPL2
 */
namespace MPAT\NewPageWizard;

class NewPage
{
    function init(){
        add_menu_page('Wizard', 'Wizard', 'manage_options', 'MPAT_NewPageWizard', array(&$this, 'init2'), 'dashicons-welcome-learn-more');

    }
    function init2(){
        wp_enqueue_script('wp-api');
        wp_enqueue_script('mpat-general', plugin_dir_url(__FILE__) . 'build/main.bundle.js', array(), 1.0, true);
        wp_enqueue_script('mpat_newpage', plugin_dir_url(__FILE__) . '../js/mpat_newpage_wizard.min.js', array('wp-api'), 1.0, true );
    }
}

$np = new NewPage();
add_action("admin_menu", array(&$np, "init"));
?>