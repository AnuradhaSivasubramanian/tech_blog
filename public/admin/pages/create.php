<?php
require_once('../../../private/initialize.php');

if (!is_post_request()) {
    redirect_to(url_for('/admin/pages/new.php'));
}
// Handles values obtained in new.php

$page['subject_id'] = $_POST['subject'] ?? '';
$page['menu_name'] = $_POST['menu_name'] ?? '';
$page['position'] = $_POST['position'] ?? '';
$page['visible'] = $_POST['visible'] ?? '';
$page['content'] = $_POST['content'] ?? '';

$result = insert_page($page);
$new_id = mysqli_insert_id($db);
redirect_to(url_for('/admin/pages/show.php?id=' . $new_id));