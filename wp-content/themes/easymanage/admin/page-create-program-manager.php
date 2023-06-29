<?php

/*
 *  Template Name:Create Program Manager Template
 *
 */

?>
<?php
$cookieData = returncookie_data();

$totalusers = getDisplayedUserCount();
$user_name_error = "";
$user_email_error = "";
$pass_error = "";

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

        $response = wp_remote_post('http://localhost/easymanage/wp-json/api/v1/users/projectmanager', [
            'method' => 'POST',
            'body' => [
                'role' => $_POST['role'],
                'username' => $_POST['username'],
                'useremail' => $_POST['useremail'],
                'password' => $_POST['password']
            ]
        ]);
        $res = wp_remote_retrieve_body($response);
        $userinfo = json_decode($res);
        var_dump($userinfo);
        if ($userinfo) {
            echo "<script>alert('User created successfully');</script>";
        } else {
            echo "<script>alert('User not created successfully');</script>";
        }
    }

}

?>
<?php $profile = get_template_directory_uri() . '/assets/memoji-modified.png'; ?>


<section class="container-admin-dashboard outer-container">
    <div class="inner-container">
        <div class="header">
            <?php get_header(); ?>
        </div>
        <div class="dashboard-container">
            <div class="side-bar-container">
                <div class="side-bar-top">
                    <h4>MAIN</h4>
                    <a href="/easymanage/admin-dashboard/">
                        <div class="side-bar-link">
                            <div class="link">
                                <p><i class="side-bar-icon-left bi bi-microsoft icon-sidebar"></i> Dashboard</p>
                            </div>
                            <div>
                                <i class="bi bi-chevron-right"></i>
                            </div>
                        </div>
                    </a>

                    <a href="/easymanage/create-project-manager/">
                        <div class="side-bar-link">
                            <div class="link">
                                <p><i class="side-bar-icon-left bi bi-plus-square-fill icon-sidebar"></i> Create project
                                    manager</p>
                            </div>
                            <div>
                                <i class="bi bi-chevron-right"></i>
                            </div>
                        </div>
                    </a>

                    <a href="/easymanage/deactivated-trainers/">
                        <div class="side-bar-link">
                            <div class="link">
                                <p><i class="side-bar-icon-left bi bi-trash3-fill"></i> Trash</p>
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
                                <p class="name small-text"><?php echo $cookieData['username'];?></p>
                                <p class="small-text"><?php echo $cookieData['useremail'];?></p>
                            </div>
                            <div>
                                <i class="bi bi-chevron-right"></i>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="main-contents-container">
                <div class="inner-main-contents-container">
                    <div class="top-div">
                    <div>
                            <form action="<?php echo site_url("/admin-search") ?>" method="get">
                                <div class="search">
                                    <input class="search-input" name="search" type="text" placeholder="Searching for someone?">
                                    <button type="submit"><i class="bi bi-search"></i></button>
                                </div>
                            </form>
                        </div>
                        <div class="employee-emojis">
                            <img src="<?php echo $profile; ?>" alt="" class="profile-picture">
                            <img src="<?php echo $profile; ?>" alt="" class="profile-picture">
                            <img src="<?php echo $profile; ?>" alt="" class="profile-picture">
                            <p class="no-of-employees profile-picture">
                                <?php echo '+' . $totalusers; ?>
                            </p>
                        </div>

                    </div>
                    <div class="bottom-div flex-project-contents">
                        <div class="create-new-project flex-project-contents">
                            <h2>Add Project Manager</h2>
                            <form action="" method="post">
                                <input class="input text-input dark-text" type="hidden" name="role" id=""
                                    value="projectmanager">
                                <input class="input text-input dark-text" type="text" name="username" id=""
                                    placeholder="Enter name">
                                <p>
                                    <?php echo $user_name_error ?>
                                </p>
                                <input class="input text-input dark-text" type="email" name="useremail" id=""
                                    placeholder="Enter email">
                                <p>
                                    <?php echo $user_email_error ?>
                                </p>
                                <input class="input text-input" type="password" name="password" id=""
                                    placeholder="........">
                                <p>
                                    <?php echo $pass_error ?>
                                </p>
                                <input class="input" type="submit" value="Create project manager" name="createuser">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>