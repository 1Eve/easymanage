<?php

/*
 *  Template Name:Update Program Manager Acc Details
 *
 */

?>
<?php
$totalusers = getDisplayedUserCount();
$cookieData = returncookie_data();
$userid = $cookieData['user_id'];
if (isset($_POST['updateuser'])) {
    $username = $_POST['username'];
    $useremail = $_POST['useremail'];
    $cohortName = $_POST['cohort'];
    $response = wp_remote_post('http://localhost/easymanage/wp-json/api/v1/users/update/projectmanager/' . $userid, [
        'method' => 'PUT',
        'body' => [
            'username' => $username,
            'useremail' => $useremail,
            'cohort' => $cohortName
        ]
    ]);
    $res = wp_remote_retrieve_body($response);
    $details = json_decode($res);
    $accdetails;
    var_dump($details);
    if ($details) {
        updatecookiedata($details);
        echo "<script>alert('User Updated successfully');</script>";
        wp_redirect(site_url('/easymanage/project-manager-acc-details/'));
    } else {
        echo "<script>alert('User not updated successfully');</script>";
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
                                <p class="name small-text">Patrick Mwaniki</p>
                                <p class="small-text">patrickmwanikk@gmail.com</p>
                            </div>
                            <div>
                                <i class="bi bi-chevron-right"></i>
                            </div>
                        </div>
                    </div>
                    <div>
                        <form action="" method="post">
                            <button class="exit" type="submit" name="logout">
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
                            <p class="no-of-employees profile-picture">
                                <?php echo '+' . $totalusers; ?>
                            </p>
                        </div>

                    </div>
                    <div class="bottom-div flex-project-contents">
                        <div class="create-new-project flex-project-contents">
                            <h2>Update Account Details</h2>
                            <form action="" method="post">
                                <input class="input text-input dark-text" type="hidden" name="role" id="" value="">
                                <input class="input text-input dark-text" type="text" name="username" id="" value="<?php echo $cookieData['username']; ?>">
                                <p>
                                    <?php echo $user_name_error ?>
                                </p>
                                <input class="input text-input dark-text" type="email" name="useremail" id="" value="<?php echo $cookieData['useremail']; ?>">
                                <p>
                                    <?php echo $user_email_error ?>
                                </p>
                                <input class="input text-input" type="text" name="cohort" id="" value="<?php echo $cookieData['cohort']; ?>">
                                <p>
                                    <?php echo $pass_error ?>
                                </p>
                                <input class="input" type="submit" value="Update Info" name="updateuser">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>