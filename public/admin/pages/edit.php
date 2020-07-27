<?php
require_once('../../../private/initialize.php');

if (!isset($_GET['id'])) {
    redirect_to(url_for('/admin/pages/index.php'));
}

$id = $_GET['id'];
$menu_name = '';
$visible = '';
$position = '';

if (is_post_request()) {
    $menu_name = $_POST['menu_name'] ?? '';
    $position = $_POST['position'] ?? '';
    $visible = $_POST['visible'] ?? '';

    echo "Form parameters  <br/>";
    echo "menu name : $menu_name <br />";
    echo "position : $position <br />";
    echo "visible : $visible <br/>";
}
// Handles values obtained in new.php

?>

<?php $page_title = 'Edit page'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('/admin/pages/index.php'); ?>">&laquo; Back to List</a>

    <div class="Page edit">
        <h1>Edit Page</h1>

        <form action="<?php echo url_for('/admin/pages/edit.php?id=' . h(u($id))); ?>" method="post">
            <dl>
                <dt>Menu Name</dt>
                <dd><input type="text" name="menu_name" value="<?php echo $menu_name ?>" class="form-input-name" /></dd>
            </dl>
            <dl>
                <dt>Position</dt>
                <dd>
                    <select name="position" class="form-select">
                        <option value="1" <?php echo is_option_selected($position, '1') ?>>1</option>
                        <option value="2" <?php echo is_option_selected($position, '2') ?>>2</option>
                        <option value="3" <?php echo is_option_selected($position, '3') ?>>3</option>
                        <option value="4" <?php echo is_option_selected($position, '4') ?>>4</option>
                    </select>
                </dd>
            </dl>
            <dl>
                <dt>Visible</dt>
                <dd>
                    <input type="hidden" name="visible" value="0" />
                    <input type="checkbox" name="visible" value="1" <?php echo is_checkbox_checked($visible) ?> />
                </dd>
            </dl>
            <div id="operations">
                <input type="submit" value="Edit Subject" class="button-primary" />
            </div>
        </form>

    </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>