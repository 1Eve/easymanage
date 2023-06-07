<?php

function easymanagestyles () {
    wp_enqueue_style('customcss',get_template_directory_uri().'/custom/custom.css',[],'1.0.0','all');
}
add_action('wp_enqueue_scripts','easymanagestyles');

// ADDING MENUS - HEADER AND FOOTER

function easymanage_theme_support(){
    add_theme_support('menus');
    register_nav_menu('primary','Primary Header');
    register_nav_menu('secondary','Secondary Header');
}

add_action('init','easymanage_theme_support');