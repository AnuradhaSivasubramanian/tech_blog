<?php
require_once('../../../private/initialize.php')
?>

<?php
$pages_set = find_all_pages();
?>


<?php $page_title = "Pages"; ?>
<?php include(SHARED_PATH . '/admin_header.php') ?>


<div id="content">
    <div class="Pages listing">
        <h1 class="heading">Pages</h1>

        <div class="actions">
            <a class="a_link" class="action" href="<?php echo url_for('/admin/pages/new.php'); ?>">Create New Page</a>
        </div>

        <table class="list">
            <tr>
                <th>ID</th>
                <th>Subject Id</th>
                <th>Position</th>
                <th>Visible</th>
                <th>Name</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>

            <?php while ($page = mysqli_fetch_assoc($pages_set)) { ?>
            <tr>
                <td><?php echo h($page['id']); ?></td>
                <td><?php echo h(return_subject_name($page['subject_id'])); ?></td>
                <td><?php echo h($page['position']); ?></td>
                <td><?php echo $page['visible'] == 1 ? 'true' : 'false'; ?></td>
                <td><?php echo h($page['menu_name']); ?></td>
                <td><a class="action" href="<?php echo url_for('/admin/pages/show.php?id=' . $page['id']); ?>">View</a>
                </td>
                <td><a class="action" href="<?php echo url_for('/admin/pages/edit.php?id=' . $page['id']); ?>">Edit</a>
                </td>
                <td><a class="action"
                        href="<?php echo url_for('/admin/pages/delete.php?id=' . h(u($page['id']))); ?>">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </table>

    </div>

</div>
<?php include(SHARED_PATH . '/admin_footer.php') ?>