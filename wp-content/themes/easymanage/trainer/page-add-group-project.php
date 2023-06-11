<?php

/*
 *  Template Name:Add Group Project Template
 *
 */

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
                    <div class="side-bar-link">
                        <div class="link">
                            <p><i class="bi bi-microsoft icon-sidebar"></i> Dashboard</p>
                        </div>
                        <div>
                            <i class="bi bi-chevron-right"></i>
                        </div>
                    </div>
                    <div class="side-bar-link">
                        <div class="link">
                            <p><i class="bi bi-plus-square-fill icon-sidebar"></i> Add new tasks</p>
                        </div>
                        <div>
                            <i class="bi bi-chevron-right"></i>
                        </div>
                    </div>
                    <div class="side-bar-link">
                        <div class="link">
                            <p><i class="bi bi-list-task icon-sidebar"></i> Pending tasks</p>
                        </div>
                        <div>
                            <i class="bi bi-chevron-right"></i>
                        </div>
                    </div>
                    <div class="side-bar-link">
                        <div class="link">
                            <p><i class="bi bi-clipboard2-check icon-sidebar"></i> Completed</p>
                        </div>
                        <div>
                            <i class="bi bi-chevron-right"></i>
                        </div>
                    </div>
                    <div class="side-bar-link">
                        <div class="link">
                            <p><i class="bi bi-people-fill icon-sidebar"></i> All employees</p>
                        </div>
                        <div>
                            <i class="bi bi-chevron-right"></i>
                        </div>
                    </div>
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
                    <div class="exit">
                        <h4><i class="bi bi-box-arrow-left"></i></h4>
                    </div>
                </div>
            </div>
            <div class="main-contents-container flex-project-contents">
                <!-- <div>
                    <h2>search</h2>
                </div> -->
                <!-- <hr> -->
                <div class="create-new-project ">
                    <h2>Create new Project</h2>
                    <form action="">
                        <input class="input text-input dark-text" type="text" name="" id="" placeholder="Select user">
                        <input class="input text-input dark-text" type="text" name="" id=""
                            placeholder="--select group--">
                        <input class="input text-input dark-text" type="text" name="" id=""
                            placeholder="Enter project title">
                        <input class="input text-input dark-text project-description" type="text" name="" id=""
                            placeholder="Enter project description">
                        <input class="input text-input dark-text" type="text" name="" id="" placeholder="dd/mm/yyyy">
                        <input class="input" type="submit" value="Create project">
                    </form>

                </div>

            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>