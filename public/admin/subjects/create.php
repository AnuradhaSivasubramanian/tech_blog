<?php
require_once('../../../private/initialize.php');

if (!is_post_request()) {
    redirect_to(url_for('/admin/subjects/new.php'));
}
// Handles values obtained in new.php
$args = [];
$args['menu_name'] = $_POST['menu_name'] ?? '';
$args['position'] = $_POST['position'] ?? '';
$args['visible'] = $_POST['visible'] ?? '';

$subject = new Subject($args);
$result = $subject->create_a_subject();
if ($result === true) {
    redirect_to(url_for('/admin/subjects/show.php?id=' . $subject->id));
};