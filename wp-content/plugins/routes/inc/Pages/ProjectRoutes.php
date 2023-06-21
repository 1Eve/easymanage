<?php
/**
 * @package Routes
 */
namespace Inc\Pages;

use \WP_Error;

class ProjectRoutes
{
    public function register()
    {
        add_action("rest_api_init", [$this, "registermyroutes"]);
    }
    public function registermyroutes()
    {
        register_rest_route('api/v1', '/projects/cohorts', [
            'methods' => 'GET',
            'callback' => [$this, 'get_cohortlist'],
        ]);
    }
    public function get_cohortlist()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'cohorts';
        $results = $wpdb->get_results("SELECT * FROM $table_name");
        return $results;
    }
}