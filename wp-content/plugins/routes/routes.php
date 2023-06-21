<?php
/**
 * @package Routes
 */

/*
    Plugin Name: Routes Plugin
    Plugin URI: http://.........
    Description: This is a plugin built by Patrick Mwaniki
    Version: 1.0.0
    Author: Patrick Mwaniki
    Author URI: http://patrickmwaniki...............
    Licence: GPLv2 or later
    Text Domain: Wordpress plugin
*/

// security check
defined('ABSPATH') or die('Security breaches identified');


// Checking if composer exists
if(file_exists(dirname(__FILE__).'/vendor/autoload.php')){
    require_once(dirname(__FILE__).'/vendor/autoload.php');
}
function activate_c13plugin(){
    Inc\Base\Activate::activate();
}

function deactivate_c13plugin(){
    Inc\Base\Deactivate::deactivate();
}

register_activation_hook(__FILE__, 'activate_c13plugin');

register_deactivation_hook(__FILE__, 'deactivate_c13plugin');

if(class_exists('Inc\\Init')){
    Inc\Init::register_services(); 
}