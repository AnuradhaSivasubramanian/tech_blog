<?php
require_once('../../../private/initialize.php');

if (!isset($_GET['id'])) {
    redirect_to(url_for('/admin/pages/index.php'));
}
$id = $_GET['id'];
$page = Page::find_by_id($id);
if ($page == false) {
    redirect_to(url_for('/admin/pages/index.php'));
}

if (is_post_request()) {

    $args = [];
    $args['id'] = $id;
    $args['subject_id'] = $_POST['subject'] ?? '';
    $args['menu_name'] = $_POST['menu_name'] ?? '';
    $args['position'] = $_POST['position'] ?? '';
    $args['visible'] = $_POST['visible'] ?? '';
    $args['content'] = $_POST['content'] ?? '';

    $page->merge_attributes($args);
    $result = $page->update_a_page();
    if ($result === true) {
        redirect_to(url_for('/admin/pages/show.php?id=' . $page->id));
    };
} else {

    $page_count = Page::rows_count();
    //get the list of subject id with names for the select tag
    $subjects = Subject::find_all();
}





?>

<?php $page_title = 'Edit page'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">

    <a class="a_link" href="<?php echo url_for('/admin/pages/index.php'); ?>">&laquo; Back to List</a>

    <div class="Page edit">
        <h1>Edit Page</h1>

        <form action="<?php echo url_for('/admin/pages/edit.php?id=' . htmlspecialchars(urlencode($id))); ?>"
            method="post">
            <dl>
                <dt>Menu Name</dt>
                <dd><input type="text" name="menu_name" value="<?php echo $page->menu_name ?>"
                        class="form-input-name" /></dd>
            </dl>
            <dl>
                <dt>Position</dt>
                <dd>
                    <select name="position" class="form-select">
                        <?php
                        for ($i = 1; $i <= $page_count; $i++) {
                            echo "<option value=\"{$i}\"";
                            if ($page->position === $i) {
                                echo " selected";
                            }
                            echo ">{$i}</option>";
                        }
                        ?>
                    </select>
                </dd>
            </dl>
            <dl>
                <dt>Subject</dt>
                <dd>
                    <select name="subject" class="form-select-name ">
                        <?php
                        foreach ($subjects as $subject) {
                            echo "<option  value=\"{$subject->id}\"";
                            if ($page->subject_id === $subject->id) {
                                echo " selected";
                            }
                            echo ">{$subject->menu_name}</option>";
                        }
                        ?>
                    </select>
                </dd>
            </dl>
            <dl>
                <dt>Visible</dt>
                <dd>
                    <input type="hidden" name="visible" value="0" />
                    <input type="checkbox" name="visible" value="1" <?php echo is_checkbox_checked($page->visible) ?> />
                </dd>
            </dl>
            <dl>
                <dt>Content</dt>
                <dd><textarea type="text" name="content" value=""
                        class="form-select-content"><?php echo $page->content ?></textarea>
                </dd>
            </dl>
            <div id="operations">
                <input type="submit" value="Edit Subject" class="button-primary" />
            </div>
        </form>

    </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>