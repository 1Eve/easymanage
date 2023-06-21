<?php

/*
 *  Template Name:Trainer Dashboard Template
 *
 */

?>

<?php
$totalusers = getDisplayedUserCount();

$cookieData = returncookie_data();
if (!$cookieData) {
    $errorMessage = json_last_error_msg();
    echo "JSON decoding failed with error: $errorMessage";
} else {

    // Access individual data elements
    $Id = $cookieData['id'];
    $Useremail = $cookieData['useremail'];

    // Get all trainees
    $response = wp_remote_post('http://localhost/easymanage/wp-json/api/v1/users/trainees', [
        'method' => 'GET',
    ]);
    $res = wp_remote_retrieve_body($response);
    $traineelists = json_decode($res);
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
                                <p><i
                                        class="side-bar-icon-left side-bar-icon-left bi bi-clipboard2-check icon-sidebar"></i>
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
                        <div class="styled-table">
                            <?php foreach ($traineelists as $trainee) { ?>

                                <?php
                                // Access trainee tasks
                                $trainee_id = $trainee->id;
                                $response = wp_remote_post('http://localhost/easymanage/wp-json/api/v1/tasks/'.$trainee_id, [
                                    'method' => 'GET',
                                ]);
                                $res = wp_remote_retrieve_body($response);
                                $traineetasks = json_decode($res);
                                $complete = array_filter($traineetasks, function ($task) {
                                    return $task->status == 3;
                                });
                                $notactive = array_filter($traineetasks, function ($task) {
                                    return $task->status == 0;
                                });
                                $inprogress = array_filter($traineetasks, function ($task) {
                                    return $task->status == 1;
                                });
                                $assigned = count($traineetasks);
                                foreach ($traineetasks as $task) { ?>
                                <?php } ?>
                                <div class="style-table-profile-column">
                                    <?php //echo "completed" . count($complete) ?>
                                    <?php //echo "In progress" . count($inprogress) ?>
                                    <?php //echo "Not active" . count($notactive) ?>
                                    <?php //echo "Total" . $assigned; ?>
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
                                                        <p>In progress <span>(
                                                                <?php echo count($inprogress) ?>)
                                                            </span></p><i class="bi bi-check-circle-fill"></i>
                                                    </button>
                                                <?php } elseif ($assigned == 0) { ?>
                                                    <button class="bottom-div-submit-btn buttons free-btn">
                                                        <p>free</p>
                                                    </button>
                                                <?php } elseif ($assigned == 1 && count($complete) == 0 && count($inprogress) == 0) { ?>
                                                    <button class="sent-icon">
                                                        <p>1 of 1 sent</p>
                                                    </button>
                                                <?php } elseif (count($complete) > 0 && count($inprogress) == 0) { ?>
                                                    <button class="bottom-div-submit-btn buttons complete-btn">
                                                        <p>Complete <span>(
                                                                <?php echo count($complete) ?>)
                                                            </span></p><i class="bi bi-check-circle-fill"></i>
                                                    </button>
                                                <?php } elseif (count($complete) > 0 && count($inprogress) > 0) { ?>
                                                    <button class="bottom-div-submit-btn buttons in-progress-btn">
                                                        <p>In progress <span>(
                                                                <?php echo count($inprogress) ?>)
                                                            </span></p><i class="bi bi-check-circle-fill"></i>
                                                    </button>
                                                    <button class="bottom-div-submit-btn buttons complete-btn">
                                                        <p>Complete <span>(
                                                                <?php echo count($complete) ?>)
                                                            </span></p><i class="bi bi-check-circle-fill"></i>
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
                                                <p class="tasks">(
                                                    <?php echo $assigned; ?>)
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>