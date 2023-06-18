<?php

/*
 *  Template Name:Create Trainer Template
 *
 */

?>
<?php
$user_name_error = "";
$user_email_error = "";
$pass_error = "";

$table_name = $wpdb->prefix . 'projectusers';

if (isset($_POST['createuser'])) {
    $username = $_POST['username'];
    $useremail = $_POST['useremail'];
    $password = $_POST['password'];

    if ($username == '') {
        $user_name_error = "Name is required !";
    }
    if ($useremail == '') {
        $user_email_error = "Email is required !";
    }
    if ($password == '') {
        $pass_error = "Password is required !";
    }
    if ($user_name_error == '' && $user_email_error == '' && $pass_error == '') {
        $username = $_POST['username'];
        $useremail = $_POST['useremail'];
        $role = $_POST['role'];
        $pwd = $_POST['password'];
        $hash_pwd = wp_hash_password($pwd);
        $result = $wpdb->get_row("SELECT id FROM $table_name WHERE useremail = '$useremail'");
        $result = $wpdb->insert($table_name, [
            'username' => $username,
            'useremail' => $useremail,
            'password' => $hash_pwd,
            'role' => $role
        ]);
        if ($result) {
            echo "<script>alert('User created successfully');</script>";
        } else {
            echo "<script>alert('User not created successfully');</script>";
        }
    }

}

?>
<?php $profile = get_template_directory_uri() . '/assets/memoji-modified.png'; ?>

<?php 
// add_project_manager();
?>

<section class="container-admin-dashboard outer-container">
    <div class="inner-container">
        <div class="header">
            <?php get_header(); ?>
        </div>
        <div class="dashboard-container">
            <div class="side-bar-container">

                <div class="side-bar-top">
                    <h4>MAIN</h4>
                    <a href="/easymanage/project-manager-dashboard/">
                        <div class="side-bar-link">
                            <div class="link">
                                <p><i class="side-bar-icon-left bi bi-microsoft icon-sidebar"></i> Dashboard</p>
                            </div>
                            <div>
                                <i class="bi bi-chevron-right"></i>
                            </div>
                        </div>
                    </a>

                    <a href="/easymanage/add-trainer/">
                        <div class="side-bar-link">
                            <div class="link">
                                <p><i class="side-bar-icon-left bi bi-plus-square-fill icon-sidebar"></i> Add trainer</p>
                            </div>
                            <div>
                                <i class="bi bi-chevron-right"></i>
                            </div>
                        </div>
                    </a>
                    <a href="/easymanage/project-manager-dashboard/">
                        <div class="side-bar-link">
                            <div class="link">
                                <p><i class="bi bi-pencil-fill"></i> Create new cohort</p>
                            </div>
                            <div>
                                <i class="bi bi-chevron-right"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div>
                    <div class="profile">
                        <div>
                            <img src="<?php echo $profile; ?>" alt="">
                        </div>
                        <div class="name-and-email-container">
                            <div>
                                <p class="name small-text">Patrick Mwaniki</p>
                                <p class="small-text">patrickmwanikk@gmail.com</p>
                            </div>
                            <div>
                                <i class="bi bi-chevron-right"></i>
                            </div>
                        </div>
                    </div>
                    <div >
                        <form action="" method="post">
                            <button class="exit" type="submit" name = "logout">
                                <h5><i class="bi bi-box-arrow-left"></i></h5>
                            </button>
                        </form>
                    </div>
                </div>

            </div>
            <div class="main-contents-container">
                <div class="inner-main-contents-container">
                <div class="top-div">
                        <div>
                            <form action="">
                                <div class="search">
                                    <input class="search-input" type="text" placeholder="Searching for someone?">
                                    <button type="submit"><i class="bi bi-search"></i></button>
                                </div>
                            </form>
                        </div>
                        <div class="employee-emojis">
                            <img src="<?php echo $profile; ?>" alt="" class="profile-picture">
                            <img src="<?php echo $profile; ?>" alt="" class="profile-picture">
                            <img src="<?php echo $profile; ?>" alt="" class="profile-picture">
                            <p class="no-of-employees profile-picture">+6</p>
                        </div>
                       
                    </div>
                    <div class="bottom-div flex-project-contents">
                        <div class="create-new-project flex-project-contents">
                            <h2>Add Trainer</h2>
                            <form action="" method="post">
                            <input class="input text-input dark-text" type="hidden" name="role" id=""
                                    value="trainer">
                                <input class="input text-input dark-text" type="text" name="username" id=""
                                    placeholder="Enter name">
                                <input class="input text-input dark-text" type="email" name="useremail" id=""
                                    placeholder="Enter email">
                                <input class="input text-input" type="password" name="password" id="password" placeholder="........">
                                <input class="input text-input dark-text" type="text" name="" id=""
                                    placeholder="--select cohort--">
                                <p>Not the cohort you looking for? <span><a class="create-a-cohort" href="/easymanage/create-cohort/">create a cohort</a></span></p>
                                <input class="input" type="submit" value="Create trainer" name="createuser">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>