<?php

/*
 *  Template Name:Login Template
 *
 */

?>
<?php
$cookieName = "userinfo";
if (get_permalink() == site_url('/login/') && isset($_COOKIE[$cookieName])) {
 $role = returncookie_data()['role'];
    if ($role == 'admin') {
        wp_redirect(site_url('/admin-dashboard/'));
        exit;
    } elseif ($role == 'projectmanager') {
        wp_redirect(site_url('/project-manager-dashboard/'));
        exit;
    } elseif ($role == 'trainer') {
        wp_redirect(site_url('/trainer-dashboard/'));
        exit;
    } elseif ($role == 'trainee') {
        wp_redirect(site_url('/trainee-dashboard/'));
        exit;
    }
}
global $email_null_error;
global $password_null_error;
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
                <p>
                    <?php echo $email_null_error; ?>
                </p>
                <label for="">Password</label>
                <input class="input text-input" type="password" name="password" id="" placeholder="........">
                <p>
                    <?php echo $password_null_error ?>
                </p>
                <input class="input" type="submit" value="Login" name="login">
            </form>
        </div>
    </div>
</section>