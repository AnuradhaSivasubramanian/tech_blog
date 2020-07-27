<?php
require_once('../../../private/initialize.php')
?>

<?php
$pages = [
    ['id' => '1', 'position' => '1', 'visible' => '1', 'menu_name' => 'Who are we'],
    ['id' => '2', 'position' => '2', 'visible' => '1', 'menu_name' => 'Javascript'],
    ['id' => '3', 'position' => '3', 'visible' => '1', 'menu_name' => 'Javascript'],
    ['id' => '4', 'position' => '4', 'visible' => '1', 'menu_name' => 'Python'],

    ['id' => '5', 'position' => '5', 'visible' => '1', 'menu_name' => 'Our Portfolio'],
    ['id' => '6', 'position' => '6', 'visible' => '1', 'menu_name' => 'Java'],
    ['id' => '7', 'position' => '7', 'visible' => '1', 'menu_name' => 'PHP'],
    ['id' => '8', 'position' => '8', 'visible' => '1', 'menu_name' => 'PHP']

];
?>


<?php $page_title = "Pages"; ?>
<?php include(SHARED_PATH . '/admin_header.php') ?>


<div id="content">
    <div class="Pages listing">
        <h1>Pages</h1>

        <div class="actions">
            <a class="action" href="<?php echo url_for('/admin/pages/new.php'); ?>">Create New Page</a>
        </div>

        <table class="list">
            <tr>
                <th>ID</th>
                <th>Position</th>
                <th>Visible</th>
                <th>Name</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>

            <?php foreach ($pages as $page) { ?>
            <tr>
                <td><?php echo h($page['id']); ?></td>
                <td><?php echo h($page['position']); ?></td>
                <td><?php echo $page['visible'] == 1 ? 'true' : 'false'; ?></td>
                <td><?php echo h($page['menu_name']); ?></td>
                <td><a class="action" href="<?php echo url_for('/admin/pages/show.php?id=' . $page['id']); ?>">View</a>
                </td>
                <td><a class="action" href="<?php echo url_for('/admin/pages/edit.php?id=' . $page['id']); ?>">Edit</a>
                </td>
                <td><a class="action" href="">Delete</a></td>
            </tr>
            <?php } ?>
        </table>

    </div>

</div>
<?php include(SHARED_PATH . '/admin_footer.php') ?>