<?php 
global $wpdb;
$table_name = $wpdb->prefix . 'projectusers';
$result = $wpdb->get_row("SELECT * FROM $table_name");
$cookieName = "userinfo";
// restrict users from accessing the dashboard without havving to login first
if (isset($_COOKIE[$cookieName])) {

    if ($result->role == 'admin') {
        wp_redirect(site_url('/admin-dashboard/'));
        exit;
    } elseif ($result->role == 'projectmanager') {
        wp_redirect(site_url('/project-manager-dashboard/'));
        exit;
    } elseif ($result->role == 'trainer') {
        wp_redirect(site_url('/trainer-dashboard/'));
        exit;
    } elseif ($result->role == 'trainee') {
        wp_redirect(site_url('/trainee-dashboard/'));
        exit;
    }
}
?>
<?php get_header(); ?>
<?php get_footer(); ?>