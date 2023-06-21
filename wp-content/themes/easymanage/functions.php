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



function compare_passwords()
{
    if (isset($_POST['login'])) {
        $useremail = $_POST['useremail'];
        $userpassword = $_POST['password'];
        if ($useremail == '') {
            global $email_null_error;
            $email_null_error = 'Email is required';
        }
        if ($userpassword == '') {
            global $password_null_error;
            $password_null_error = 'Password is required';
        }
        if ($userpassword != '' && $userpassword != '') {
            $response = wp_remote_post('http://localhost/easymanage/wp-json/api/v1/login', [
                'method' => 'POST',
                'body' => [
                    'useremail' => $_POST['useremail'],
                    'password' => $_POST['password']
                ]
            ]);
            $res = wp_remote_retrieve_body($response);
            $userinfo = json_decode($res);
            if (isset($userinfo->id)) {
                $cookieName = 'userinfo';
                $stringuserinfo = json_encode($userinfo);
                $cookieexpiry = time() + (86400 * 1);
                setcookie($cookieName, $stringuserinfo, $cookieexpiry, "/easymanage/");
                $role = $userinfo->role;
                if ($role == 'admin') {
                    wp_redirect(site_url('/admin-dashboard/'));
                    exit;
                }
                if ($role == 'projectmanager') {
                    wp_redirect(site_url('/project-manager-dashboard/'));
                    exit;
                }
                if ($role == 'trainer') {
                    wp_redirect(site_url('/trainer-dashboard/'));
                    exit;
                }
                if ($role == 'trainee') {
                    wp_redirect(site_url('/trainee-dashboard/'));
                    exit;
                }
            }
        }
    }
    if (isset($_POST['logout'])) {
        $cookieName = "userinfo";
        $cookieexpiry = time() - 3600;
        if (isset($_COOKIE[$cookieName])) {
            setcookie("$cookieName", "", $cookieexpiry, "/easymanage/");
        }
        wp_redirect(site_url('/easymanage/login'));
        exit;
    }
}

add_action('init', 'compare_passwords');

// Return $CookieData

function returncookie_data()
{
    if (isset($_COOKIE['userinfo'])) {
        $cookieValue = $_COOKIE['userinfo'];
        $cookieValue = trim($cookieValue); // Remove leading/trailing white spaces
        $cookieValue = stripslashes($cookieValue); // Remove any backslashes

        $cookieData = json_decode($cookieValue, true);
        return $cookieData;
    } else {
        return false;
    }
}

// tally number of displayed users

function getDisplayedUserCount()
{
    $response = wp_remote_post('http://localhost/easymanage/wp-json/api/v1/users/active', [
        'method' => 'GET',
    ]);
    $res = wp_remote_retrieve_body($response);
    $activeusers = json_decode($res);
    //activeusers tally does not include the admin add 1 to count the admin displayed is 3 users -3 to get actual displayed figure
    $totalusers = (count($activeusers) + 1) - 3;
    return $totalusers;
}