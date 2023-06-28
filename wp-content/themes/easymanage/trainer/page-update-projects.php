<?php

/*
 *  Template Name: Update Project Details Template
 *
 */

?>
<?php

$totalusers = getDisplayedUserCount();
$cookieData = returncookie_data();
$project_id = $_GET['project_id'];
//Get tasks
$response = wp_remote_post('http://localhost/easymanage/wp-json/api/v1/tasks/single/' . $project_id, [
    'method' => 'GET',
]);
$res = wp_remote_retrieve_body($response);
$tasklists = json_decode($res);
$tasklists = $tasklists->data;
$assignedtrainees = explode(',', $tasklists->assignees);


// Access individual data elements
$CohortName = $cookieData['cohort'];

// Get total trainee assigned tasks 
$response = wp_remote_post('http://localhost/easymanage/wp-json/api/v1/tasks/totalassigned', [
    'method' => 'GET',
]);
$totalresponse = wp_remote_retrieve_body($response);
$available = json_decode($totalresponse);

$trainee_name_error = $project_title_error = $project_description_error = '';

if (isset($_POST['update_task'])) {
    // var_dump($_POST);
    // var_dump(array_values($_POST['assignees']));
    $trainee_name = isset($_POST['assignees']) ? array_values($_POST['assignees']) : [];
    $project_title = $_POST['project_title'];
    $project_description = $_POST['project_description'];
    $project_date = $_POST['setTodaysDate'];
    if ($trainee_name == '') {
        $trainee_name_error = 'Trainee name is required';
    }
    if ($project_title == '') {
        $project_title_error = 'Project title is required';
    }
    if ($project_title == '') {
        $project_date = 'Project date is required';
    }
    if ($project_description == '') {
        $project_description_error = 'Project description is required';
    }
    if ($project_description_error == '' && $project_title_error == '' && $trainee_name_error == '') {
        // Retrieve trainee details based on the selected ID
        $response = wp_remote_post('http://localhost/easymanage/wp-json/api/v1/tasks/updateproject/' . $project_id, [
            'method' => 'PUT',
            'body' => [
                'trainee_id' => $trainee_name,
                'project_title' => $_POST['project_title'],
                'project_description' => $_POST['project_description'],
                'setTodaysDate' => $_POST['setTodaysDate'],
            ]
        ]);
        $res = wp_remote_retrieve_body($response);
        $individualtask = json_decode($res);
        // $individualtask = $individualtask->data;
        var_dump($individualtask);
        // var_dump($res);
        if ($individualtask->data->status == 201) {
            echo "<script>alert('Project updated successfully');</script>";
        } else {
            echo "<script>alert('Project not updated successfully');</script>";
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
            <div class="main-contents-container flex-project-contents">
                <div class="create-new-project ">
                    <h2>Update Project</h2>
                    <form action="" method="post">
                        <div class="form-group-project">
                            <div class="left">
                                <?php foreach ($available as $availabletrainee) { ?>
                                    <?php $id = 0;
                                    $label = 'trainee_group' . $id;
                                    $id++;   ?>
                                    <div>
                                        <input type="checkbox" name="assignees[]" <?php echo in_array($availabletrainee->id, $assignedtrainees) ? "checked" : '' ?> id="<?php echo $label; ?>" value="<?php echo  $availabletrainee->id; ?>">
                                        <label for="<?php echo $label; ?>"><?php echo  $availabletrainee->username; ?></label>
                                    </div>

                                <?php } ?>
                            </div>
                            <div class="right">

                                <input class="input text-input dark-text" type="text" name="project_title" id="" placeholder="Enter project title" value="<?php echo $tasklists->project_title; ?>">
                                <input class="input text-input dark-text project-description" type="text" name="project_description" id="" placeholder="Enter project description" value="<?php echo $tasklists->project_description; ?>">
                                <input class="input" type="date" name="setTodaysDate" id="" placeholder="dd/mm/yyyy" value="<?php echo $tasklists->project_date; ?>">
                                <input class="input" type="submit" value="Update Project" name="update_task">

                            </div>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>
</section>
<script>
    var today = new Date().toISOString().split('T')[0];
    document.getElementsByName("setTodaysDate")[0].setAttribute('min', today);
</script>
<?php get_footer(); ?>