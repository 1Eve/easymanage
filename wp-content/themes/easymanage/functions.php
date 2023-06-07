<?php

function easymanagestyles () {
    wp_enqueue_style('customcss',get_template_directory_uri().'/custom/custom.css',[],'1.0.0','all');
}
add_action('wp_enqueue_scripts','easymanagestyles');