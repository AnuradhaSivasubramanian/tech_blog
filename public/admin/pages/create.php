<?php
require_once('../../../private/initialize.php');

if (!is_post_request()) {
    redirect_to(url_for('/admin/pages/new.php'));
}
// Handles values obtained in new.php
$args = [];
$args['subject_id'] = $_POST['subject'] ?? '';
$args['menu_name'] = $_POST['menu_name'] ?? '';
$args['position'] = $_POST['position'] ?? '';
$args['visible'] = $_POST['visible'] ?? '';
$args['content'] = $_POST['content'] ?? '';

$page = new Page($args);
$result = $page->create_a_page();
if ($result === true) {
    redirect_to(url_for('/admin/pages/show.php?id=' . $page->id));
};