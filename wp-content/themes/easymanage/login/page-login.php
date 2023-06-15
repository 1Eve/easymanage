<?php

/*
 *  Template Name:Login Template
 *
 */

?>
<?php
global $wpdb;
$table_name = $wpdb->prefix . 'projectusers';
$result = $wpdb->get_row("SELECT * FROM $table_name");
$cookieName = "userinfo";
if (get_permalink() == site_url('/login/') && isset($_COOKIE[$cookieName])) {

    if ($result->role == 'admin') {
        wp_redirect(site_url('/admin-dashboard/'));
        exit;
    } elseif ($result->role == 'projectmanager') {
        wp_redirect(site_url('/project-manager-dashboard/'));
        exit;
    } elseif ($result->role == 'trainer') {
        wp_redirect(site_url('/trainer-dashboard/'));
        exit;
    } elseif ($result->role == 'trainee') {
        wp_redirect(site_url('/trainee-dashboard/'));
        exit;
    }
}

?>
<?php wp_head(); ?>


<section class="container-login outer-container">
    <div class="login inner-container">
        <div class="logo">
            <h1><i class="bi bi-wordpress"></i> Easy Manage</h1>
        </div>
        <div class="login-form">
            <h2>Welcome Back</h2>
            <form action="" method="post">
                <label for="">Email</label>
                <input class="input text-input" type="email" name="useremail" id="" placeholder="Enter your email">
                <label for="">Password</label>
                <input class="input text-input" type="password" name="password" id="" placeholder="........">
                <input class="input" type="submit" value="Login" name="login">
            </form>
        </div>
    </div>
</section>