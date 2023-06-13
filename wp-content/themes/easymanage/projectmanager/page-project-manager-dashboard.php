<?php

/*
 *  Template Name:Project Manager Dashboard Template
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
                                <p><i class="side-bar-icon-left bi bi-plus-square-fill icon-sidebar"></i> Add trainer</p>
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
                    <div class="exit">
                        <a href="/easymanage/login/"><h5><i class="bi bi-box-arrow-left"></i></h5></a>
                        
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
                            <p class="no-of-employees profile-picture">+6</p>
                        </div>
                      
                    </div>
                    <div class="bottom-div">
                        <div class="admin-dashboard-bottom-div">
                            <div class="bottom-div-categories">
                                <a href="">trainees</a>
                                <a href="">trainers</a>
                                <a href="">project managers</a>
                            </div>
                            <div class="deactivate-members-container">
                                <div class="styled-table">
                                    <div class="style-table-profile">
                                        <div>
                                            <img src="<?php echo $profile; ?>" alt="" class="profile-picture">
                                        </div>
                                        <div class="view-trainer-details">
                                            <div>
                                                <p>Trainee</p>
                                                <p class="name">Usher Njari</p>
                                                <div class="flex">
                                                    <div>
                                                        <p>No of trainees</p>
                                                    </div>
                                                    <div>
                                                        <p>(20)</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="style-table-profile">
                                        <div>
                                            <img src="<?php echo $profile; ?>" alt="" class="profile-picture">
                                        </div>
                                        <div class="view-trainer-details">
                                            <div>
                                                <p>Trainee</p>
                                                <p class="name">Usher Njari</p>
                                                <div class="flex">
                                                    <div>
                                                        <p>No of trainees</p>
                                                    </div>
                                                    <div>
                                                        <p>(20)</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="style-table-profile">
                                        <div>
                                            <img src="<?php echo $profile; ?>" alt="" class="profile-picture">
                                        </div>
                                        <div class="view-trainer-details">
                                            <div>
                                                <p>Trainee</p>
                                                <p class="name">Usher Njari</p>
                                                <div class="flex">
                                                    <div>
                                                        <p>No of trainees</p>
                                                    </div>
                                                    <div>
                                                        <p>(20)</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="style-table-profile">
                                        <div>
                                            <img src="<?php echo $profile; ?>" alt="" class="profile-picture">
                                        </div>
                                        <div class="view-trainer-details">
                                            <div>
                                                <p>Trainee</p>
                                                <p class="name">Usher Njari</p>
                                                <div class="flex">
                                                    <div>
                                                        <p>No of trainees</p>
                                                    </div>
                                                    <div>
                                                        <p>(20)</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="style-table-profile">
                                        <div>
                                            <img src="<?php echo $profile; ?>" alt="" class="profile-picture">
                                        </div>
                                        <div class="view-trainer-details">
                                            <div>
                                                <p>Trainee</p>
                                                <p class="name">Usher Njari</p>
                                                <div class="flex">
                                                    <div>
                                                        <p>No of trainees</p>
                                                    </div>
                                                    <div>
                                                        <p>(20)</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="style-table-profile">
                                        <div>
                                            <img src="<?php echo $profile; ?>" alt="" class="profile-picture">
                                        </div>
                                        <div class="view-trainer-details">
                                            <div>
                                                <p>Trainee</p>
                                                <p class="name">Usher Njari</p>
                                                <div class="flex">
                                                    <div>
                                                        <p>No of trainees</p>
                                                    </div>
                                                    <div>
                                                        <p>(20)</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="style-table-profile">
                                        <div>
                                            <img src="<?php echo $profile; ?>" alt="" class="profile-picture">
                                        </div>
                                        <div class="view-trainer-details">
                                            <div>
                                                <p>Trainee</p>
                                                <p class="name">Usher Njari</p>
                                                <div class="flex">
                                                    <div>
                                                        <p>No of trainees</p>
                                                    </div>
                                                    <div>
                                                        <p>(20)</p>
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
    </div>
</section>
<?php get_footer(); ?>