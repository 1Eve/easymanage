<?php

/*
 *  Template Name:Admin Restore Deactivated Users Template
 *
 */

?>
<?php
$totalusers = getDisplayedUserCount();

$response = wp_remote_post('http://localhost/easymanage/wp-json/api/v1/users/deactivated/', [
    'method' => 'GET',
]);
$res = wp_remote_retrieve_body($response);
$deletedusers = json_decode($res);
// activeusers tally does not include the admin, add 1 to count the admin. Displayed figure is 3 users, subtract 3 to get the actual displayed figure
if (isset($_POST['restore'])) {
    $id = $_POST['id'];

    $response = wp_remote_post('http://localhost/easymanage/wp-json/api/v1/users/restore/'.$id, [
        'method' => 'PUT',
    ]);
    $res = wp_remote_retrieve_body($response);
    wp_redirect(site_url('/easymanage/deactivated-trainers/'));
    exit();

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
                                <p><i class="side-bar-icon-left bi bi-plus-square-fill icon-sidebar"></i> Create project manager</p>
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
                            <p class="no-of-employees profile-picture"><?php echo '+'. $totalusers; ?></p>
                        </div>
                      
                    </div>
                    <div class="bottom-div">
                        <div class="admin-dashboard-bottom-div">
                            <div class="bottom-div-categories">
                                <a href="">trainees</a>
                                <a href="">trainers</a>
                                <a href="">project managers</a>
                            </div>
                            <div class="deactivate-members-container">
                                <div class="styled-table">
                                    <?php  foreach ($deletedusers as $deleteduser) { ?>
                                    <div class="style-table-profile">
                                        <div>
                                            <img src="<?php echo $profile; ?>" alt="" class="profile-picture">
                                        </div>
                                        <div class="shared-profile-container">
                                            <div>
                                                <p>Project manager</p>
                                                <p class="name"><?php echo $deleteduser->username; ?></p>
                                            </div>
                                            <?php if($deleteduser->status == 1) { ?>
                                            <form action="" method="post">
                                                <input type="hidden" name="id" value="<?php echo $deleteduser->id; ?>">
                                                <div class="bottom-div-submit-form">
                                                    <button type="submit" name="restore" class="bottom-div-submit-btn-no-icon restore-btn buttons">
                                                        <p>Restore</p>
                                                    </button>
                                                </div>
                                            </form>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>