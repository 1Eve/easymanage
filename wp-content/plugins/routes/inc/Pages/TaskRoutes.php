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
        register_rest_route('api/v1', '/tasks/(?P<id>\d+)', [
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
        return $results;
    }
    public function launch_tasks($request)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'tasks';
        $task_id = $request->get_param('id');

        $result = $wpdb->update(
            $table_name,
            [
                'status' => 1,
            ],
            [
                'task_id' => $task_id
            ]
        );
        return $result;
    }
    public function marktask_ascomplete($request)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'tasks';
        $task_id = $request->get_param('id');
        $wpdb->update(
            $table_name,
            [
                'status' => 3,
            ],
            [
                'task_id' => $task_id
            ]
        );
    }
    public function get_traineetasks($request)
    {
        global $wpdb;
        $trainee_id = $request->get_param('trainee_id');
        $table_name = $wpdb->prefix . 'tasks';
        $tasks = $wpdb->get_results("SELECT * FROM $table_name WHERE user_id = $trainee_id ");
        return $tasks;
    }
    public function addnew_individualtask($request)
    {
        global $wpdb;
        $task_table_name = $wpdb->prefix . 'tasks';
        $trainee_id = $request['user_id'];
        $project_title = $request['project_title'];
        $project_description = $request['project_description'];
        $result = $wpdb->insert($task_table_name, [
            'user_id' => $trainee_id,
            'project_title' => $project_title,
            'project_description' => $project_description,
            'status' => 0
        ]);
        if ($result) {
            return $result;
        } else
            return new WP_Error('project error', "Task Not Created!");
    }
    public function addnew_trainees($request)
    {
        global $wpdb;

        $table_name = $wpdb->prefix . 'projectusers';

        $username = $request['username'];
        $useremail = $request['useremail'];
        $role = $request['role'];
        $pwd = $request['password'];
        $hash_pwd = wp_hash_password($pwd);
        $result = $wpdb->get_row("SELECT id FROM $table_name WHERE useremail = '$useremail'");
        $result = $wpdb->insert($table_name, [
            'username' => $username,
            'useremail' => $useremail,
            'password' => $hash_pwd,
            'role' => $role
        ]);
        if ($result){
            return $result;
        } else
            return new WP_Error('Trainee Error', "Trainee Was Not Created!");
            
    }
}