<?php
require_once('../../../private/initialize.php')
?>

<?php

$id = $_GET['id'] ?? '1';

$page = find_a_page($id);

?>
<?php $page_title = 'View Page'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">

    <a class="a_link" href="<?php echo url_for('/admin/pages/index.php'); ?>">&laquo; Back to List</a>
    <div class="page show">
        <h1>Title: <?php echo htmlspecialchars($page['menu_name']); ?></h1>

        <div class="attributes">
            <dl>
                <dt>Title</dt>
                <dd><?php echo htmlspecialchars($page['menu_name']); ?></dd>
            </dl>
            <dl>
                <dt>Position</dt>
                <dd><?php echo htmlspecialchars($page['position']); ?></dd>
            </dl>
            <dl>
                <dt>Visible</dt>
                <dd><?php echo $page['visible'] === 1 ? 'true' : 'false'; ?></dd>
            </dl>
            <dl>
                <dt>subject</dt>
                <dd><?php echo htmlspecialchars(return_subject_name($page['subject_id'])); ?></dd>
            </dl>

            <dl>
                <dt>Content</dt>
                <dd class="content_container"><?php echo htmlspecialchars($page['content']); ?></dd>
            </dl>
        </div>
    </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>