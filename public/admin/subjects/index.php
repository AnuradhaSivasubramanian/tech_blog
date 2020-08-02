<?php
require_once('../../../private/initialize.php')
?>

<?php


$subjects = Subject::find_all();


?>
<?php $page_title = "Subjects"; ?>
<?php include(SHARED_PATH . '/admin_header.php') ?>



<div id="content">
    <div class="subjects listing">
        <h1 class="heading">Subjects</h1>

        <div class="actions">
            <a class="a_link" class="action" href="<?php echo url_for('/admin/subjects/new.php'); ?>">Create New
                Subject</a>
        </div>

        <table class=" list">
            <tr>
                <th>ID</th>
                <th>Position</th>
                <th>Visible</th>
                <th>Name</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>

            <?php foreach ($subjects as $subject) { ?>
            <tr>
                <td><?php echo htmlspecialchars($subject->id); ?></td>
                <td><?php echo htmlspecialchars($subject->position); ?></td>
                <td><?php echo $subject->visible === '1' ? 'true' : 'false'; ?></td>
                <td><?php echo htmlspecialchars($subject->menu_name); ?></td>
                <td><a class="action"
                        href="<?php echo url_for('/admin/subjects/show.php?id=' . htmlspecialchars(urlencode($subject->id))); ?>">View</a>
                </td>
                <td><a class="action"
                        href="<?php echo url_for('/admin/subjects/edit.php?id=' . htmlspecialchars(urlencode($subject->id))); ?>">Edit</a>
                </td>
                <td><a class="action"
                        href="<?php echo url_for('/admin/subjects/delete.php?id=' . htmlspecialchars(urlencode($subject->id))); ?>">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </table>

    </div>

</div>
<?php include(SHARED_PATH . '/admin_footer.php') ?>