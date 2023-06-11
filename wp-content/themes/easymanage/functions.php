<?php

function easymanagestyles () {
    wp_enqueue_style('customcss',get_template_directory_uri().'/custom/custom.css',[],'1.0.0','all');

    //introducing bootstrap
    wp_register_style('bootstrapcss', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css', [], '5.2.3', 'all');
    wp_enqueue_style('bootstrapcss');

    wp_register_script('jsbootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js', [], '5.2.3', false);
    wp_enqueue_script('jsbootstrap');
   //bootsrap icons
    wp_register_style('bootstrapicons','https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css',[],'1.10.5',false);
    wp_enqueue_style('bootstrapicons');
}
add_action('wp_enqueue_scripts','easymanagestyles');

// ADDING MENUS - HEADER AND FOOTER

function easymanage_theme_support(){
    add_theme_support('menus');
    register_nav_menu('primary','Primary Header');
    register_nav_menu('secondary','Secondary Header');
}

add_action('init','easymanage_theme_support');