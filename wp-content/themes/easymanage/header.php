<?php 
$cookieName = "userinfo";
// restrict users from accessing the dashboard without havving to login first
if(get_permalink() != site_url('/login/') && !isset($_COOKIE[$cookieName])){  
    wp_redirect(site_url('/easymanage/login'));
    exit;
}
if(get_permalink() ==site_url('/login/') && isset($_COOKIE[$cookieName])){
    wp_redirect(site_url('/'));
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
<h1><i class="bi bi-wordpress"></i> Easy Manage</h1>


