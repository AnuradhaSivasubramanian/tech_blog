<?php
require_once('../../../private/initialize.php')
?>

<?php
$subjects = [
    ['id' => '1', 'position' => '1', 'visible' => '1', 'menu_name' => 'About tech blog'],
    ['id' => '2', 'position' => '2', 'visible' => '1', 'menu_name' => 'Languages'],
    ['id' => '3', 'position' => '3', 'visible' => '1', 'menu_name' => 'Frameworks'],
    ['id' => '4', 'position' => '4', 'visible' => '1', 'menu_name' => 'Algorithms']
];
?>
<?php $page_title = "Subjects"; ?>
<?php include(SHARED_PATH . '/admin_header.php') ?>



<div id="content">
    <div class="subjects listing">
        <h1>Subjects</h1>

        <div class="actions">
            <a class="action" href="<?php echo url_for('/admin/subjects/new.php'); ?>">Create New Subject</a>
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
                <td><?php echo h($subject['id']); ?></td>
                <td><?php echo h($subject['position']); ?></td>
                <td><?php echo $subject['visible'] == 1 ? 'true' : 'false'; ?></td>
                <td><?php echo h($subject['menu_name']); ?></td>
                <td><a class="action"
                        href="<?php echo url_for('/admin/subjects/show.php?id=' . $subject['id']); ?>">View</a></td>
                <td><a class="action"
                        href="<?php echo url_for('/admin/subjects/edit.php?id=' . $subject['id']); ?>">Edit</a></td>
                <td><a class="action" href="">Delete</a></td>
            </tr>
            <?php } ?>
        </table>

    </div>

</div>
<?php include(SHARED_PATH . '/admin_footer.php') ?>