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
        $result = $wpdb->get_row("SELECT * FROM $table_name WHERE useremail = '$useremail'");
        $hash_pwd = $result->password;
        // return["pass" => $userpassword];
        if ($result) {

            $hash_pwd = $result->password;
            if (wp_check_password($userpassword, $hash_pwd)) {

                $userinfo = [
                    'id' => $result->id,
                    'username' => $result->username,
                    'useremail' => $result->useremail,
                    'role' => $result->role
                ];
                return $userinfo;
            } else {
                return new WP_Error('wrong_password', "Invalid Password!");
            }
        }
        return new WP_Error('wrong_usernotexist', "User Does Not Exist!");
    }
    public function getsingle_user($request)
    {
        $id = $request->get_param('id');
        global $wpdb;
        $table_name = $wpdb->prefix . 'projectusers';
        $result = $wpdb->get_row("SELECT * FROM $table_name WHERE id = '$id'");
        return $result;
    }
    public function getall_users($request)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'projectusers';
        $result = $wpdb->get_results("SELECT * FROM $table_name");
        return $result;
    }
    public function getall_active_users($request)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'projectusers';
        $result = $wpdb->get_results("SELECT * FROM $table_name WHERE status = 0");
        return $result;
    }
    public function deletesingle_user($request)
    {
        $id = $request->get_param('id');
        global $wpdb;
        $table_name = $wpdb->prefix . 'projectusers';
        $result = $wpdb->update(
            $table_name,
            ['status' => 1],
            ['id' => $id]
        );
        return $result;
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
        $result = $wpdb->update(
            $table_name,
            ['status' => 0],
            ['id' => $id]
        );
        return $result;
    }
    public function get_alltrainers()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'projectusers';
        $results = $wpdb->get_results("SELECT * FROM $table_name WHERE role = 'trainer'");
        return $results;
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
        $username = $request['username'];
        $useremail = $request['useremail'];
        $role = $request['role'];
        $pwd = $request['password'];
        $choose_cohort = $request['choose_cohort'];
        $hash_pwd = wp_hash_password($pwd);
        $results = $wpdb->get_results("SELECT * FROM $table_name WHERE role = 'trainer'");
        $result = $wpdb->insert($table_name, [
            'username' => $username,
            'useremail' => $useremail,
            'password' => $hash_pwd,
            'role' => $role,
            'cohort' => $choose_cohort
        ]);
        if ($result) {
            return $result;
        } else
            return new WP_Error("user not created", "Project Manager Not Created!");
    }
    public function getall_trainees()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'projectusers';
        $totaltrainees = $wpdb->get_results("SELECT * FROM $table_name WHERE role = 'trainee'");
        return $totaltrainees;
    }
}