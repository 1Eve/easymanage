<?php

/**
 * @package Routes
 */

namespace Inc\Pages;

use \WP_Error;

class UserRoutes
{
    public function register()
    {
        add_action("rest_api_init", [$this, "registermyroutes"]);
    }
    public function registermyroutes()
    {
        register_rest_route('api/v1', '/login', [
            'methods' => 'POST',
            'callback' => [$this, 'compare_passwords'],
        ]);
        register_rest_route('api/v1', '/users', [
            'methods' => 'GET',
            'callback' => [$this, 'getall_users'],
        ]);
        register_rest_route('api/v1', '/users/(?P<id>\d+)', [
            'methods' => 'GET',
            'callback' => [$this, 'getsingle_user'],
        ]);
        register_rest_route('api/v1', '/users/active', [
            'methods' => 'GET',
            'callback' => [$this, 'getall_active_users'],
        ]);
        register_rest_route('api/v1', '/users/delete/(?P<id>\d+)', [
            'methods' => 'PUT',
            'callback' => [$this, 'deletesingle_user'],
        ]);
        register_rest_route('api/v1', '/users/deactivated/', [
            'methods' => 'GET',
            'callback' => [$this, 'getall_deactivated_users'],
        ]);
        register_rest_route('api/v1', '/users/restore/(?P<id>\d+)', [
            'methods' => 'PUT',
            'callback' => [$this, 'restoresingle_user'],
        ]);
        register_rest_route('api/v1', '/users/trainers', [
            'methods' => 'GET',
            'callback' => [$this, 'get_alltrainers'],
        ]);
        register_rest_route('api/v1', '/users/projectmanager', [
            'methods' => 'POST',
            'callback' => [$this, 'create_new_projectmanager'],
        ]);
        register_rest_route('api/v1', '/users/trainer', [
            'methods' => 'POST',
            'callback' => [$this, 'create_new_trainer'],
        ]);
        register_rest_route('api/v1', '/users/trainees', [
            'methods' => 'GET',
            'callback' => [$this, 'getall_trainees'],
        ]);
    }
    public function compare_passwords($request)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'projectusers';
        $useremail = $request['useremail'];
        $userpassword = $request['password'];
        // Check if required input fields are present
        if (empty($request['useremail']) || empty($request['password'])) {
            return new WP_Error('missing_fields', 'Missing required fields', array('status' => 400));
        }
        $result = $wpdb->get_row("SELECT * FROM $table_name WHERE useremail = '$useremail'");
        if (!$result) {
            return new WP_Error('email_error', 'Email was not found', array('status' => 404));
        }
        $hash_pwd = $result->password;
        if (!wp_check_password($userpassword, $hash_pwd)) {
            return new WP_Error('password_error', 'You\'ve inserted wrong password', array('status' => 404));
        }
        if (wp_check_password($userpassword, $hash_pwd)) {
            [
                'id' => $result->id,
                'username' => $result->username,
                'useremail' => $result->useremail,
                'role' => $result->role
            ];
        }
        $responsedata = [
            'user_id' => $result->id,
            'role' => $result->role,
            'username' =>$result->username,
            'useremail' =>$result->useremail,
            'cohort' =>$result->cohort,
            'message' => 'User Logged in successfully',
            'data' => '200'
        ];
        return new \WP_REST_Response($responsedata);
    }
    public function getsingle_user($request)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'projectusers';
        $id = $request->get_param('id');
        $result = $wpdb->get_row("SELECT * FROM $table_name WHERE id = '$id'");
        // Check if user is found
        if ($result) {
            return $result;
        } else {
            return new WP_Error('user_not_found', 'User not found', array('status' => 404));
        }
    }

    public function getall_users($request)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'projectusers';
        $result = $wpdb->get_results("SELECT * FROM $table_name");
        if ($result) {
            return $result;
        } else {
            return new WP_Error('users_not_found', 'Users not found', array('status' => 404));
        }
    }
    public function getall_active_users($request)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'projectusers';
        $result = $wpdb->get_results("SELECT * FROM $table_name WHERE status = 0");
        // Check if active users are found


        if (is_wp_error($result)) {
            return new WP_Error('users_not_found', 'Active users not found', array('status' => 404));
        }
        if (count($result) > 0) {
            return [
                'status' => '200',
                'data' => $result,
            ];
        } else  {
            return [
                'status' => '200',
                'data' => [],
            ];
        }

        // if ($result) {
        //     return $result;
        // } else {
        //     return new WP_Error('users_not_found', 'Active users not found', array('status' => 404));
        // }


    }
    public function deletesingle_user($request)
    {
        global $wpdb;
        $id = $request->get_param('id');
        $table_name = $wpdb->prefix . 'projectusers';
        // Check if user ID exists
        $existing_user = $wpdb->get_row($wpdb->prepare("SELECT id, status FROM $table_name WHERE id = %d", $id));
        if (!$existing_user) {
            return new WP_Error('user_not_found', 'User not found', array('status' => 404));
        }

        $curr_status = $existing_user->status;
        if ($curr_status == 1) {
            return new WP_Error('user_already_deleted', 'User has already been deleted', array('status' => 400));
        }
        $result = $wpdb->update(
            $table_name,
            ['status' => 1],
            ['id' => $id]
        );

        $responsedata = [
            'user_id' => $existing_user->id,
            'message' => 'User deleted successfully',
            'status' => '200'
        ];
        return new \WP_REST_Response($responsedata);
    }
    public function getall_deactivated_users($request)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'projectusers';
        $results = $wpdb->get_results("SELECT * FROM $table_name WHERE status = 1");
        return $results;
    }
    public function restoresingle_user($request)
    {
        global $wpdb;
        $id = $request->get_param('id');
        $table_name = $wpdb->prefix . 'projectusers';
        // Check if user ID exists
        $existing_user = $wpdb->get_row($wpdb->prepare("SELECT id, status FROM $table_name WHERE id = %d", $id));
        if (!$existing_user) {
            return new WP_Error('user_not_found', 'User not found', array('status' => 404));
        }
        $curr_status = $existing_user->status;
        if ($curr_status == 0) {
            return new WP_Error('user_already_active', 'User is already active', array('status' => 400));
        }
        $wpdb->update(
            $table_name,
            ['status' => 0],
            ['id' => $id]
        );
        $responsedata = [
            'user_id' => $existing_user->id,
            'message' => 'User restored successfully',
            'status' => '200'
        ];
        return new \WP_REST_Response($responsedata);
    }
    public function get_alltrainers()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'projectusers';
        $results = $wpdb->get_results("SELECT * FROM $table_name WHERE role = 'trainer'");
        if ($results) {
            return $results;
        } else {
            return new WP_Error('trainers_not_found', 'Trainers not found', array('status' => 404));
        }
    }

    public function create_new_projectmanager($request)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'projectusers';
        $username = $request['username'];
        $useremail = $request['useremail'];
        $role = $request['role'];
        $pwd = $request['password'];
        $hash_pwd = wp_hash_password($pwd);
        $results = $wpdb->get_row("SELECT id FROM $table_name WHERE useremail = '$useremail'");
        $result = $wpdb->insert($table_name, [
            'username' => $username,
            'useremail' => $useremail,
            'password' => $hash_pwd,
            'role' => $role
        ]);
        if ($result) {
            return $result;
        } else
            return new WP_Error("user not created", "Project Manager Not Created!");
    }
    public function create_new_trainer($request)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'projectusers';
        $cohorts_table = $wpdb->prefix . 'cohorts';
        $hash_pwd = wp_hash_password($request['password']);
        $traineremail = $request['useremail'];

        // Check if required input fields are present
        if (empty($request['username']) || empty($request['useremail']) || empty($request['role']) || empty($request['password']) || empty($request['choose_cohort'])) {
            return new WP_Error('missing_fields', 'Missing required fields', array('status' => 400));
        }

        // Check if user with the same email already exists
        $existinguser = $wpdb->get_row($wpdb->prepare("SELECT useremail, status FROM $table_name WHERE useremail = %s", $traineremail));

        if ($existinguser) {
            return new WP_Error('user_already_exists', 'User with the same email already exists', array('status' => 400));
        }

        // Check if the chosen cohort exists
        $chosen_cohort = $request['choose_cohort'];
        $cohort_exists = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $cohorts_table WHERE cohort_name = %s", $chosen_cohort));

        if (!$cohort_exists) {
            return new WP_Error('cohort_not_found', 'The chosen cohort does not exist', array('status' => 400));
        }

        $existinguser = $wpdb->get_row($wpdb->prepare("SELECT useremail, status FROM $table_name WHERE user_email = %s, $traineremail"));
        $result = $wpdb->insert($table_name, [
            'username' => $request['username'],
            'useremail' => $request['useremail'],
            'password' => $hash_pwd,
            'role' => $request['role'],
            'cohort' => $request['choose_cohort']
        ]);
        $responsedata = [
            'message' => 'Project manager created successfully',
            'status' => '201'
        ];
        // Check if the trainee was successfully inserted
        if ($result) {
            return new \WP_REST_Response($responsedata);
        } else

            return new WP_Error('insert_error', 'Task not created', array('status' => 500));
    }
    public function getall_trainees()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'projectusers';
        $totaltrainees = $wpdb->get_results("SELECT * FROM $table_name WHERE role = 'trainee'");

        if (is_wp_error($totaltrainees)) {
            return new WP_Error('no_trainees_found', 'No trainees found', array('status' => 404));
        }
        if (count($totaltrainees) > 0) {
            return [
                'status' => '200',
                'data' => $totaltrainees,
            ];
        } else  {
            return [
                'status' => '200',
                'data' => [],
            ];
        }


        // if ($totaltrainees) {
        //     return new \WP_REST_Response($totaltrainees, 200);
        // } else {
        //     return new WP_Error('no_trainees_found', 'No trainees found', array('status' => 404));
        // }
    }
}
