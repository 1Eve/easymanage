<?php

/*
 *  Template Name:Deeleted Projects Template
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
$cookieData = returncookie_data();
// Access individual data elements
$Id = $cookieData['user_id'];
$Useremail = $cookieData['useremail'];
$Username = $cookieData['username'];
$cohortName = $cookieData['cohort'];
$cohortName = $cookieData['cohort'];


// Get all trainees and tasks
$response = wp_remote_post('http://localhost/easymanage/wp-json/api/v1/users/trainees', [
    'method' => 'GET',
]);
$res = wp_remote_retrieve_body($response);
$traineelists = json_decode($res);
$traineelists = $traineelists->data;

// Restore deleted tasks 
$response = wp_remote_post('http://localhost/easymanage/wp-json/api/v1/tasks/restoreproject/', [
    'method' => 'PUT',
]);
$res = wp_remote_retrieve_body($response);
$responseBody = json_decode($res);


if (isset($_POST['restoreproject'])) {
    $task_id = $_POST['task_id'];

    $response = wp_remote_post('http://localhost/easymanage/wp-json/api/v1/tasks/restoreproject/' . $task_id, [
        'method' => 'PUT',
    ]);
    $res = wp_remote_retrieve_body($response);
    $userinfo = json_decode($res);
    wp_redirect(site_url('/easymanage/view-all-projects/'));
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
                        <?php foreach ($traineelists as $tasklist) {
                        ?>
                            <?php if ($tasklist->cohort == $cohortName) { ?>
                                <?php // Access trainee tasks
                                $response = wp_remote_get('http://localhost/easymanage/wp-json/api/v1/tasks/' . $tasklist->id, [
                                    'method' => 'GET'
                                ]);
                                $res = wp_remote_retrieve_body($response);
                                $traineetasks = json_decode($res);
                                $traineetasks = $traineetasks->data;

                                $deletedtasks = array_filter($traineetasks, function ($task) {
                                    return $task->status == 0;
                                });
                                //var_dump($deletedtasks);
                                $assigned = count($traineetasks);
                                ?>
                                <?php foreach ($traineetasks as $traineetask) { 
                                    ?>
                                    <?php if ($deletedtasks) { ?>
                                        <div class="style-table-profile-column">
                                            <div class="flex">
                                                <div class="img">
                                                    <img src="<?php echo $profile; ?>" alt="" class="profile-picture">
                                                    <p class="name">Usher Njari</p>
                                                </div>
                                                <div>
                                                    <div class=" assigned-tasks">
                                                        <div class="project-descr-for-all-tasks">
                                                            <div class="status-container">
                                                                <div>
                                                                    <p class="name"><?php echo $traineetask->project_title; ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="justify-content">
                                                                <p><?php echo $traineetask->project_description; ?></p>
                                                                <div class="bottom-div-submit-form">
                                                                    <form action="" method="post">
                                                                        <input type="hidden" name="task_id" value="<?php echo $traineetask->id; ?>">
                                                                        <input type="submit" value="Restore" name="restoreproject">
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                        <div class="style-table-profile-column">
                            <div class="flex">
                                <div class="img">
                                    <img src="<?php echo $profile; ?>" alt="" class="profile-picture">
                                    <p class="name">Usher Njari</p>
                                </div>
                                <div>
                                    <div class=" assigned-tasks">
                                        <div class="project-descr-for-all-tasks">
                                            <div class="status-container">
                                                <div>
                                                    <p class="name">Project description</p>
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
                                                    <p class="restore-btn">Restore
                                                    </p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
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