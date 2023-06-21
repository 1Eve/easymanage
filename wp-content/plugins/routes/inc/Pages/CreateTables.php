<?php
/**
 * @package Routes
 */
namespace Inc\Pages;
class CreateTables
{
    public function register()
    {
        $this->create_users_table();
        $this->create_tasks_table();
        $this->create_cohort_table();
    }
    public function create_users_table()
    {
        global $wpdb;

        $table_name = $wpdb->prefix . 'projectusers';

        $user_table = "CREATE TABLE IF NOT EXISTS " . $table_name . "(
                id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
                username text NOT NULL,
                useremail text NOT NULL,
                password text NOT NULL,
                cohort text NOT NULL,
                role text NOT NULL,
                status int NOT NULL
            )";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        dbDelta($user_table);
    }

    public function create_tasks_table()
    {
        global $wpdb;

        $table_name = $wpdb->prefix . 'tasks';

        $task_table = "CREATE TABLE IF NOT EXISTS " . $table_name . " (
        id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
        user_id int NOT NULL,
        project_title text NOT NULL,
        project_description text NOT NULL,
        status int NOT NULL
    )";
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        dbDelta($task_table);
    }
    public function create_cohort_table()
    {
        global $wpdb;

        $table_name = $wpdb->prefix . 'cohorts';
        $task_table = "CREATE TABLE IF NOT EXISTS " . $table_name . " (
        id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
        cohort_name text NOT NULL  
    )";
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        dbDelta($task_table);
    }
}