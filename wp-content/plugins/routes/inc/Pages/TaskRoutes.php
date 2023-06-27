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
        register_rest_route('api/v1', '/tasks/launch/(?P<id>\d+)', [
            'methods' => 'PUT',
            'callback' => [$this, 'launch_tasks'],
        ]);
        register_rest_route('api/v1', '/tasks/markcomplete/(?P<id>\d+)', [
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
        register_rest_route('api/v1', '/tasks/add/grouptask', [
            'methods' => 'POST',
            'callback' => [$this, 'addnew_grouptask'],
        ]);
        register_rest_route('api/v1', '/tasks/add/trainee', [
            'methods' => 'POST',
            'callback' => [$this, 'addnew_trainees'],
        ]);
        register_rest_route('api/v1', '/tasks/totalassigned', [
            'methods' => 'GET',
            'callback' => [$this, 'get_total_asigned_tasks'],
        ]);
    }

    public function listtrainee_tasks($request)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'projectassignees';
        $table_name_users = $wpdb->prefix . 'projectusers';
        $results = $wpdb->get_results("SELECT $table_name.*, $table_name_users.id, $table_name_users.username FROM $table_name JOIN $table_name_users ON $table_name_users.id = $table_name.user_id;");
        
        // Check if there are trainees
        if (is_wp_error($results)) {
            return new WP_Error('no_results_found', 'No trainees found', array('status' => 404));
        }
        if (count($results) > 0) {
            return [
                'status' => '200',
                'data' => $results,
            ];
        } else  {
            return [
                'status' => '200',
                'data' => [],
            ];
        }
    }
    public function launch_tasks($request)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'tasks';
        $task_id = $request->get_param('id');
        // return ($task_id);

        $existing_task = $wpdb->get_row($wpdb->prepare("SELECT id, status FROM $table_name WHERE id = %d", $task_id));
        // return $existing_task;
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
                'id' => $task_id
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
        $task_id = $request->get_param('id');

        // Check if the task_id is provided
        if (!$task_id) {
            return new WP_Error('missing_task_id', 'Task ID is missing', array('status' => 400));
        }
        // Check if the task_id exists in the table and the status is not 3
        $existing_task = $wpdb->get_row($wpdb->prepare("SELECT id, status FROM $table_name WHERE id = %d", $task_id));
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
                'id' => $task_id
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
        $table_name = $wpdb->prefix . 'projectassignees';
        $tasks_table_name = $wpdb->prefix . 'tasks';
        $tasks = $wpdb->get_results("SELECT * FROM $table_name JOIN $tasks_table_name ON project_id = $tasks_table_name.id WHERE user_id = $trainee_id");
        // Check if tasks are found for the trainee
        if ($tasks) {
            return [
                'status' => '200',
                'data' => $tasks,
            ];
        } else {
            return [
                'status' => '200',
                'data' => [],
            ];
        }
    }

    public function addnew_individualtask($request)
    {
        global $wpdb;
        $task_table_name = $wpdb->prefix . 'tasks';
        $project_users_table = $wpdb->prefix . 'projectusers';

        // Check if required input fields are present
        if (empty($request['trainee_id']) || empty($request['project_title']) || empty($request['project_description']) || empty($request['setTodaysDate'])) {
            return new WP_Error('missing_fields', 'Missing required fields', array('status' => 400));
        }

        $trainee_id = $request['trainee_id'];
        $project_title = $request['project_title'];
        $project_description = $request['project_description'];
        $project_date = $request['setTodaysDate'];
        // Check if user ID exists
        $existing_user = $wpdb->get_row($wpdb->prepare("SELECT id FROM $project_users_table WHERE id = %d", $trainee_id));
        if (!$existing_user) {
            return new WP_Error('user_not_found', 'User not found', array('status' => 404));
        }

        $result = $wpdb->insert($task_table_name, [
            'user_id' => $trainee_id,
            'project_title' => $project_title,
            'project_description' => $project_description,
            'project_date' => $project_date,
            'status' => 1
        ]);

        $responsedata = [
            'user_id' => $trainee_id,
            'message' => 'Task created successfully',
            'project-date' => $project_date,
            'status' => '201'
        ];

        // Check if the task was successfully inserted
        if ($result) {
            return new \WP_REST_Response($responsedata);
        } else {
            return new WP_Error('insert_error', 'Task not created', array('status' => 500));
        }
    }


    public function addnew_grouptask($request)
    {
        global $wpdb;
        $project_users_table = $wpdb->prefix . 'projectusers';
        $task_table_name = $wpdb->prefix . 'tasks';
        $project_assignees_table = $wpdb->prefix . 'projectassignees';
        $results = $wpdb->get_results("SELECT $task_table_name.*, $project_assignees_table.id, $project_assignees_table.project_id FROM $task_table_name JOIN $project_assignees_table ON $project_assignees_table.project_id = $task_table_name.user_id;");
        $response_error = [
            'error' => 'missing_fields',
            'message' => 'Missing required fields',
            'data' => [
                'status' => '400'
            ]
        ];
        // Check if required input fields are present
        if (empty($request['trainee_id']) || empty($request['project_title']) || empty($request['project_description']) || empty($request['setTodaysDate'])) {
            return new \WP_REST_Response($response_error);
        }
        $assignees = $request['trainee_id'];
        foreach ($assignees as $assignee) {
            // Check if user ID exists
            $existing_user = $wpdb->get_row($wpdb->prepare("SELECT id FROM $project_users_table WHERE id = %d", $assignee));
            if (!$existing_user) {
                return new WP_Error('user_not_found', 'User not found', array('status' => 404));
            }
        }
        $project_title = $request['project_title'];
        $project_description = $request['project_description'];
        $project_date = $request['setTodaysDate'];
        $cohortName = $request['cohort'];

        $result = $wpdb->insert($task_table_name, [
            'project_title' => $project_title,
            'project_description' => $project_description,
            'project_date' => $project_date,
            'status' => 1
        ]);
        // return  $wpdb->insert_id;
        foreach ($assignees as $assignee) {
            $wpdb->insert($project_assignees_table, [
                'user_id' => $assignee,
                'project_id' => $wpdb->insert_id,
                'cohort' => $cohortName
            ]);
        }
        $responsedata = [
            'user_id' => $assignee,
            'message' => 'Task created successfully',
            'project-date' => $project_date,
            'data' => [
                'status' => '201'
            ]

        ];

        // Check if the task was successfully inserted
        if ($result) {
            return new \WP_REST_Response($responsedata);
        } else {
            // return new \WP_REST_Response($response_error);

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
        $cohortName = $request['cohort'];
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
            'role' => $role,
            'cohort' => $cohortName
        ]);
        $responsedata = [
            'role' => $role,
            'message' => 'Trainer created successfully',
            'status' => '201'
        ];
        // Check if the trainee was successfully created
        if ($result) {
            return new \WP_REST_Response($responsedata);
        } else {
            return new WP_Error('trainee_error', 'Trainee was not created', array('status' => 500));
        }
    }
    function get_total_asigned_tasks()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'projectassignees';
        $table_name_users = $wpdb->prefix . 'projectusers';

        // SELECT user_id , COUNT(*) AS no_of_tasks FROM wp_projectassignees GROUP BY user_id;
        $results = $wpdb->get_results("SELECT user_id, COUNT(*) AS no_of_tasks FROM $table_name GROUP BY user_id");
        $unavailable_trainees = array_filter($results, function ($number) {
            return $number->no_of_tasks >= 3;
        });
        $Trainees = $wpdb->get_results("SELECT id,username FROM $table_name_users WHERE role = 'trainee'");

        $available = array_filter($Trainees, function ($Trainee) use ($unavailable_trainees) {
            return !in_array($Trainee->id,  array_column($unavailable_trainees, "user_id"));
        });
        if (!$available) {
            $responsedata = [
                'message' => 'No availble trainees found',
                'status' => '400'
            ];
        } else {
            return $available;
        }
        return new \WP_REST_Response($responsedata);
    }
}
