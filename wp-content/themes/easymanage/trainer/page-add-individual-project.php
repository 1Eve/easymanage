<?php

/*
 *  Template Name:Add Individual Project Template
 *
 */

?>
<?php
$totalusers = getDisplayedUserCount();
global $wpdb;
$response = wp_remote_post('http://localhost/easymanage/wp-json/api/v1/users/trainees', [
    'method' => 'GET',
]);
$res = wp_remote_retrieve_body($response);
$traineelist = json_decode($res);
// var_dump($traineelist);
$trainee_name_error = $project_title_error = $project_description_error = '';

if (isset($_POST['create_task'])) {
    $trainee_name = $_POST['trainee_name'];
    $project_title = $_POST['project_title'];
    $project_description = $_POST['project_description'];
    if ($trainee_name == '') {
        $trainee_name_error = 'Trainee name is required';
    }
    if ($project_title == '') {
        $project_title_error = 'Project title is required';
    }
    if ($project_description == '') {
        $project_description_error = 'Project description is required';
    }

    if ($project_description_error == '' && $project_title_error == '' && $trainee_name_error == '') {
        // Retrieve trainee details based on the selected ID
        $response = wp_remote_post('http://localhost/easymanage/wp-json/api/v1/tasks/add/individual', [
            'method' => 'POST',
            'body' => [
                'user_id' => $_POST['trainee_name'],
                'project_title' => $_POST['project_title'],
                'project_description' => $_POST['project_description'],
                ]
            ]);
            $res = wp_remote_retrieve_body($response);
            $individualtask = json_decode($res);
            var_dump($individualtask);
            if ($individualtask) {
                echo "<script>alert('Project created successfully');</script>";
            } else {
                echo "<script>alert('Project not created successfully');</script>";
            }
        
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
            <!-- Main Contents -->
            <div class="main-contents-container flex-project-contents">
                <div class="create-new-project flex-project-contents">
                    <h2>Create new Project</h2>
                    <form action="" method="post">
                        <select class="input select" name="trainee_name" id="user">
                            <?php foreach ($traineelist as $name) { ?>
                                <option value="<?php echo $name->id; ?>">
                                    <?php echo $name->username?>
                                </option>
                                <!-- <input type="hidden" name="trainee_id" value=""> -->
                            <?php } ?>
                        </select>
                        <p>
                            <?php echo $trainee_name_error; ?>
                        </p>
                        <input class="input text-input dark-text" type="text" name="project_title" id=""
                            placeholder="Enter project title">
                        <p>
                            <?php echo $project_title_error; ?>
                        </p>

                        <input class="input text-input dark-text project-description" type="text"
                            name="project_description" id="" placeholder="Enter project description">
                        <p>
                            <?php echo $project_description_error; ?>
                        </p>

                        <input class="input text-input dark-text" type="text" name="" id="" placeholder="dd/mm/yyyy">
                        <input class="input" type="submit" value="Create project" name="create_task">
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>