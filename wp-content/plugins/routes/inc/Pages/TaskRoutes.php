<?php

/**
 * @package Routes
 */

namespace Inc\Pages;

use \WP_Error;


class TaskRoutes
{
    public function register()
    {
        add_action("rest_api_init", [$this, "registermyroutes"]);
    }
    public function registermyroutes()
    {
        register_rest_route('api/v1', '/tasks', [
            'methods' => 'GET',
            'callback' => [$this, 'listtrainee_tasks'],
        ]);
        register_rest_route('api/v1', '/tasks/launch/(?P<task_id>\d+)', [
            'methods' => 'PUT',
            'callback' => [$this, 'launch_tasks'],
        ]);
        register_rest_route('api/v1', '/tasks/markcomplete/(?P<task_id>\d+)', [
            'methods' => 'PUT',
            'callback' => [$this, 'marktask_ascomplete'],
        ]);
        register_rest_route('api/v1', '/tasks/(?P<trainee_id>\d+)', [
            'methods' => 'GET',
            'callback' => [$this, 'get_traineetasks'],
        ]);
        register_rest_route('api/v1', '/tasks/add/individual', [
            'methods' => 'POST',
            'callback' => [$this, 'addnew_individualtask'],
        ]);
        register_rest_route('api/v1', '/tasks/add/trainee', [
            'methods' => 'POST',
            'callback' => [$this, 'addnew_trainees'],
        ]);
    }

    public function listtrainee_tasks($request)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'tasks';
        $table_name_users = $wpdb->prefix . 'projectusers';
        $results = $wpdb->get_results("SELECT $table_name.*, $table_name_users.id, $table_name_users.username FROM $table_name JOIN $table_name_users ON $table_name_users.id = $table_name.user_id;");
        if(!$results){
            return new WP_Error('no_results_found', 'No trainees found', array('status' => 404));
        }
        return $results;
    }
    public function launch_tasks($request)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'tasks';
        $task_id = $request->get_param('task_id');
        $existing_task = $wpdb->get_row($wpdb->prepare("SELECT task_id, status FROM $table_name WHERE task_id = %d", $task_id));
        if (!$existing_task) {
            return new WP_Error('task_not_found', 'Task ID not found', array('status' => 404));
        }
        if ($existing_task->status == 2) {
            return new WP_Error('task_already_in_progress', 'The task has already been marked as in progress', array('status' => 400));
        }
        if ($existing_task->status == 3) {
            return new WP_Error('task_already_complete', 'The task has already been marked as complete', array('status' => 400));
        }
        $wpdb->update(
            $table_name,
            [
                'status' => 2,
            ],
            [
                'task_id' => $task_id
            ]
        );
        $responsedata = [
            'task_id' => $task_id,
            'message' => 'The task has been marked as launched',
            'status' => '200'
        ];
        return new \WP_REST_Response($responsedata);
    }
    public function marktask_ascomplete($request)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'tasks';
        $task_id = $request->get_param('task_id');

        // Check if the task_id is provided
        if (!$task_id) {
            return new WP_Error('missing_task_id', 'Task ID is missing', array('status' => 400));
        }
        // Check if the task_id exists in the table and the status is not 3
        $existing_task = $wpdb->get_row($wpdb->prepare("SELECT task_id, status FROM $table_name WHERE task_id = %d", $task_id));
        if (!$existing_task) {
            return new WP_Error('task_not_found', 'Task ID not found', array('status' => 404));
        }

        if ($existing_task->status == 3) {
            return new WP_Error('task_already_complete', 'The task has already been marked as complete', array('status' => 400));
        }
        if ($existing_task->status == 1) {
            return new WP_Error('task_not_launched', 'The task has not been launched', array('status' => 400));
        }
        $wpdb->update(
            $table_name,
            [
                'status' => 3,
            ],
            [
                'task_id' => $task_id
            ]
        );
        $responsedata = [
            'task_id' => $task_id,
            'message' => 'The task has been marked as complete',
            'status' => '200'
        ];
        return new \WP_REST_Response($responsedata);
    }

    public function get_traineetasks($request)
    {
        global $wpdb;
        $trainee_id = $request->get_param('trainee_id');

        $table_name = $wpdb->prefix . 'tasks';
        $tasks = $wpdb->get_results("SELECT * FROM $table_name WHERE user_id = $trainee_id");

        // Check if tasks are found for the trainee
        if ($tasks) {
            return $tasks;
        } else {
            return new WP_Error('no_tasks_found', 'No tasks found for the trainee', array('status' => 404));
        }
    }

    public function addnew_individualtask($request)
    {
        global $wpdb;
        $task_table_name = $wpdb->prefix . 'tasks';

        // Check if required input fields are present
        if (empty($request['user_id']) || empty($request['project_title']) || empty($request['project_description'])) {
            return new WP_Error('missing_fields', 'Missing required fields', array('status' => 400));
        }

        $trainee_id = $request['user_id'];
        $project_title = $request['project_title'];
        $project_description = $request['project_description'];
        $result = $wpdb->insert($task_table_name, [
            'user_id' => $trainee_id,
            'project_title' => $project_title,
            'project_description' => $project_description,
            'status' => 0
        ]);
        $responsedata = [
            'user_id' => $trainee_id,
            'message' => 'Task created successfully',
            'data' => '201'
        ];
        // Check if the task was successfully inserted
        if ($result) {
            return new \WP_REST_Response($responsedata);
        } else {
            return new WP_Error('insert_error', 'Task not created', array('status' => 500));
        }
    }


    public function addnew_trainees($request)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'projectusers';

        // Check if required input fields are present
        if (empty($request['username']) || empty($request['useremail']) || empty($request['role']) || empty($request['password'])) {
            return new WP_Error('missing_fields', 'Missing required fields', array('status' => 400));
        }

        $username = $request['username'];
        $useremail = $request['useremail'];
        $role = $request['role'];
        $pwd = $request['password'];
        $hash_pwd = wp_hash_password($pwd);

        // Check if useremail already exists
        $existing_user = $wpdb->get_row("SELECT id FROM $table_name WHERE useremail = '$useremail'");
        if ($existing_user) {
            return new WP_Error('user_exists', 'User with the provided email already exists', array('status' => 409));
        }

        $result = $wpdb->insert($table_name, [
            'username' => $username,
            'useremail' => $useremail,
            'password' => $hash_pwd,
            'role' => $role
        ]);
        $responsedata = [
            'role' => $role,
            'message' => 'Trainer created successfully',
            'data' => '201'
        ];
        // Check if the trainee was successfully created
        if ($result) {
            return new \WP_REST_Response($responsedata);
        } else {
            return new WP_Error('trainee_error', 'Trainee was not created', array('status' => 500));
        }
    }
}
