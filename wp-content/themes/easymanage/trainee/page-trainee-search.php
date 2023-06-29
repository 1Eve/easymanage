<?php

/*
 *  Template Name:trainee search page Template
 *
 */

?>

<?php
//search for users

if (isset($_GET['search'])) {
    $response = wp_remote_post('http://localhost/easymanage/wp-json/api/v1/users/search/' . $_GET['search'], [
        'method' => 'GET',
    ]);
    $res = wp_remote_retrieve_body($response);
    $usernames = json_decode($res);
    // var_dump($_GET['search']);
}


$totalusers = getDisplayedUserCount();
$cookieData = returncookie_data();
$response = wp_remote_post('http://localhost/easymanage/wp-json/api/v1/users/search?username=' . $_GET['search'], [
    'method' => 'GET',
]);
$res = wp_remote_retrieve_body($response);
$usernames = json_decode($res);
// var_dump($usernames);
// $usernames = $usernames->data;

if (!$cookieData) {
    $errorMessage = json_last_error_msg();
    echo "JSON decoding failed with error: $errorMessage";
} else {

    // Access individual data elements
    $Id = $cookieData['user_id'];
    $Useremail = $cookieData['useremail'];
    $Username = $cookieData['username'];

    // Get all trainees
    $response = wp_remote_post('http://localhost/easymanage/wp-json/api/v1/users/trainees', [
        'method' => 'GET',
    ]);
    $res = wp_remote_retrieve_body($response);
    $traineelists = json_decode($res);
    $traineelists = $traineelists->data;
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
                            <p class="no-of-employees profile-picture">
                                <?php echo '+' . $totalusers; ?>
                            </p>
                        </div>
                        <div class="top-div-add-trainee-btn">
                            <a class="bottom-div-submit-btn-no-icon  " href="/easymanage/add-trainee/">Add new
                                trainee</a>
                            <i class="bi bi-plus-square"></i>
                        </div>
                    </div>

                    <div class="bottom-div">
                        <div class="admin-dashboard-bottom-div">
                            <div class="deactivate-members-container">
                                <div class="styled-table-employees">
                                    <?php foreach ($usernames as $username) { ?>

                                        <div class="style-table-profile">
                                            <div>
                                                <img src="<?php echo $profile; ?>" alt="" class="profile-picture">
                                            </div>
                                            <div class="shared-profile-container">
                                                <div>
                                                    <p class="name"><?php echo $username->role; ?></p>
                                                    <p><?php echo $username->username; ?></p>
                                                    <p><?php echo $username->useremail; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <div class="style-table-profile">
                                        <div>
                                            <img src="<?php echo $profile; ?>" alt="" class="profile-picture">
                                        </div>
                                        <div class="shared-profile-container">
                                            <div>
                                                <p>Wordpress</p>
                                                <p class="name">Usher Njari</p>
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
    </div>
</section>
<?php get_footer(); ?>