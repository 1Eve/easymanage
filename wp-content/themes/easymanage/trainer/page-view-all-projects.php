<?php

/*
 *  Template Name:View All Projects Template
 *
 */

?>
<?php
$totalusers = getDisplayedUserCount();

$cookieData = returncookie_data();
$cohortName = $cookieData['cohort'];
if (!$cookieData) {
    $errorMessage = json_last_error_msg();
    echo "JSON decoding failed with error: $errorMessage";
} else {

    // Access individual
    $response = wp_remote_post('http://localhost/easymanage/wp-json/api/v1/tasks', [
        'method' => 'GET',
    ]);
    $res = wp_remote_retrieve_body($response);
    $tasklists = json_decode($res);
    $tasklists = $tasklists->data;

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
}


$table_name = $wpdb->prefix . 'projectusers';

?>
<?php $profile = get_template_directory_uri() . '/assets/memoji-modified.png'; ?>

<section class="container-admin-dashboard outer-container">
    <div class="inner-container">
        <div class="header">
            <?php get_header(); ?>
        </div>
        <div class="dashboard-container">
            <div class="side-bar-container">
                <h4>MAIN</h4>
                <div class="side-bar-top">
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
                    <h4>TEAMS</h4>
                    <div class="side-bar-groups">
                        <p><i class="bi bi-circle-fill icon-circle"></i> Group 1</p>
                    </div>
                    <div class="side-bar-groups">
                        <p><i class="bi bi-circle-fill icon-circle"></i> Group 1</p>
                    </div>
                    <div class="side-bar-groups">
                        <p><i class="bi bi-circle-fill icon-circle"></i> Group 1</p>
                    </div>
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
                        <div class="top-div-add-trainee-btn">
                            <a class="bottom-div-submit-btn-no-icon  " href="/easymanage/add-trainee/">Add new
                                trainee</a>
                            <i class="bi bi-plus-square"></i>
                        </div>
                    </div>
                    <div class="bottom-div">
                        <?php foreach ($tasklists as $tasklist) { ?>
                            <?php if ($tasklist->cohort == $cohortName) { ?>
                                <?php // Access trainee tasks
                                $response = wp_remote_get('http://localhost/easymanage/wp-json/api/v1/tasks/' . $tasklist->id, [
                                    'method' => 'GET'
                                ]);
                                $res = wp_remote_retrieve_body($response);
                                $traineetasks = json_decode($res);
                                $traineetasks = $traineetasks->data;
                                $complete = array_filter($traineetasks, function ($task) {
                                    return $task->status == 3;
                                });
                                $notactive = array_filter($traineetasks, function ($task) {
                                    return $task->status == 1;
                                });
                                $inprogress = array_filter($traineetasks, function ($task) {
                                    return $task->status == 2;
                                });
                                $assigned = count($traineetasks);
                                foreach ($traineetasks as $task) { ?>
                                <?php } ?>

                                <div class="style-table-profile-column">
                                    <?php if ($notactive) { ?>
                                        <div class="buttons status-on-top status-on-top-in-not-activated">
                                            <p>Not Launched</p>
                                        </div>
                                    <?php } else if ($inprogress) { ?>
                                        <div class="buttons status-on-top status-on-top-in-progress">
                                            <p>In progress</p>
                                        </div>
                                    <?php } elseif ($complete) { ?>
                                        <div class="buttons status-on-top status-on-top-complete">
                                            <p>Complete</p>
                                        </div>
                                    <?php } ?>
                                    <div class="flex">
                                        <div class="img">
                                            <img src="<?php echo $profile; ?>" alt="" class="profile-picture">
                                            <p class="name">
                                                <?php echo $tasklist->username; ?>
                                            </p>
                                        </div>
                                        <div>
                                            <div class=" assigned-tasks">
                                                <div class="project-descr-for-all-tasks">
                                                    <div class="status-container">
                                                        <?php if ($notactive) { ?>
                                                            <div>
                                                                <i class="not-activated-icon bi bi-square-fill"></i>
                                                            </div>
                                                        <?php } else if ($inprogress) { ?>
                                                            <div>
                                                                <i class="in-progress-icon bi bi-square-fill"></i>
                                                            </div>
                                                        <?php } elseif ($complete) { ?>
                                                            <div>
                                                                <i class="complete bi bi-square-fill"></i>
                                                            </div>
                                                        <?php } ?>
                                                        <div>
                                                            <p>Project description</p>
                                                        </div>
                                                    </div>
                                                    <div class="justify-content">
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                                            eiusmod
                                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                                                            veniam,
                                                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                                            commodo
                                                            consequat.</p>

                                                        <div class="bottom-div-submit-form">
                                                            <?php if ($notactive) { ?>

                                                                <form action="" method="post">
                                                                    <input type="hidden" name="task_id">
                                                                    <input type="submit" name="update_task" value="Update">
                                                                </form>
                                                            <?php } else if ($inprogress) { ?>
                                                                <p class="tasks in-progress"><i class="bi bi-hourglass-split"></i>
                                                                </p>

                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>