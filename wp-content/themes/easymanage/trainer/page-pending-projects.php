<?php

/*
 *  Template Name:Pending Projects Template
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
global $wpdb;
$table_name = $wpdb->prefix . 'projectusers';

$cookieData = returncookie_data();
if (!$cookieData) {
    $errorMessage = json_last_error_msg();
    echo "JSON decoding failed with error: $errorMessage";
} else {

    // Access individual data elements
    $Id = $cookieData['user_id'];
    $Useremail = $cookieData['useremail'];
    $Username = $cookieData['username'];

    // Get all trainees
    $response = wp_remote_post('http://localhost/easymanage/wp-json/api/v1/users/trainees', [
        'method' => 'GET',
    ]);
    $res = wp_remote_retrieve_body($response);
    $traineelists = json_decode($res);
    $traineelists = $traineelists->data;
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
                    <a href="/easymanage/trainer-dashboard/">
                        <div class="side-bar-link">
                            <div class="link">
                                <p><i class=" side-bar-icon-left bi bi-microsoft icon-sidebar"></i> Dashboard</p>
                            </div>
                            <div>
                                <i class="bi bi-chevron-right"></i>
                            </div>
                        </div>
                    </a>
                    <a href="/easymanage/choose-project/">
                        <div class="side-bar-link">
                            <div class="link">
                                <p><i class="side-bar-icon-left bi bi-plus-square-fill icon-sidebar"></i> Add new tasks
                                </p>
                            </div>
                            <div>
                                <i class="bi bi-chevron-right"></i>
                            </div>
                        </div>
                    </a>
                    <a href="/easymanage/pending-projects/">
                        <div class="side-bar-link">
                            <div class="link">
                                <p><i class="side-bar-icon-left bi bi-list-task icon-sidebar"></i> Pending tasks</p>
                            </div>
                            <div>
                                <i class="bi bi-chevron-right"></i>
                            </div>
                        </div>
                    </a>
                    <a href="/easymanage/completed-projects/">
                        <div class="side-bar-link">
                            <div class="link">
                                <p><i class="side-bar-icon-left side-bar-icon-left bi bi-clipboard2-check icon-sidebar"></i>
                                    Completed tasks</p>
                            </div>
                            <div>
                                <i class="bi bi-chevron-right"></i>
                            </div>
                        </div>
                    </a>
                    <a href="/easymanage/my-trainees/">
                        <div class="side-bar-link">
                            <div class="link">
                                <p><i class="side-bar-icon-left bi bi-people-fill icon-sidebar"></i> My trainees</p>
                            </div>
                            <div>
                                <i class="bi bi-chevron-right"></i>
                            </div>
                        </div>
                    </a>
                    <a href="/easymanage/view-all-projects/">
                        <div class="side-bar-link">
                            <div class="link">
                                <p><i class="side-bar-icon-left bi bi-view-stacked"></i> View all projects</p>
                            </div>
                            <div>
                                <i class="bi bi-chevron-right"></i>
                            </div>
                        </div>
                    </a>
                    <a href="/easymanage/deleted-projects/">
                        <div class="side-bar-link">
                            <div class="link">
                                <p><i class="side-bar-icon-left bi bi-trash3-fill"></i> Trash</p>
                            </div>
                            <div>
                                <i class="bi bi-chevron-right"></i>
                            </div>
                        </div>
                    </a>


                    <div>
                    </div>
                    
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
                            <form action="<?php echo site_url("/search") ?>" method="get">
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
                            <p class="no-of-employees profile-picture"><?php echo '+' . $totalusers; ?></p>
                        </div>
                        <div class="top-div-add-trainee-btn">
                            <a class="bottom-div-submit-btn-no-icon  " href="/easymanage/add-trainee/">Add new
                                trainee</a>
                            <i class="bi bi-plus-square"></i>
                        </div>
                    </div>
                    <div class="bottom-div">
                        <div class="styled-table">
                        <?php  $response = wp_remote_get('http://localhost/easymanage/wp-json/api/v1/tasks/', [
                                    'method' => 'GET'
                                ]);
                                $res = wp_remote_retrieve_body($response);
                                $totaltraineetasks = json_decode($res); ?>
                            <?php foreach ($traineelists as $trainee) { ?>
                                <?php
                                
                                $response = wp_remote_get('http://localhost/easymanage/wp-json/api/v1/tasks/' . $trainee->id, [
                                    'method' => 'GET'
                                ]);
                                $res = wp_remote_retrieve_body($response);
                                $traineetasks = json_decode($res);
                                $traineetasks = $traineetasks->data;
                               
                                // Access trainee tasks
                                $trainee_id = $trainee->id;
                               
                                if (is_array($traineetasks)) {
                                    $complete = array_filter($traineetasks, function ($task) {
                                        return $task->status == '3';
                                    });
                                    $notactive = array_filter($traineetasks, function ($task) {
                                        return $task->status == '0';
                                    });
                                    $inprogress = array_filter($traineetasks, function ($task) {
                                        return $task->status == '1';
                                    });
                                    $assigned = count($notactive+$inprogress);
                                }

                                ?>
                               <?php if($complete) { ?>
                                <div class="style-table-profile-column">
                                  
                                    <div class="img">
                                        <img src="<?php echo $profile; ?>" alt="" class="profile-picture">
                                    </div>
                                    <div class="flex status-complete">
                                        <div class="shared-profile-container">
                                            <div>
                                                <p>Wordpress</p>
                                                <p class="name">
                                                    <?php echo $trainee->username; ?>
                                                </p>
                                            </div>
                                            <div class="bottom-div-submit-form">
                                                <?php if (count($inprogress) > 0 && count($complete) == 0) { ?>
                                                    <button class="bottom-div-submit-btn buttons in-progress-btn">
                                                        <p>In progress <span>(<?php echo count($inprogress) ?>)</span></p><i class="bi bi-check-circle-fill"></i>
                                                    </button>
                                                <?php } elseif ($assigned == 0) { ?>
                                                    <button class="bottom-div-submit-btn buttons free-btn">
                                                        <p>free</p>
                                                    </button>
                                                <?php } elseif (count($complete) > 0 && count($inprogress) == 0) { ?>
                                                    <button class="bottom-div-submit-btn buttons complete-btn">
                                                        <p>Complete <span>(<?php echo count($complete) ?>)</span></p><i class="bi bi-check-circle-fill"></i>
                                                    </button>
                                                <?php } elseif (count($complete) > 0 && count($inprogress) > 0) { ?>
                                                    <button class="bottom-div-submit-btn buttons in-progress-btn">
                                                        <p>In progress <span>(<?php echo count($inprogress) ?>)</span></p><i class="bi bi-check-circle-fill"></i>
                                                    </button>
                                                    <button class="bottom-div-submit-btn buttons complete-btn">
                                                        <p>Complete <span>(<?php echo count($complete) ?>)</span></p><i class="bi bi-check-circle-fill"></i>
                                                        </p>
                                                    </button>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class=" assigned-tasks">
                                            <div>
                                                <p>Assigned tasks</p>
                                            </div>
                                            <div class="bottom-div-submit-form">
                                                <p class="tasks">(<?php echo $assigned; ?>)
                                                </p>
                                            </div>
                                        </div>

                                        <div class="shared-profile-container">
                                            <?php
                                            if ($assigned <= 3) { ?>
                                                <button class="bottom-div-submit-btn deactivate-btn">
                                                    <a href="/easymanage/choose-project/">
                                                        <p>Add New</p><i class="bi bi-plus-square-fill"></i>
                                                    </a>
                                                </button>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="shared-profile-container">

                                    </div>
                                </div>
                            <?php } ?>
                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>