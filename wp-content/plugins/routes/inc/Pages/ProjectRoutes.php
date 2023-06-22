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

    if ($results) {
        return new \WP_REST_Response($results, 200);
    } else {
        return new WP_Error('no_cohorts_found', 'No cohorts found', array('status' => 404));
    }
}

public function add_cohorts($request)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'cohorts';
    $cohort_name = $request['cohort_name'];
    // Check if required input fields are empty
    if (empty($cohort_name)) {
        return new WP_Error('missing_fields', 'Missing required fields', array('status' => 400));
    }
    // Check if cohort already exists
    $existing_cohort = $wpdb->get_row($wpdb->prepare("SELECT id FROM $table_name WHERE cohort_name = %s", $cohort_name));
    if ($existing_cohort) {
        return new WP_Error('cohort_already_exists', 'Cohort already exists', array('status' => 409));
    }
    $result = $wpdb->insert($table_name, [
        'cohort_name' => $cohort_name,
    ]);
    
    if ($result) {
        return new \WP_REST_Response('Cohort added successfully', 200);
    } else {
        return new WP_Error('cohort_creation_failed', 'Cohort creation failed', array('status' => 500));
    }
}

}