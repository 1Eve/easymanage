<?php

/*
 *  Template Name:Add cohort Template
 *
 */

?>

<?php $profile = get_template_directory_uri() . '/assets/memoji-modified.png'; ?>
<?php

$table_name = $wpdb->prefix . 'cohorts';
$totalusers = ($wpdb->get_var("SELECT COUNT(*) FROM $table_name")- '3'); 

if (isset($_POST['add_cohort'])) {
    $cohort_name = $_POST['cohort_name'];

    $results = $wpdb->get_results("SELECT id FROM $table_name WHERE cohort_name = '$cohort_name'");
    $results = $wpdb->insert($table_name, [
        'cohort_name' => $cohort_name,
    ]);
    if ($results) {
        // echo "<script>alert('Cohort created successfully');</script>";
        wp_redirect(site_url('/easymanage/add-trainer/'));    
    } else {
        echo "<script>alert('Cohort not created successfully');</script>";
    }
}
?>
<?php
add_project_manager();
?>

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
                            <p class="no-of-employees profile-picture"><?php echo '+'. $totalusers; ?></p>
                        </div>

                    </div>
                    <div class="bottom-div flex-project-contents">
                        <div class="create-new-project flex-project-contents">
                            <h2>Add cohort</h2>
                            <form action="" method="post">
                                <input class="input text-input dark-text" name="cohort_name" type="text" name="" id=""
                                    placeholder="Enter name">
                                <input class="input" name="add_cohort" type="submit" value="Add">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>