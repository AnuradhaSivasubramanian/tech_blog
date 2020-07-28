<?php
if (!isset($page_title)) {
    $page_title = "Admin Area";
};
?>
<!doctype html>

<html lang="en">

<head>
    <title>TB <?php echo h($page_title); ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" media="all" href="<?php echo url_for('stylesheets/admin.css'); ?>" type="text/css" />
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@700&family=Space+Mono&display=swap"
        rel="stylesheet">
</head>

<body>
    <header>
        <h1>Tech Blog Admin Area</h1>
    </header>
    <navigation>
        <ul>
            <li><a class="main_a_links" href="<?php echo url_for('admin/index.php'); ?>">Menu</a></li>
        </ul>
    </navigation>