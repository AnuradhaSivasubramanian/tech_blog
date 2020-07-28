<?php
require_once('../../../private/initialize.php')
?>

<?php

$id = $_GET['id'] ?? '1';

$subject = find_a_subject($id);


?>
<?php $page_title = 'View Subject'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('/admin/subjects/index.php'); ?>">&laquo; Back to List</a>
    <div class="subject show">
        <h1>Subject: <?php echo h($subject['menu_name']); ?></h1>

        <div class="attributes">
            <dl>
                <dt>Menu Name</dt>
                <dd><?php echo h($subject['menu_name']); ?></dd>
            </dl>
            <dl>
                <dt>Position</dt>
                <dd><?php echo h($subject['position']); ?></dd>
            </dl>
            <dl>
                <dt>Visible</dt>
                <dd><?php echo $subject['visible'] == '1' ? 'true' : 'false'; ?></dd>
            </dl>
        </div>
    </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>