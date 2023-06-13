<?php

/*
 *  Template Name:Login Template
 *
 */

?>

<?php wp_head(); ?>
<?php

global $wpdb;

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];
    $user = wp_signon(
        [
            'user_email' => $email,
            'user_pass' => $password,
        ]
    );

}
?>

<section class="container-login outer-container">
    <div class="login inner-container">
        <div class="logo">
            <h1><i class="bi bi-wordpress"></i> Easy Manage</h1>
        </div>
        <div class="login-form">
            <h2>Welcome Back</h2>
            <form action="" method="post">
                <label for="">Email</label>
                <input class="input text-input" type="email" name="email" id="" placeholder="Enter your email">
                <label for="">Password</label>
                <input class="input text-input" type="password" name="password" id="" placeholder="........">
                <input class="input" type="submit" value="Login" name="login">
            </form>
        </div>
    </div>
</section>