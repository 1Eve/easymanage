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
        register_rest_route('api/v1', '/projects/add/cohorts', [
            'methods' => 'POST',
            'callback' => [$this, 'add_cohorts'],
        ]);
    }
    public function get_cohortlist()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'cohorts';
        $results = $wpdb->get_results("SELECT * FROM $table_name");
        return $results;
    }
    public function add_cohorts ($request){
        global $wpdb;
        $table_name = $wpdb->prefix . 'cohorts';

        $cohort_name = $request['cohort_name'];

        $results = $wpdb->get_results("SELECT id FROM $table_name WHERE cohort_name = '$cohort_name'");
        $results = $wpdb->insert($table_name, [
            'cohort_name' => $cohort_name,
        ]);if ($results){
            return $results;
        } else
            return new WP_Error('Trainee Error', "Trainee Was Not Created!");
            
    }
}