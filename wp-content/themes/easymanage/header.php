<?php
global $wpdb;
$table_name = $wpdb->prefix . 'projectusers';
$result = $wpdb->get_row("SELECT * FROM $table_name");
$cookieName = "userinfo";
// restrict users from accessing the dashboard without havving to login first
if (get_permalink() != site_url('/login/') && !isset($_COOKIE[$cookieName])) {
    wp_redirect(site_url('/easymanage/login'));
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Easy Manage</title>
    <?php wp_head(); ?>
</head>

<body>
    <nav class="">
        <div>
            <h1><i class="bi bi-wordpress"></i> Easy Manage</h1>
        </div>
        <div>
            <form action="" method="post">
                <button class="exit" type="submit" name="logout">
                    
                    <h5><i class="bi bi-box-arrow-left"></i>  Logout</h5>
                </button>
            </form>
        </div>
    </nav>