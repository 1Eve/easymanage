<?php

function easymanagestyles()
{
    wp_enqueue_style('customcss', get_template_directory_uri() . '/custom/custom.css', [], '1.0.0', 'all');
    wp_register_script('customjavascript', get_template_directory_uri() . '/custom/custom.js', [], '1.0.0', true);
    wp_enqueue_script('customjavascript');
    //introducing bootstrap
    wp_register_style('bootstrapcss', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css', [], '5.2.3', 'all');
    wp_enqueue_style('bootstrapcss');


    wp_register_script('jsbootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js', [], '5.2.3', false);
    wp_enqueue_script('jsbootstrap');
    //bootsrap icons
    wp_register_style('bootstrapicons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css', [], '1.10.5', false);
    wp_enqueue_style('bootstrapicons');
}
add_action('wp_enqueue_scripts', 'easymanagestyles');

// ADDING MENUS - HEADER AND FOOTER

function easymanage_theme_support()
{
    add_theme_support('menus');
    register_nav_menu('primary', 'Primary Header');
    register_nav_menu('secondary', 'Secondary Header');
}

add_action('init', 'easymanage_theme_support');


function add_project_manager()
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
add_action('init', 'add_project_manager');
function assign_tasks (){
    global $wpdb;

    $table_name = $wpdb->prefix . 'tasks';

    $task_table = "CREATE TABLE IF NOT EXISTS " . $table_name . " (
        id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
        trainee_name text NOT NULL,
        project_title text NOT NULL,
        project_description text NOT NULL,
        status int NOT NULL
    )";
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    dbDelta($task_table);
}
add_action('init', 'assign_tasks');
function compare_passwords()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'projectusers';

    if (isset($_POST['login'])) {
        $useremail = $_POST['useremail'];
        $userpassword = $_POST['password'];

        $result = $wpdb->get_row("SELECT * FROM $table_name WHERE useremail = '$useremail'");

        if($result){

            $hash_pwd = $result->password;
            if(wp_check_password($userpassword, $hash_pwd) ){
                // var_dump('password matches');
                $userinfo = [
                    'id' => $result->id,
                    'username' => $result->username,
                    'useremail' => $result->useremail,
                ];
                $cookieName = "userinfo";
                $stringuserinfo = json_encode($userinfo);
                $cookieexpiry = time() + (86400*1);
                setcookie('userinfo', $stringuserinfo, $cookieexpiry, "/easymanage/");
                echo "Cookie '$cookieName' has been set.";

                // var_dump(site_url('/view-all-projects'));
                if($result->role == 'admin'){
                    wp_redirect(site_url('/admin-dashboard/'));
                    exit;
                }
                if($result->role == 'projectmanager'){
                    wp_redirect(site_url('/project-manager-dashboard/'));
                exit;
                }
                if($result->role == 'trainer'){
                    wp_redirect(site_url('/trainer-dashboard/'));
                exit;
                }
                if($result->role == 'trainee'){
                    wp_redirect(site_url('/trainee-dashboard/'));
                exit;
                }
                
            }
            else{
                var_dump('passwords dont match ');
            }
        }else{
            echo 'email does not exist';
        }     
    }

    if(isset($_POST['logout'])){
        $cookieName = "userinfo";
        $cookieexpiry = time() - 3600;
        if(isset($_COOKIE[$cookieName])){
            setcookie("$cookieName", "", $cookieexpiry, "/easymanage/" );
        }
        wp_redirect(site_url('/easymanage/login'));
        exit;
    }
}
add_action('init', 'compare_passwords');