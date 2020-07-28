<?php
require_once('../../../private/initialize.php');

if (!is_post_request()) {
    redirect_to(url_for('/admin/subjects/new.php'));
}
// Handles values obtained in new.php
$subject = [];
$subject['menu_name'] = $_POST['menu_name'] ?? '';
$subject['position'] = $_POST['position'] ?? '';
$subject['visible'] = $_POST['visible'] ?? '';

$result = insert_subject($subject);
$new_id = mysqli_insert_id($db);
redirect_to(url_for('/admin/subjects/show.php?id=' . $new_id));