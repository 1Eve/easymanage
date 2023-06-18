<?php

/*
 *  Template Name:Admin Dashboard Template
 *
 */

?>

<?php
$table_name = $wpdb->prefix . 'projectusers';
$results = $wpdb->get_results("SELECT * FROM $table_name WHERE status = 0");

if(isset($_POST['deactivate'])){
    $id = $_POST['id'];

    $results = $wpdb->get_results("SELECT * FROM $table_name WHERE id = $id");

    var_dump($results);
    $wpdb->update($table_name, ['status' => 1], ['id' => $id]);

    wp_redirect(site_url('/easymanage/admin-dashboard'));    
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
                    <a href="/easymanage/admin-dashboard/">
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
                                <p><i class="side-bar-icon-left bi bi-plus-square-fill icon-sidebar"></i> Create project
                                    manager</p>
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
                                    <?php foreach ($results as $result) { ?>
                                        
                                        <div class="style-table-profile">
                                            <div>
                                                <img src="<?php echo $profile; ?>" alt="" class="profile-picture">
                                            </div>
                                            <div class="shared-profile-container">
                                                <div>
                                                    <p>
                                                        <?php // echo $result->cohort; ?>
                                                    </p>
                                                    <p class="name">
                                                        <?php echo $result->username; ?>
                                                    </p>
                                                </div>
                                                <?php if ($result->status == 0) { ?>
                                                    <?php var_dump($result->id); ?>
                                                    <form action="" method="post">
                                                        <div class="bottom-div-submit-form">
                                                            <input type="hidden" name="id" value="<?php echo $result->id; ?>">
                                                            <button name="deactivate" class="bottom-div-submit-btn buttons deactivate-btn">
                                                                <p>Deactivate</p><i class="bi bi-x-circle-fill"></i>
                                                            </button>
                                                        </div>
                                                    </form>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php } ?>

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
                                                <a href=""><button class="bottom-div-submit-btn buttons deactivate-btn">
                                                        <p>Deactivate</p><i class="bi bi-x-circle-fill"></i>
                                                    </button></a>
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