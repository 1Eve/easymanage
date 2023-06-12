<?php

/*
 *  Template Name:Admin Dashboard Template
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
                    <a href="">
                        <div class="side-bar-link">
                            <div class="link">
                                <p><i class="side-bar-icon-left bi bi-microsoft icon-sidebar"></i> Dashboard</p>
                            </div>
                            <div>
                                <i class="bi bi-chevron-right"></i>
                            </div>
                        </div>
                    </a>

                    <a href="/easymanage/create-project-manager/">
                        <div class="side-bar-link">
                            <div class="link">
                                <p><i class="side-bar-icon-left bi bi-plus-square-fill icon-sidebar"></i> Create project manager</p>
                            </div>
                            <div>
                                <i class="bi bi-chevron-right"></i>
                            </div>
                        </div>
                    </a>

                    <a href="/easymanage/deactivated-trainers/">
                        <div class="side-bar-link">
                            <div class="link">
                                <p><i class="side-bar-icon-left bi bi-trash3-fill"></i> Trash</p>
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
                                        <div class="shared-profile-container">
                                            <div>
                                                <p>User</p>
                                                <p class="name">Usher Njari</p>
                                            </div>
                                            <div class="bottom-div-submit-form">
                                                <button class="bottom-div-submit-btn buttons deactivate-btn">
                                                    <p>Deactivate</p><i class="bi bi-x-circle-fill"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="style-table-profile">
                                        <div>
                                            <img src="<?php echo $profile; ?>" alt="" class="profile-picture">
                                        </div>
                                        <div class="shared-profile-container">
                                            <div>
                                                <p>User</p>
                                                <p class="name">Usher Njari</p>
                                            </div>
                                            <div class="bottom-div-submit-form">
                                                <button class="bottom-div-submit-btn buttons deactivate-btn">
                                                    <p>Deactivate</p><i class="bi bi-x-circle-fill"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="style-table-profile">
                                        <div>
                                            <img src="<?php echo $profile; ?>" alt="" class="profile-picture">
                                        </div>
                                        <div class="shared-profile-container">
                                            <div>
                                                <p>User</p>
                                                <p class="name">Usher Njari</p>
                                            </div>
                                            <div class="bottom-div-submit-form">
                                                <button class="bottom-div-submit-btn buttons deactivate-btn">
                                                    <p>Deactivate</p><i class="bi bi-x-circle-fill"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="style-table-profile">
                                        <div>
                                            <img src="<?php echo $profile; ?>" alt="" class="profile-picture">
                                        </div>
                                        <div class="shared-profile-container">
                                            <div>
                                                <p>User</p>
                                                <p class="name">Usher Njari</p>
                                            </div>
                                            <div class="bottom-div-submit-form">
                                                <button class="bottom-div-submit-btn buttons deactivate-btn">
                                                    <p>Deactivate</p><i class="bi bi-x-circle-fill"></i>
                                                </button>
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