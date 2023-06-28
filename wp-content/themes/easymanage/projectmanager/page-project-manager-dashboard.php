<?php

/*
 *  Template Name:Project Manager Dashboard Template
 *
 */

?>
<?php
//search for users

if (isset($_GET['search'])) {
    $response = wp_remote_post('http://localhost/easymanage/wp-json/api/v1/users/search/' . $_GET['search'], [
        'method' => 'GET',
    ]);
    $res = wp_remote_retrieve_body($response);
    $usernames = json_decode($res);
    var_dump($_GET['search']);
}


$totalusers = getDisplayedUserCount();
$response = wp_remote_get('http://localhost/easymanage/wp-json/api/v1/users/trainers', [
    'method' => 'GET',
]);
$res = wp_remote_retrieve_body($response);
$alltrainers = json_decode($res);
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
                                <p><i class="side-bar-icon-left bi bi-plus-square-fill icon-sidebar"></i> Add trainer
                                </p>
                            </div>
                            <div>
                                <i class="bi bi-chevron-right"></i>
                            </div>
                        </div>
                    </a>
                    <a href="/easymanage/create-cohort/">
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
                            <form action="<?php echo site_url("/pm-search") ?>" method="get">
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
                            <!-- <div class="bottom-div-categories">
                                <a href="">trainees</a>
                                <a href="">trainers</a>
                                <a href="">project managers</a>
                            </div> -->
                            <div class="deactivate-members-container">
                                <div class="styled-table">
                                    <?php foreach ($alltrainers as $trainer) { ?>
                                        <div class="style-table-profile">
                                            <div>
                                                <img src="<?php echo $profile; ?>" alt="" class="profile-picture">
                                            </div>
                                            <div class="view-trainer-details">
                                                <div>
                                                    <p>
                                                        <?php echo $trainer->cohort . ' ' . 'Trainer'; ?>
                                                    </p>
                                                    <p class="name">
                                                        <?php echo $trainer->username; ?>
                                                    </p>
                                                    <div class="flex">
                                                        <div>
                                                            <p>No of trainees</p>
                                                        </div>
                                                        <div>
                                                            <p>(20)</p>
                                                        </div>
                                                    </div>
                                                </div>
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