<?php

/*
 *  Template Name:View All Projects Template
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
            <div class="main-contents-container">
                <div class="inner-main-contents-container">
                    <div class="top-div">
                        <div>
                            <form action="">
                                <div class="search">
                                    <input type="text" placeholder="Searching for someone?">
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
                        <div class="style-table-profile-column">
                            <div class="buttons status-on-top status-on-top-in-progress">
                                <p>In progress</p>
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
                                                    <i class="in-progress-icon bi bi-square-fill"></i>
                                                </div>
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
                                                    <p class="tasks in-progress"><i class="bi bi-hourglass-split"></i>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="style-table-profile-column">
                            <div class="buttons status-on-top status-on-top-in-not-activated">
                                <p>Not Activated</p>
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
                                                    <i class="not-activated-icon bi bi-square-fill"></i>
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
                                                    <p class=" status-on-top-in-not-activated">Update
                                                        </p>
                                                        <p><i class="delete-icon bi bi-trash3-fill"></i></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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