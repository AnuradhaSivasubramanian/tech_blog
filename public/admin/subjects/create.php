<?php
require_once('../../../private/initialize.php');

if (!is_post_request()) {
    redirect_to(url_for('/admin/subjects/new.php'));
}
// Handles values obtained in new.php

$menu_name = $_POST['menu_name'] ?? '';
$position = $_POST['position'] ?? '';
$visible = $_POST['visible'] ?? '';

echo "Form parameters  <br/>";
echo "menu name : $menu_name <br />";
echo "position : $position <br />";
echo "visible : $visible <br/>";