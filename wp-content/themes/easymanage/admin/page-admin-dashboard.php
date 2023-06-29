<?php

/*
 *  Template Name:Admin Dashboard Template
 *
 */

?>

<?php
$cookieData = returncookie_data();
$totalusers = getDisplayedUserCount();
$response = wp_remote_get('http://localhost/easymanage/wp-json/api/v1/users/active', [
    'method' => 'GET',
]);
$res = wp_remote_retrieve_body($response);
$activeusers = json_decode($res);
$activeusers = $activeusers->data;

// activeusers tally does not include the admin, add 1 to count the admin. Displayed figure is 3 users, subtract 3 to get the actual displayed figure
if (isset($_POST['deactivate'])) {
    $id = $_POST['id'];

    $response = wp_remote_post('http://localhost/easymanage/wp-json/api/v1/users/delete/'.$id, [
        'method' => 'PUT',
    ]);
    $res = wp_remote_retrieve_body($response);
    $clickedid = json_decode($res);
    var_dump($clickedid);
    wp_redirect(site_url('/easymanage/admin-dashboard'));
    exit();

}
// if (isset($_POST['deactivate'])) {
//     echo 'meeeeeeeeeeeeeeeeeeeeeeeeeeeeee';

// }

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
                    <div class="bottom-div">
                        <div class="admin-dashboard-bottom-div">
                            <div class="bottom-div-categories">
                                <a href="">trainees</a>
                                <a href="">trainers</a>
                                <a href="">project managers</a>
                            </div>
                            <div class="deactivate-members-container">
                                <div class="styled-table">
                                    <?php foreach ($activeusers as $activeuser) { ?>

                                        <div class="style-table-profile">
                                            <div>
                                                <img src="<?php echo $profile; ?>" alt="" class="profile-picture">
                                            </div>
                                            <div class="shared-profile-container">
                                                <div>
                                                    <p>
                                                        <?php // echo $activeuser->cohort; ?>
                                                    </p>
                                                    <p class="name">
                                                        <?php echo $activeuser->username; ?>
                                                    </p>
                                                </div>
                                                <?php if ($activeuser->status == 0) { ?>
                                                    <div class="bottom-div-submit-form">
                                                        <form action="" method="post">
                                                            <?php var_dump($activeuser->status); ?>
                                                            <input type="hidden" name="id"
                                                                value="<?php echo $activeuser->id; ?>">
                                                            <button type="submit" name="deactivate"
                                                                class="bottom-div-submit-btn buttons deactivate-btn">
                                                                <p>Deactivate</p><i class="bi bi-x-circle-fill"></i>
                                                            </button>
                                                        </form>
                                                    </div>
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