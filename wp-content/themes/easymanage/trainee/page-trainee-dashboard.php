<?php

/*
 *  Template Name:Trainee Dashboard Template
 *
 */

?>
<?php
$cookieData = returncookie_data();
if (!$cookieData) {
    $errorMessage = json_last_error_msg();
    echo "JSON decoding failed with error: $errorMessage";
} else {

    // Access individual data elements
    $Id = $cookieData['id'];
    $Useremail = $cookieData['useremail'];
    // Access individual
    $response = wp_remote_post('http://localhost/easymanage/wp-json/api/v1/tasks', [
        'method' => 'GET',
    ]);
    $res = wp_remote_retrieve_body($response);
    $tasklists = json_decode($res);
}

if (isset($_POST['launch_project'])) {
    $task_id = $_POST['task_id'];
    $response = wp_remote_post('http://localhost/easymanage/wp-json/api/v1/tasks/'.$task_id, [
        'method' => 'PUT',
    ]);
    $res = wp_remote_retrieve_body($response);
    $userinfo = json_decode($res);
    wp_redirect(site_url('/easymanage/trainee-dashboard/'));
}
if (isset($_POST['markproject_complete'])) {
    $task_id = $_POST['task_id'];
    $response = wp_remote_post('http://localhost/easymanage/wp-json/api/v1/tasks/markcomplete/'.$task_id, [
        'method' => 'PUT',
    ]);
    $res = wp_remote_retrieve_body($response);
    $userinfo = json_decode($res);
    wp_redirect(site_url('/easymanage/trainee-dashboard/'));
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
                    <a href="/easymanage/trainee-dashboard/">
                        <div class="side-bar-link">
                            <div class="link">
                                <p><i class="side-bar-icon-left bi bi-microsoft icon-sidebar"></i> Dashboard</p>
                            </div>
                            <div>
                                <i class="bi bi-chevron-right"></i>
                            </div>
                        </div>
                    </a>
                    <a href="/easymanage/trainee-completed-projects/">
                        <div class="side-bar-link">
                            <div class="link">
                                <p><i class="side-bar-icon-left bi bi-clipboard2-check icon-sidebar"></i> Completed</p>
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
                                    <input class <input class="search-input" type="text"
                                        placeholder="Searching for someone?">
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
                    <div class="bottom-div">
                        <?php foreach ($tasklists as $tasklist) { ?>
                            <?php if ($tasklist->status != 3) { ?>
                                <div class="style-table-profile-column">
                                    <?php if ($tasklist->status == 0) { ?>
                                        <div class="buttons status-on-top status-on-top-in-not-activated">
                                            <p>Not Launched</p>
                                        </div>
                                    <?php } else if ($tasklist->status == 1) { ?>
                                            <div class="buttons status-on-top status-on-top-in-progress">
                                                <p>In progress</p>
                                            </div>
                                    <?php } ?>
                                    <div class="my-project">
                                        <div class="img">
                                            <img src="<?php echo $profile; ?>" alt="" class="profile-picture">
                                            <p class="name">
                                                <?php echo $tasklist->username; ?>
                                            </p>
                                        </div>
                                        <div class="my-project-description">
                                            <div class="project-status">
                                                <?php if ($tasklist->status == 0) { ?>
                                                    <p class="project-name"><i class="not-activated-icon bi bi-square-fill"></i>
                                                        <?php echo $tasklist->project_title; ?>
                                                    </p>

                                                <?php } else if ($tasklist->status == 1) { ?>
                                                        <p class="project-name"><i class="in-progress-icon bi bi-square-fill"></i>
                                                        <?php echo $tasklist->project_title; ?>
                                                        </p>
                                                <?php } ?>
                                            </div>
                                            <div class="project-description">
                                                <div class="description">
                                                    <?php echo $tasklist->project_description; ?>
                                                </div>
                                                <div>
                                                    <?php if ($tasklist->status == 0) { ?>
                                                        <form action="" method="post">
                                                            <input type="hidden" value="<?php echo $tasklist->task_id; ?>"
                                                                name="task_id">
                                                            <input class="launch-btn" type="submit" value="Launch"
                                                                name="launch_project">
                                                        </form>
                                                    <?php } else if ($tasklist->status == 1) { ?>
                                                            <form action="" method="post">
                                                                <input type="hidden" value="<?php echo $tasklist->task_id; ?>"
                                                                    name="task_id">
                                                                <input class="project-in-progress-icon" type="submit"
                                                                    value="Mark as Complete" name="markproject_complete">
                                                            </form>
                                                    <?php } ?>
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
</section>
<?php get_footer(); ?>