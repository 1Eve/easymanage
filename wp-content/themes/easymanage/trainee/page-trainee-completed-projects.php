<?php
/*
 *  Template Name:Trainee Completed Projects Template
 *
 */

?>

<?php
//search for users
$totalusers = getDisplayedUserCount();
if (isset($_GET['search'])) {
    $response = wp_remote_post('http://localhost/easymanage/wp-json/api/v1/users/search/' . $_GET['search'], [
        'method' => 'GET',
    ]);
    $res = wp_remote_retrieve_body($response);
    $usernames = json_decode($res);
    // var_dump($_GET['search']);
}


$cookieData = returncookie_data();
if (!$cookieData) {
    $errorMessage = json_last_error_msg();
    echo "JSON decoding failed with error: $errorMessage";
} else {
    // Access individual data elements
    $Id = $cookieData['user_id'];
    $Useremail = $cookieData['useremail'];
    $Username = $cookieData['username'];
    
    // Access individual
    $response = wp_remote_post('http://localhost/easymanage/wp-json/api/v1/tasks/' . $Id, [
        'method' => 'GET',
    ]);
    $res = wp_remote_retrieve_body($response);
    $tasklists = json_decode($res);
    $tasklists = $tasklists->data;
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
                <a href="<?php echo site_url("/easymanage/trainee-acc-details") ?>">
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
                    </a>
                    
                </div>
            </div>
            <div class="main-contents-container">
                <div class="inner-main-contents-container">
                    <div class="top-div">
                    <div>
                            <form action="<?php echo site_url("/trainee-search") ?>" method="get">
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
                            <p class="no-of-employees profile-picture">+6</p>
                        </div>

                    </div>
                    <div class="bottom-div">
                        <?php

                        if (is_array($tasklists)) {
                            $complete = array_filter($tasklists, function ($task) {
                                return $task->status == '3';
                            });
                            $notactive = array_filter($tasklists, function ($task) {
                                return $task->status == '0';
                            });
                            $inprogress = array_filter($tasklists, function ($task) {
                                return $task->status == '1';
                            });
                            $assigned = count($tasklists);
                        }
                        ?>
                        <?php foreach ($tasklists as $tasklist) {
                           ?>

                            <?php if ($complete) { ?>
                                <div class="style-table-profile-column">
                                    <?php if ($complete) { ?>
                                        <div class="buttons status-on-top status-on-top-complete">
                                            <p>Complete</p>
                                        </div>
                                    <?php } ?>
                                    <div class="my-project">
                                        <div class="img">
                                            <img src="<?php echo $profile; ?>" alt="" class="profile-picture">
                                            <p class="name">
                                                <?php echo $Username; ?>
                                            </p>
                                        </div>
                                        <div class="my-project-description">
                                            <div class="project-status">
                                                <?php if ($complete) { ?>
                                                    <p class="project-name"><i class="complete bi bi-square-fill"></i>
                                                        <?php echo $tasklist->project_title; ?>
                                                    </p>
                                                <?php } ?>
                                            </div>
                                            <div class="project-description">
                                                <div class="description">
                                                    <?php echo $tasklist->project_description; ?>
                                                </div>
                                                <div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                        <div class="style-table-profile-column">
                            <div class="buttons status-on-top status-on-top-complete">
                                <p>Complete</p>
                            </div>
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
                                                    <i class="complete bi bi-square-fill"></i>
                                                </div>
                                                <div>
                                                    <p class="">Project description</p>
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
                                                    <p class="complete-icon"><i class="bi bi-check-circle-fill"></i>
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