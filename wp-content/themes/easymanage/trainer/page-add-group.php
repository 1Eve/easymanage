<?php

/*
 *  Template Name:Add group Template
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
                    <div class="bottom-div flex-project-contents">
                        <div class="create-new-project flex-project-contents">
                            <h2>Add group</h2>
                            <form action="">
                                <input class="input text-input dark-text" type="text" name="" id=""
                                    placeholder="Enter name">
                                <input class="input" type="submit" value="Add">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>